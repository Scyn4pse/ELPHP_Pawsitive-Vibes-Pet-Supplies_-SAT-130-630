<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /** @use HasFactory<\Database\Factories\SellerFactory> */
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'seller_name', // Add this line to allow mass assignment for cust_name
        'seller_email',
        'seller_password',
        'seller_phone',
        'seller_store_name',
        'seller_created_at',
        'seller_updated_at',
    ];

    // Optionally, you can also define the table name if it is not the plural of the model name
    protected $table = 'Seller';
}
