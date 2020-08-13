<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Customer;
use App\User;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_code', 'customer_id', 'coupon_code',
        'discount', 'discount_price', 'sub_total',
        'grand_total', 'paid', 'change'        
    ];

    protected $hidden = [];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
