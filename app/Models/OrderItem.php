<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'order_id',
        'prod_id',
        'order_item_quantity',
        'order_item_price',
    ];

    protected $table = 'OrderItem';

}
