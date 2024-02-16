<?php

// app/Http/Controllers/LikeController.php

namespace App\Http\Controllers;

use App\Models\Comment; // Make sure to import your Comment model
use App\Models\Reply;   // Make sure to import your Reply model
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeComment($commentId)
    {
        try {
            // Find the comment by ID
            $comment = Comment::findOrFail($commentId);

            // Example: Increment the likes count
            $comment->likes++;

            // Save the changes to the comment
            $comment->save();

            return response()->json(['message' => 'Comment liked successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error liking comment'], 500);
        }
    }

    public function likeReply($replyId)
    {
        try {
            // Find the reply by ID
            $reply = Reply::findOrFail($replyId);

            // Example: Increment the likes count
            $reply->likes++;

            // Save the changes to the reply
            $reply->save();

            return response()->json(['message' => 'Reply liked successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error liking reply'], 500);
        }
    }
}

