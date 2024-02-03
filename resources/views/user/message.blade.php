@extends('master')

@section('title', 'Home')

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('/assets/css/universal.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/userdash.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/messages.css') }}">
@endsection

@section('content')
    @include('inc.navbar')

    <main>
        <header>
            <div class="Message"><h1>Messenger</h1></div>
        </header>
    
        <div class="container">
            <div class="row mx-4">
    
                <!-- Main Content Section -->
                <div class="content--messenger col-md-8 mt-5">
 
            
                    <!-- Modal -->
                    <div class="modal fade" id="createMessageModal" tabindex="-1" aria-labelledby="createMessageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createMessageModalLabel">Create Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('messages.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="recipient">Recipient:</label>
                                            <input type="text" name="recipient" class="form-control" placeholder="Enter recipient username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Message:</label>
                                            <textarea name="content" class="form-control" placeholder="Type your message here" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Card Section -->
                    <div class="card messenger-card">
                        <div class="messenger--header">
                                                
                                <!-- Search Bar and Create Message Button -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <!-- Search Bar -->
                                    <div class="input-group search--message">
                                        <form action="/search" class="col-12 col-lg-4 mt-4 mb-lg-0  d-flex align-items-center" role="search">
                                            <input class="form-control search-bar" name="searchmessages" type="search" placeholder="Search Message" aria-label="Search">
                                        </form>
                                    </div>

                                    
                                    <div class="create">
                                                                        <!-- Create Message -->
                                        <button type="button" class="create-btn btn-md" data-bs-toggle="modal" data-bs-target="#createMessageModal">
                                            <span class="material-symbols-outlined">
                                                chat
                                                </span>
                                        </button>

                                    </div>
    
                                    <div class="create mx-3">
                                                                    <!-- Create Message -->
                                        <button type="button" class="group-btn btn-md" data-bs-toggle="modal" data-bs-target="#createMessageModal">
                                            <span class="material-symbols-outlined">
                                                forum
                                                </span>
                                        </button>
    
                                    </div>
    
    
                                </div>
                        </div>


                        @foreach($messages as $message)
                        <div class="media mb-3">
                            <!-- Sender Avatar -->
                            <img src="{{ asset('placeholder-avatar.jpg') }}" class="mr-3 rounded-circle" alt="Sender Avatar">
                            <div class="media-body">
                                <!-- Sender Name -->
                                <h5 class="mt-0">
                                    {{ optional($message->sender)->username ?? 'Unknown User' }}
                                </h5>
                                <p>{{ Str::limit($message->content, 10) }}</p>
                                @if ($message->sender)
                                    <a href="{{ route('conversation.show', $message->sender->id) }}">View Conversation</a>
                                @else
                                    <span>Conversation Link Unavailable</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="media mb-3">
                            <!-- Recipient Avatar -->
                            <img src="{{ asset('placeholder-avatar.jpg') }}" class="mr-3 rounded-circle" alt="Recipient Avatar">
                            <div class="media-body">
                                <!-- Recipient Name -->
                                <h5 class="mt-0">
                                    {{ optional($message->recipientUser)->username ?? 'Unknown User' }}
                                </h5>
                                <p>{{ Str::limit($message->content, 10) }}</p>
                                @if ($message->recipientUser)
                                    <a href="{{ route('conversation.show', $message->recipientUser->id) }}">View Conversation</a>
                                @else
                                    <span>Conversation Link Unavailable</span>
                                @endif
                            </div>
                        </div>
                        
                        
                        @endforeach


                        
                    </div>
                </div>
    
                <!-- Active Users or Friends Section -->
                <div class="col-md-4 mt-5">
                    <div class="active--now mx-5 px-5">
                            <h3 class=" mb-3 ">Active Now</h3>
                            <!-- Dummy active users with circular avatars -->
                            <div class="media mb-3">
                                <img src="https://picsum.photos/id/1024/48/48" class="mr-3 rounded-circle" alt="Avatar">
                                <div class="media-body">
                                    <h5 class="mt-0">Active User 1</h5>
                                </div>
                            </div>
                            <div class="media mb-3">
                                <img src="https://picsum.photos/id/1025/48/48" class="mr-3 rounded-circle" alt="Avatar">
                                <div class="media-body">
                                    <h5 class="mt-0">Active User 2</h5>
                                </div>
                            </div>
                            <div class="media mb-3">
                                <img src="https://picsum.photos/id/1026/48/48" class="mr-3 rounded-circle" alt="Avatar">
                                <div class="media-body">
                                    <h5 class="mt-0">Active User 3</h5>
                                </div>
                            </div>
                    </div>
                </div>
    
            </div>
        </div>
    </main>
    
    
    
    
@endsection
