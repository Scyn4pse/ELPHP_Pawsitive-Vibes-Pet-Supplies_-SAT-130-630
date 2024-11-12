<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = [
        'notif_id',
        'user_id',
        'notif_user_type',
        'notif_message',
        'notif_created_at',
        'notif_updated_at',
    ];
    
    protected $table = 'Notification';
}
