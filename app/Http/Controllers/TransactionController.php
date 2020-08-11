<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Sale;
use App\Product;
use Auth;

use App\Http\Requests\SaleRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "test";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($transaction_code = NULL)
    {
        $title = "Create Transaction";

        $items = Sale::with([
            'product'
        ])->where('transaction_code', $transaction_code)->get();
        $total_price = Sale::where('transaction_code', $transaction_code)->sum('total_price');

        return view('pages.transaction.create', [
            'title' => $title,
            'transaction_code' => $transaction_code,
            'items' => $items,
            'total_price' => $total_price
        ]);
        
    }

    
    /**
     * Store product to transaction.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createSale(SaleRequest $request){
        $input = $request->all();

        $transaction_code = $input['transaction_code'];
        $quantity = $input['quantity'];

        $products = Product::where('product_code', $input['product_code'])->get();
        foreach ($products as $product){
            $product_id = $product->id;
            $product_price = $product->selling_price;
            $product_stock = $product->stock;
        }

        $saleProducts = Sale::where([
                ['transaction_code', '=', $transaction_code],
                ['product_id', '=', $product_id]
            ])->get();

        $total = $quantity * $product_price;
        $reducedStock = $product_stock - $quantity;

        $productStock = [
            'stock' => $reducedStock
        ];

        $create = [
            'user_id' => Auth::user()->id,
            'transaction_code' => $transaction_code,
            'product_id' => $product_id,
            'product_price' => $product_price,
            'quantity' => $quantity,
            'total_price' => $total
        ];

        // Cek stok produk
        if ((int)$quantity < $product_stock){
            // Cek jika produknya sama, maka update qty dan harga totalnya.
            if (!$saleProducts->isEmpty()){
                foreach ($saleProducts as $saleProduct){
                    if ($saleProduct->product_id == $product_id){
                        $update = [
                            'quantity' => $saleProduct->quantity + $quantity,
                            'total_price' => $saleProduct->total_price + $total,
                        ];
                        Sale::findOrFail($saleProduct->id)->update($update);
                        Product::findOrFail($product_id)->update($productStock);
                    }else{
                        Sale::create($create);
                        Product::findOrFail($product_id)->update($productStock);
                    }
                }
            }else{
                Sale::create($create);
                Product::findOrFail($product_id)->update($productStock);
            }
            return redirect()->route('transaction.create', $transaction_code);
        }else{
            return redirect()->route('transaction.create', $transaction_code)->with('fail','Jumlah stock produk tidak mencukupi! Stok produk tersisa ' . $product_stock);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
