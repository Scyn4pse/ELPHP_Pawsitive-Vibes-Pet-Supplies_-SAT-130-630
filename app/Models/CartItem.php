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
        'prod_id',
        'cart_item_quantity',
        'cart_item_price',
    ];
    
    protected $table = 'CartItem';
    protected $primaryKey = 'cart_item_id';
    public function cart()
{
    return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
}
public function product()
{
    return $this->belongsTo(Product::class, 'prod_id', 'prod_id');
}
}
