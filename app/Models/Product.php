<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'prod_name',
        'prod_description',
        'prod_price',
        'prod_quantity',
        'prod_image',
    ];

    protected $table = 'Products';
    protected $primaryKey = 'prod_id';
    public $timestamps = true;
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'seller_id');
    }
}
