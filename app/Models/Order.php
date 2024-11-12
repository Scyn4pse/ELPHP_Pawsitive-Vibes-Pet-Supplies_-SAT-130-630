<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'cust_id',
        'order_date',
        'order_total',
        'order_status',
        'order_created_at',
        'order_updated_at',
    ];
    protected $table = 'Order';
}
