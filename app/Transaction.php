<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_code', 'customer_id', 'coupon_code',
        'discount', 'discount_price', 'sub_total',
        'grand_total', 'paid', 'change'        
    ];

    protected $hidden = [];
}
