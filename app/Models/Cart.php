<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention (e.g., 'carts')
    protected $table = 'Cart';

    // Fillable fields for mass assignment
    protected $fillable = [
        'cust_id',
        // Do not include cart_item_id here if it's auto-incrementing
    ];

    // If using custom timestamps
    protected $dates = [
        'cart_created_at',
        'cart_updated_at',
    ];

    // Define relationships
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

}
