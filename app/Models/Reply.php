<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\like;
use App\Notifications\ReplyNotification;

class Reply extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        'user_id',
        'comment_id',
        'reply_text',
        'likes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blogs::class, 'blog_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function show($commentId)
    {
        // Fetch the comment along with its replies
        $comment = Comment::with('replies')->find($commentId);
        
        // Check if the comment exists
        if (!$comment) {
            return abort(404);
        }
        
        // Get the replies associated with the comment
        $replies = $comment->replies;

        // Pass the comment and replies to the view
        return view('comments.show', compact('comment', 'replies'));
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function notifyUser()
    {
        $this->comment->user->notify(new ReplyNotification($this));
    }
}

