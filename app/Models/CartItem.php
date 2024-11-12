<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'cust_id',
        'prod_id',
        'cart_quantity',
        'cart_price',
    ];
    
    protected $table = 'CartItem';
}
