<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\SellerFactory> */
    use HasFactory;
    use HasApiTokens;
    use Notifiable;

    // Define which attributes are mass assignable
    protected $fillable = [
        'seller_name', // Add this line to allow mass assignment for cust_name
        'seller_email',
        'seller_password',
        'seller_phone',
        'seller_address',
        'user_role',
        'seller_created_at',
        'seller_updated_at',
    ];

    // Optionally, you can also define the table name if it is not the plural of the model name
    protected $table = 'Seller';
    protected $primaryKey = 'seller_id';

    // Define the relationship to tokens
    public function tokens()
    {
        return $this->morphMany(PersonalAccessToken::class, 'tokenable');
    }
}
