<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function bookmark(Blogs $blog)
    {
        auth()->user()->bookmarks()->create([
            'blog_id' => $blog->id,
        ]);

        return redirect()->back()->with('success', 'Blog bookmarked successfully.');
    }

    public function unbookmark(Blogs $blog)
    {
        auth()->user()->bookmarks()->where('blog_id', $blog->id)->delete();

        return redirect()->back()->with('success', 'Bookmark removed successfully.');
    }

    public function showBookmarks()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Retrieve bookmarks for the user (adjust the logic based on your application)
        $bookmarks = $user->bookmarks()->with('blog')->get();

        return view('user.bookmark', compact('user', 'bookmarks'));
    }
}