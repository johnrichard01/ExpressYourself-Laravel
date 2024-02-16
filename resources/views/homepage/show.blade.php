@extends('master')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('tite', $blog->title)
@section('css')
<link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/view.css')}}">
@endsection
@section('content')
@include('inc.navbar')
<div class="container-fluid p-0">
    <div class="container-fluid categ-container px-0 py-5">
        <!-- <a href="#" class="text-decoration-none back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            back
        </a> -->
        <div class="container">
            <h1 class="categ-title fw-bold text-start">{{$blog->title}}</h1>
            <p class="author-view">by: {{$author->username}}</p>
        </div>
    </div>
    <div class="third-section mt-3 pb-5">
        <div class="container d-flex flex-lg-row flex-column">
            <div class="col-12 col-lg-9 px-5">
                <div class="content">
                    <div class="show-image d-flex justify-content-center">
                        <img src="{{$blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('assets/images/nothumbnail.png')}}" alt="">
                    </div> 
                </div>
                <div class="desc-container mt-5">
                    <div class="description">
                            {!!$blog->description!!}

                            @if(auth()->check() && auth()->user()->bookmarks)
                                @if(auth()->user()->bookmarks->contains('blog_id', $blog->id))
                                    <form action="{{ route('bookmarks.unbookmark', $blog) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Unbookmark</button>
                                    </form>
                                @else
                                <form action="{{ route('bookmarks.bookmark', $blog) }}" method="POST">
                                        @csrf
                                        <button type="submit">Bookmark</button>
                                    </form>
                                @endif
                            @endif
                    </div>

                    <div class="comments-container">

                        <!-- Assuming you have a container element with id "comments-container" -->
                        <ul id="comments-container">
                            @foreach ($comments as $comment)
                                <li>
                                    <img src="{{$comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('assets/images/noprofile.png')}}" alt="Profile Picture" class="profile-icon img-fluid rounded-circle">
                                    <span class="username"><b>{{ $comment->user->username }}</b></span>

                                    <!-- Display the comment text -->
                                    <div class="comment-body">
                                        {{ $comment->comment_text }}
                                    </div>

                                    <!-- Like Button for each comment -->
                                    <button class="like-button" data-comment-id="{{ $comment->id }}">Like</button>

                                    <!-- Reply Link for each comment -->
                                    <a href="#" class="reply" data-comment-id="{{ $comment->id }}">Reply</a>

                                    <!-- Display replies for this comment -->
                                        @if ($comment->replies->count() > 0)
                                        <ul class="replies-list">
                                            @foreach ($comment->replies as $reply)
                                                <li class="reply">
                                                    <img src="{{ optional($reply->user)->avatar ? asset('storage/' . $reply->user->avatar) : asset('assets/images/noprofile.png') }}" alt="Profile Picture" class="profile-icon img-fluid rounded-circle">
                                                    <span class="username"><b>{{ optional($reply->user)->username }}</b></span>

                                                    <!-- Display the reply text -->
                                                    <div class="comment-body">
                                                        {{ $reply->reply_text }}
                                                    </div>

                                                    <!-- Like Button for each reply -->
                                                    <button class="like-button" data-reply-id="{{ $reply->id }}">Like</button>

                                                    <!-- Reply Link for each reply -->
                                                    <a href="#" class="reply-link" data-comment-id="{{ $comment->id }}" data-parent-reply-id="{{ $reply->id }}">Reply</a>

                                                    <!-- Nested Reply Form for this reply -->
                                                    <div class="nested-reply-form" data-comment-id="{{ $comment->id }}" data-parent-reply-id="{{ $reply->id }}" style="display:none;">
                                                        <h4>Reply{{ optional($reply->user)->username }}</h4>
                                                        @auth
                                                            <form action="{{ route('comments.storeReply', ['comment' => $comment->id]) }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="parent_reply_id" value="{{ $reply->id }}">
                                                                <div class="form-group">
                                                                    <textarea name="reply_text" id="reply_text" class="form-control" rows="4" required></textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit Reply</button>
                                                            </form>
                                                        @else
                                                            <p>Please <a href="{{ route('login') }}"><b><i>log in</i></b></a> to leave a reply.</p>
                                                        @endauth

                                                                    <!-- Nested Reply Form for this reply - Added a class for styling -->
                                                            <div class="nested-reply-form reply-form" data-comment-id="{{ $comment->id }}" data-parent-reply-id="{{ $reply->id }}" style="display:none;">
                                                                <h4>Reply to {{ optional($reply->user)->username }}'s comment</h4>
                                                                @auth
                                                                    <form action="{{ route('comments.storeReply', ['comment' => $comment->id]) }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="parent_reply_id" value="{{ $reply->id }}">
                                                                        <div class="form-group">
                                                                            <textarea name="reply_text" id="reply_text" class="form-control" rows="4" required></textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Submit Reply</button>
                                                                    </form>
                                                                @else
                                                                    <p>Please <a href="{{ route('login') }}"><b><i>log in</i></b></a> to leave a reply.</p>
                                                                @endauth
                                                            </div>


                                                    </div>

                                                    
                                                </li>
                                            @endforeach
                                        </ul>
                                        @endif

                                    <div class="reply-form" data-comment-id="{{ $comment->id }}" style="display:none;">
                                        <h4>Reply to {{ $comment->user->username }}'s comment</h4>
                                        @auth
                                            <form action="{{ route('comments.storeReply', ['comment' => $comment->id]) }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="reply_text" id="reply_text" class="form-control" rows="4" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Reply</button>
                                            </form>
                                        @else
                                            <p>Please <a href="{{ route('login') }}"><b><i>log in</i></b></a> to leave a reply.</p>
                                        @endauth
                                    </div>
                                </li>
                            @endforeach
                        </ul>


                        <!-- New Comment Form -->
                        <div class="comment-form">
                            <h3>Add a Comment</h3>
                            <form id="new-comment-form" action="{{ route('comments.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <div class="form-group">
                                    <label for="comment_text">Comment:</label>
                                    <textarea name="comment_text" id="comment_text" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Comment</button>
                            </form>
                        </div>

                        <!-- Nested Reply Form for a reply -->
                        <div class="nested-reply-form" data-comment-id="1" data-parent-reply-id="1" style="display:none;">
                            <h4>Reply to User123's comment</h4>
                            <form id="new-reply-form" action="{{ route('comments.storeReply', ['comment' => 1]) }}" method="post">
                                @csrf
                                <input type="hidden" name="parent_reply_id" value="1">
                                <div class="form-group">
                                    <label for="reply_text">Reply:</label>
                                    <textarea name="reply_text" id="reply_text" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Reply</button>
                            </form>
                        </div>

                    </div>


                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="container-fluid pb-5 pt-3 mb-3">
                    <div class="mb-4">
                        <h2 class="section-title fw-bold text-lg-start text-center">Categories</h2>
                    </div>
                    <div class="second-section">
                        <div class="container">
                            <div class="d-flex flex-wrap">
                                <div class="d-flex justify-content-center col-12 mb-3">
                                    <a href="/category/?category=artwork" class="w-100 categ-btn btn btn-lg btn-artwork fw-bold">
                                        Artwork
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3">
                                    <a href="/category/?category=craft" class="w-100 categ-btn btn btn-lg btn-craft fw-bold">
                                        Craft
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3">
                                    <a href="/category/?category=literature" class="w-100 categ-btn btn btn-lg btn-literature fw-bold">
                                        literature
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3 ">
                                    <a href="/category/?category=photography" class="w-100 categ-btn btn btn-lg btn-photography fw-bold">
                                        Photography
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="container popular-container">
                    <div class=" mb-5">
                        <h2 class="section-title fw-bold  text-lg-start text-center">Most Popular</h2>
                    </div>
                <div class="d-flex flex-wrap justify-content-center gap-lg-2 gap-4 px-3">
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- next topic -->
            </div>
        </div>
    </div>
</div>
@include('inc.footer')
@endsection
@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{asset('assets/js/universal.js')}}"></script>
    <script src="{{asset('assets/js/comments.js')}}"></script>
@endsection