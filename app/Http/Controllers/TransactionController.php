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

        if(empty($transaction_code)){
            $transaction_code = now()->format('dmys') . Sale::all()->count() . Auth::user()->id;
        }
        $items = Sale::with([
            'product'
        ])->get();

        return view('pages.transaction.create', [
            'title' => $title,
            'transaction_code' => $transaction_code,
            'items' => $items
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

        $product = Product::where('product_code', $input['product_code'])->first();
        $product_id = $product->id;
        $product_price = $product->selling_price;

        $transaction_code = $input['transaction_code'];

        $total = $input['quantity'] * $product_price;

        $data = [
            'user_id' => Auth::user()->id,
            'transaction_code' => $transaction_code,
            'product_id' => $product_id,
            'product_price' => $product_price,
            'quantity' => $input['quantity'],
            'total_price' => $total
        ];

        Sale::create($data);

        return redirect()->route('transaction.create', $transaction_code);
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
