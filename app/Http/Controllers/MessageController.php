<?php

// app/Http/Controllers/MessageController.php

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
}
