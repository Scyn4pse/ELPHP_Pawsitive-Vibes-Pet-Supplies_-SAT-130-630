<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'cust_id',
        'cust_name', // Add this line to allow mass assignment for cust_name
        'cust_email',
        'cust_password',
        'cust_phone',
        'cust_address',
        'cust_created_at',
        'cust_updated_at',
    ];

    // Optionally, you can also define the table name if it is not the plural of the model name
    protected $table = 'Customer';
}