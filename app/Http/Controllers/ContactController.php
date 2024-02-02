<?php

namespace App\Http\Controllers;

use App\Mail\ContactThanks;
use App\Mail\ContactUs;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('homepage.contactus');
    }
    public function send()
    {
        $data=request()->validate([
            'firstName'=> 'required|min:3',
            'lastName'=> 'required|min:3',
            'email'=> 'required|email',
            'message'=> 'required|min:3',
        ]);
        Contact::create($data);
        Mail::to('contact.expressyourself01@gmail.com')->send(new ContactUs($data));
        Mail::to($data['email'])->send(new ContactThanks());
        return redirect('/contact');
    }
}
