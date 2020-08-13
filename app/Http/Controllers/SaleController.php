<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Sale;
use App\Product;
use Auth;

use App\Http\Requests\SaleRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $input = $request->all();

        $transactionCode = $input['transaction_code'];
        $quantity = $input['quantity'];

        $products = Product::where('product_code', $input['product_code'])->get();
        foreach ($products as $product){
            $productId = $product->id;
            $productName = $product->name;
            $productPrice = $product->selling_price;
            $productStock = $product->stock;
        }

        $saleProducts = Sale::where([
                ['transaction_code', '=', $transactionCode],
                ['product_id', '=', $productId]
            ])->get();

        $total = $quantity * $productPrice;
        $reducedStock = $productStock - $quantity;

        $reduceProductStock = [
            'stock' => $reducedStock
        ];

        $create = [
            'user_id' => Auth::user()->id,
            'transaction_code' => $transactionCode,
            'product_id' => $productId,
            'product_price' => $productPrice,
            'quantity' => $quantity,
            'total_price' => $total
        ];

        // Cek stok produk
        if ($productStock == 0){
            return redirect()->back()->withErrors('Stok ' . $productName . ' kosong!');
        }elseif ((int)$quantity < $productStock){
            // Cek jika produknya sama, maka update qty, harga totalnya, dan update stock barang.
            if (!$saleProducts->isEmpty()){
                foreach ($saleProducts as $saleProduct){
                    if ($saleProduct->product_id == $productId){
                        $update = [
                            'quantity' => $saleProduct->quantity + $quantity,
                            'total_price' => $saleProduct->total_price + $total,
                        ];
                        Sale::findOrFail($saleProduct->id)->update($update);
                        Product::findOrFail($productId)->update($reduceProductStock);
                    }else{
                        Sale::create($create);
                        Product::findOrFail($productId)->update($reduceProductStock);
                    }
                }
            }else{
                Sale::create($create);
                Product::findOrFail($productId)->update($reduceProductStock);
            }
            return redirect()->route('transaction.create', $transactionCode);
        }else{
            return redirect()->back()->withErrors('Jumlah stock produk tidak mencukupi! Stok produk tersisa ' . $productStock);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $id = $id;

        $transactionCode = $input['transaction_code'];
        $quantity = $input['quantity'];

        $validator = Validator::make($input, [
            'transaction_code' => 'required',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('transaction.create', $transactionCode)
                        ->withErrors($validator)
                        ->withInput();
        }

        $saleProduct = Sale::find($id);
        $productSaleQuantity = $saleProduct->quantity;
        $productId = $saleProduct->product_id;

        $product = Product::findOrFail($productId);
        $productPrice = $product->selling_price;
        $productStock = $product->stock;

        $originalProductStock = $productStock + $productSaleQuantity;
        $reducedStock = $originalProductStock - $quantity;
        $total = $quantity * $productPrice;

        // Cek stok produk
        if ((int)$quantity < $originalProductStock){
            Sale::findOrFail($id)->update([
                'quantity' => $quantity,
                'total_price' => $total
            ]);
            Product::findOrFail($productId)->update([
                'stock' => $reducedStock
            ]);
            return redirect()->route('transaction.create', $transactionCode);
        }else{
            return redirect()->back()->withErrors('Jumlah stock produk tidak mencukupi! Stok produk tersisa ' . $productStock);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saleProduct = Sale::findOrFail($id);
        $productSaleQuantity = $saleProduct->quantity;
        $productId = $saleProduct->product_id;

        $productStock = Product::findOrFail($productId)->stock;
        $originalProductStock = $productStock + $productSaleQuantity;
        
        Product::findOrFail($productId)->update([
            'stock' => $originalProductStock
        ]);

        Sale::findOrFail($id)->delete();
        return redirect()->back();
    }
}
