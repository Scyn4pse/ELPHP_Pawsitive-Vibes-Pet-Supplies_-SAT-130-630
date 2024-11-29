<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'prod_name',
        'prod_description',
        'prod_price',
        'prod_quantity',
        'prod_image',
    ];
    protected $table = 'Product';
}
