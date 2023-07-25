<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications'; // Specify the notifications table name if different

    protected $fillable = ['notifiable_id', 'notifiable_type', 'data', 'read_at']; // Define the fillable fields

    // Add any additional relationships or methods as needed
}
