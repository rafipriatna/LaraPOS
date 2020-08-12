<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;
use App\Customer;
use App\Transaction;
use Auth;

use App\Http\Requests\SaleRequest;
use App\Http\Requests\TransactionRequest;

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
    public function create($transactionCode)
    {
        $title = "Create Transaction";

        $sales = Sale::with([
            'product'
        ])->where('transaction_code', $transactionCode);
        $items = $sales->get();
        $subTotal = $sales->sum('total_price');

        $customers = Customer::all();

        return view('pages.transaction.create', [
            'title' => $title,
            'transactionCode' => $transactionCode,
            'items' => $items,
            'customers' => $customers,
            'subTotal' => $subTotal
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();

        $data['coupon_code'] = $data['coupon_code'] !== null ? $data['coupon_code'] : 0;
        $data['sub_total'] = str_replace(',', '', $data['sub_total']);
        $data['discount_price'] = str_replace(',', '', $data['discount_price']);
        $data['grand_total'] = str_replace(',', '', $data['grand_total']);
        $data['paid'] = str_replace(',', '', $data['paid']);
        $data['change'] = str_replace(',', '', $data['change']);

        $transactionCode = now()->format('dmyHis') . Transaction::all()->count() . Auth::user()->id;
        
        Transaction::create($data);
        return redirect()->route('transaction.create', $transactionCode)->with('success','Transaksi berhasil disimpan!');
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
