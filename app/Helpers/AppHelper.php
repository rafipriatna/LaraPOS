<?php

namespace App\Helpers;

use App\Sale;
use Auth;

class AppHelper
{
    static public function transaction_code(){
        return now()->format('dmyHis') . Sale::all()->count() . Auth::user()->id;
    }
}