<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // If not authenticated, redirect to login and preserve the intended URL
            return redirect()->route('login')->with('error', 'Please log in to leave a comment.');
        }
    
        // Validate the request
        $request->validate([
            'comment_text' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        // Get the authenticated user's name
        $userName = Auth::user()->name;
    
        // Get the authenticated user's ID
        $userId = Auth::user()->id;
    
        // Create a new Comment model and save it to the database
        $comment = new Comment;
        $comment->blog_id = $request->input('blog_id');
        $comment->user_id = Auth::user()->id;
        $comment->comment_text = $request->input('comment_text');
        $comment->save();
    
        // Redirect back or to the blog post page
        return redirect()->back()->with('success', 'Comment added successfully!');
    }


    public function storeReply(Request $request, Comment $comment, Reply $parentReply = null)
    {
        // Get the authenticated user's information
        $user = Auth::user();
    
        // Create a new reply for the comment
        $reply = new Reply([
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'reply_text' => $request->input('reply_text'),
        ]);
    
        // If replying to a reply, set the parent_id
        if ($parentReply) {
            $reply->parent_id = $parentReply->id;
        }
    
        // Save the reply
        $reply->save();
    
        // Redirect back or return a response as needed
        return redirect()->back()->with('success', 'Reply added successfully');
    }
    
    public function storeNestedReply(Request $request, Reply $parentReply)
    {
        // Get the authenticated user's information
        $user = Auth::user();
    
        // Create a new reply for the comment
        $reply = new Reply([
            'user_id' => $user->id,
            'comment_id' => $parentReply->comment_id,
            'reply_text' => $request->input('reply_text'),
        ]);
    
        // If replying to a nested reply, set the parent_id
        $reply->parent_id = $parentReply->id;
    
        // Save the reply
        $reply->save();
    
        // Redirect back or return a response as needed
        return redirect()->back()->with('success', 'Nested Reply added successfully');
    }
    

    public function show($id)
    {
        // Fetch the comments along with the user relation
        $comments = Comment::with('user')->get();
    
        // Pass the comments to the view
        return view('homepage.show', compact('comments'));
    }
    

};