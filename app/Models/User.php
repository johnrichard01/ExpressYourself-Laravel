<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'bio',
        'first_name',
        'last_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    use HasFactory;

    // // Define the relationship with the Message model for received messages
    // public function receivedMessages()
    // {
    //     return $this->hasMany(Message::class, 'recipient_id');
    // }

    // // Define the relationship with the Message model for sent messages
    // public function sentMessages()
    // {
    //     return $this->hasMany(Message::class, 'user_id'); // Assuming 'user_id' is the foreign key for sent messages
    // }

    // relationship to blogs
    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'user_id');
    }
}
