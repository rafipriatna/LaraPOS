<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Customer;
use App\User;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_code', 'user_id', 'customer_id', 'coupon_id',
        'discount', 'discount_price', 'sub_total',
        'grand_total', 'paid', 'change', 'valid'  
    ];

    protected $hidden = [];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
