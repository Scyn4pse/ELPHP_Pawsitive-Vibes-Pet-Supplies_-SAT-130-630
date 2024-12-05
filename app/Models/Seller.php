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
    use HasFactory;
    use HasApiTokens;
    use Notifiable;

    protected $fillable = [
        'seller_name', 
        'seller_email',
        'seller_password',
        'seller_phone',
        'seller_address',
        'user_role',
        'seller_created_at',
        'seller_updated_at',
    ];

    protected $table = 'Sellers';
    protected $primaryKey = 'seller_id';

    public function tokens()
    {
        return $this->morphMany(PersonalAccessToken::class, 'tokenable');
    }
}
