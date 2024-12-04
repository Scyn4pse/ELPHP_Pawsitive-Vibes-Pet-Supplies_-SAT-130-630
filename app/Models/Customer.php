<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;


class Customer extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'cust_name', 
        'cust_email',
        'cust_password',
        'cust_phone',
        'cust_address',
        'user_role',
        'cust_created_at',
        'cust_updated_at',
    ];
    protected $table = 'Customer';
    protected $primaryKey = 'cust_id';

    public function tokens()
    {
        return $this->morphMany(PersonalAccessToken::class, 'tokenable');
    }
}