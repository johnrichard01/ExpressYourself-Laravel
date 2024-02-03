<?php
// app/Models/Message.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'recipient_id', // Update 'recipient' to 'recipient_id'
        // Add other fields as needed
    ];

    // Define the relationship with the User model for the sender (assuming sender is the authenticated user)
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id'); //'user_id' is the foreign key for the authenticated user (sender)
    }

    // Define the relationship with the User model for the recipient
    public function recipientUser()
    {
        return $this->belongsTo(User::class, 'recipient_id'); //'recipient_id' is the foreign key for the recipient user
    }

    // Define relationships or other methods here
}
