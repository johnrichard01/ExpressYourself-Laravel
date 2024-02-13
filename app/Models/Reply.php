<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reply extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'comment_id',
        'reply_text'];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'blog_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    
}
