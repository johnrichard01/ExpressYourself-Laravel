@extends('master')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/userdash.css')}}">
@endsection
@section('content')
@include('inc.navbar')

            
        <header>
        
            <div class="Message"><h1>Messages</h1></div>
            
        </header>

        <ul>
            @foreach($messages as $message)
                <li>
                    <strong>{{ $message->sender->name }}</strong>: {{ $message->content }}
                </li>
            @endforeach
        </ul>

