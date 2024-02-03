<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function message()
    {
        // Fetch messages with sender information
        $messages = Message::with('sender')->get();

        return view('user.message', ['messages' => $messages]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'recipient' => 'required',
            'content' => 'required',
        ]);

        // Create a new message
        Message::create([
            'recipient' => $validatedData['recipient'],
            'content' => $validatedData['content'],
            // Assuming you have user authentication
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('user.message')->with('success', 'Message created successfully.');
    }

    public function destroy(Request $request, Message $message)
    {
        // Logic to delete a single message
        $message->delete();

        return redirect()->route('user.message')->with('success', 'Message deleted successfully.');
    }

    public function deleteSelected(Request $request)
    {
        // Logic to delete selected messages
        $selectedMessages = $request->input('selectedMessages', []);

        // Implement the logic to delete selected messages based on their IDs

        return redirect()->route('user.message')->with('success', 'Selected messages deleted successfully.');
    }
}

