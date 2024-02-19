@extends('master')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('tite', $blog->title)
@section('css')
<link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/view.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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

                            <div>
                                @if(auth()->check() && auth()->user()->bookmarks)
                                    @if(auth()->user()->bookmarks->contains('blog_id', $blog->id))
                                        <form action="{{ route('bookmarks.unbookmark', $blog) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="book--remove btn" type="submit">
                                                <span class="material-symbols-outlined remove--bm">
                                                    bookmark                                               
                                                </span>

                                                <p class="mt-3">Remove</p>
                                                
                                            </button>
                                        </form>
                                    @else
                                    <form action="{{ route('bookmarks.bookmark', $blog) }}" method="POST">
                                            @csrf
                                            <button class="book--add btn py-0 px-3" type="submit">
                                                <span class="material-symbols-outlined add--bm">
                                                    bookmark
                                                </span>
                                                <p class="mt-3">Bookmark</p>
                                            </button>
                                        </form>
                                    @endif
                                @endif

                            </div>

                                    <!-- COMMENTS -->
                                    <div class="comments">
                                        <ul id="comments-container">
                                            @foreach ($comments as $comment)
                                                <li class="comment---lists">

                                                    <!-- Display the comment text, AVATAR, USERNAME -->

                                                    <div class="comment-body">
                                                        <img src="{{$comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('assets/images/noprofile.png')}}" alt="Profile Picture"
                                                            class="profile__myAvatar img-fluid rounded-circle">
                                                        <span class="username"><b>{{ $comment->user->username }}</b></span>
                                                        {{ $comment->comment_text }}
                                                    </div>

                                                    <button class="like-button" data-comment-id="{{ $comment->id }}" data-reply-id="">
                                                        <span class="material-symbols-outlined">
                                                            thumb_up
                                                        </span>
                                                    </button>
                                                    
                                                    <span class="like-count" id="like-count-{{ $comment->id }}-"> {{ $comment->likes_count }} </span>
                                                    
                                                        <!-- Reply Link for each comment -->
                                                        <a href="#" class="reply-link" data-comment-id="{{ $comment->id }}" data-parent-reply-id="0">
                                                            <span class="material-symbols-outlined">
                                                                add_comment
                                                            </span>
                                                        </a>

                                                        <!-- Replies link for each comment -->
                                                        @if ($comment->replies->count() > 0)
                                                            <a href="#" class="replies" data-comment-id="{{ $comment->id }}">
                                                                <span class="material-symbols-outlined">
                                                                    forum
                                                                </span>
                                                            </a>
                                                            <!-- Display replies for this comment -->
                                                            <ul class="replies-list" id="replies-list-{{ $comment->id }}" style="display: none;">
                                                                @foreach ($comment->replies as $reply)
                                                                    <li class="reply">
                                                                        <!-- Display the reply text -->
                                                                        <div class="comment-body">
                                                                            <img src="{{ optional($reply->user)->avatar ? asset('storage/' . $reply->user->avatar) : asset('assets/images/noprofile.png') }}"
                                                                                alt="Profile Picture" class="profile--avatar img-fluid rounded-circle">
                                                                            <span class="username"><b>{{ optional($reply->user)->username }}</b></span>
                                                                            {{ $reply->reply_text }}
                                                                        </div>

                                                                        <!-- Like Button for each reply -->
                                                                        <button class="like-button" data-comment-id="{{ $comment->id }}" data-reply-id="{{ $reply->id }}">
                                                                            <span class="material-symbols-outlined">
                                                                                thumb_up
                                                                            </span>
                                                                        </button>

                                                                        <!-- Display the like count for each reply -->
                                                                        <span class="like-count" id="like-count-{{ $reply->id }}">{{ $reply->likes_count }}</span>

                                                                        <!-- Reply Link for each reply -->
                                                                        <a href="#" class="reply-link" data-comment-id="{{ $comment->id }}" data-parent-reply-id="{{ $reply->id }}">
                                                                            <span class="material-symbols-outlined">
                                                                                add_comment
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                        @endif

                                                    <!-- Reply Form for all comments -->
                                                    <form class="reply-form" data-comment-id="{{ $comment->id }}" style="display:none;">
                                                        <h4>Reply to {{ $comment->user->username }}'s comment</h4>
                                                        @auth
                                                            <div class="form-group">
                                                                <textarea name="reply_text" class="form-control" rows="4" placeholder="Type your reply" required></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit Reply</button>
                                                        @else
                                                            <p>Please <a href="{{ route('login') }}"><b><i>log in</i></b></a> to leave a reply.</p>
                                                        @endauth
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                    <!-- New Comment Form -->
                                    <div class="comment-form">
                                        <h4>Add a Comment</h4>
                                        <form id="new-comment-form" action="{{ route('comments.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                            <div class="form-group">
                                                <textarea name="comment_text" class="form-control" rows="4" placeholder="Type your comment" required></textarea>
                                            </div>
                                            <button type="submit" class="btn submit--comment">Submit</button>
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
    <script src="{{asset('assets/js/replies.js')}}"></script>
    <script src="{{asset('assets/js/like.js')}}"></script>
@endsection