<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'prod_id',
        'cart_item_quantity',
        'cart_item_price',
    ];
    
    protected $table = 'CartItem';
}
