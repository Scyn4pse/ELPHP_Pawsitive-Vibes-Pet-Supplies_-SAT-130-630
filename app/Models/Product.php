<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'prod_id',
        'seller_id',
        'prod_name',
        'prod_image',
        'prod_description',
        'prod_price',
        'prod_created_at',
        'prod_updated_at',
    ];
    protected $table = 'Product';
}
