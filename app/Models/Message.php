<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Define the relationship with the User model
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id'); //'sender_id' is the foreign key in the messages table
    }
}
