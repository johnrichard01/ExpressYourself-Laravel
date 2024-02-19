<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    //table associated with the model
    protected $table = 'likes';

    //mass-assignable attributes
    protected $fillable = [
        'user_id',
        'comment_id',
    ];

    // Relationships

    // A like belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A like belongs to a comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
