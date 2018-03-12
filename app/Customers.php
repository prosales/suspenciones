<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'code', 'name', 'trade_name', 'business_name', 'address'
    ];
}
