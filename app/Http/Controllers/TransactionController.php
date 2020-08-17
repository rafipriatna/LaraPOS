<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Sale;
use App\Customer;
use App\Transaction;
use App\User;
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
        $title = "Transaction List";

        $items = Transaction::with([
            'customer'
        ])->get();

        return view('pages.transaction.index', [
            'title' => $title,
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($transactionCode)
    {
        if (is_null($transactionCode)){
            abort(404);
        }

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($transactionCode)
    {
        $title = "Transaction";

        $sales = Sale::with([
            'product'
        ])->where('transaction_code', $transactionCode);
        $items = $sales->get();
        $subTotal = $sales->sum('total_price');

        $customers = Customer::all();

        $transaction = Transaction::with([
            'customer',
            'user'
        ])->where('transaction_code', $transactionCode)->first();

        $user = User::findOrFail($transaction['user_id'])->name;

        $data = [
            'date' => $transaction->created_at->toDateTimeString(),
            'couponCode' => $transaction->coupon_code ? $transaction->coupon_code : '',
            'customerId' => $transaction->customer_id,
            'discount' => $transaction->discount,
            'paid' => $transaction->paid,
            'change' => $transaction->change,
            'user' => $user
        ];

        return view('pages.transaction.show', [
            'title' => $title,
            'transactionCode' => $transactionCode,
            'items' => $items,
            'customers' => $customers,
            'subTotal' => $subTotal,
            'data' => $data
        ]);
        
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

    /**
     * Show a transaction report by date in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request){
        $title = "Transaction Report";

        $data = $request->all();
        $date = explode(' - ', $data['date']);

        $fromDate   = Carbon::parse($date[0])
                        ->startOfDay()
                        ->toDateTimeString();
        $toDate     = Carbon::parse($date[1])
                        ->endOfDay()
                        ->toDateTimeString();

        $items = Transaction::whereBetween('created_at', [new Carbon($fromDate), new Carbon($toDate)])->get();
    
        return view('pages.transaction.report', [
            'title' => $title,
            'items' => $items
        ]);
    }
}
