<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'name', 'address', 'contact'
    ];

    protected $hidden = [];
}
