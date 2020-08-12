<?php

namespace App\Helpers;

use App\Transaction;
use Auth;

class AppHelper
{
    static public function transaction_code(){
        return now()->format('dmyHis') . Transaction::all()->count() . Auth::user()->id;
    }
}