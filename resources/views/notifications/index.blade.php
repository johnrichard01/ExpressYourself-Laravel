@extends('master')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Notifications')
    @section('css')
        <link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @endsection

    @section('content')
        @include('inc.navbar')
        
            <main>
                <div class="container mt-5">
                    
                    @auth
                        <div class="card">
                            <div class="card-header">
                                <h1>Notifications: {{ auth()->user()->unreadNotifications->count() }}</h1>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        <li>
                                            {{ $notification->data['user_name'] }} commented on "{{ $notification->data['blog_title'] }}"
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endauth





                </div>
            </main>


        @include('inc.footer')

    @endsection
