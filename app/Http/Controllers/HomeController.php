<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Transaction;
use App\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Home Page";

        $customer = Customer::all()->count();

        $transaction = Transaction::whereMonth('created_at', '=', date('m'))->where('valid', TRUE)->get();
        $profit = $transaction->sum('grand_total');
        $totalTransaction = $transaction->count();

        return view('home', [
            'title' => $title,
            'customer' => $customer,
            'profit' => $this->thousandsCurrencyFormat($profit),
            'totalTransaction' => $totalTransaction
        ]);
    }

    private function thousandsCurrencyFormat($num) {

        if($num>1000) {
      
              $x = round($num);
              $x_number_format = number_format($x);
              $x_array = explode(',', $x_number_format);
              $x_parts = array(' Rb', ' Jt', ' M', ' T');
              $x_count_parts = count($x_array) - 1;
              $x_display = $x;
              $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
              $x_display .= $x_parts[$x_count_parts - 1];
      
              return $x_display;
      
        }
      
        return $num;
    }
}
