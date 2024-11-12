<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'cust_id',
        'cart_created_at',
        'cart_updated_at',
    ];

    protected $table = 'Cart';
}
