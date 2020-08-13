<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\ProductCategory;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'coupon_code', 'name', 'description',
        'product_category_id', 'expired',
        'status', 'discount'
    ];

    protected $hidden = [];

    // Relasi
    public function category() {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }
}
