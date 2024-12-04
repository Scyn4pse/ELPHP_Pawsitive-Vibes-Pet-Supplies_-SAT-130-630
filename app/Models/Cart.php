<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cust_id',
        'cart_item_id',
        'cart_created_at',
        'cart_updated_at',
    ];

    protected $table = 'Cart';
}
