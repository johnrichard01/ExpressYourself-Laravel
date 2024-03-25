@extends('master')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/universal.css">
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/index.css">
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/userHome.css">
@endsection

@section('content')
@include('inc.userNav')
@if (session('success'))
<div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-success flash-messages">
    {{ session('success') }}
</div>
@endif

    <main>
        <div class="container my--container">
            <!-- Feed Section -->
            <div class="title-container">
                <div class="container  pt-5">
                    <h1 class="fw-bold title-hero text-center">Palette Picks: Latest and Greatest in the Art World</h1>
                </div>
            </div>
        
            <div class="feed-section mt-5">
                <div class="container-fluid">
                    @isset($blogs)
                        @if($blogs->isEmpty())
                            <p>No blogs found</p>
                        @else
                            @foreach ($blogs as $blog)
                                <div class="feed-card mb-lg-5  mt-lg-5">
                                    <div class="blog-title">
                                        <h2>{{ $blog->title }}</h2>
                                    </div>
                                    <div class="blog-meta">
                                        <p>Posted by {{ $blog->user->name }} on {{ $blog->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <img class="img-fluid blog-thumbnail" src="{{ $blog->thumbnail ? asset('storage/app/public/' . $blog->thumbnail) : asset('assets/images/nothumbnail.png') }}" alt="">
                                    <div class="blog-content">
                                        {{ $blog->about }}
                                    </div>
                                    <div class="read-container">
                                        <a href="/blogs/{{ $blog->id }}" class="read-more-btn">Read more</a>
                                    </div>
                                    @auth
                                        <div>
                                            @if(auth()->user()->bookmarks)
                                                @if(auth()->user()->bookmarks->contains('blog_id', $blog->id))
                                                    <form action="{{ route('bookmarks.unbookmark', $blog) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="book--remove btn  py-0 px-4" type="submit">
                                                            <span class="material-symbols-outlined remove--bm">
                                                                bookmark
                                                            </span>
                                                            <p class="mt-3">Remove</p>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('bookmarks.bookmark', $blog) }}" method="POST">
                                                        @csrf
                                                        <button class="book--add btn p-0 px-3" type="submit">
                                                            <span class="material-symbols-outlined add--bm">
                                                                bookmark
                                                            </span>
                                                            <p class="mt-3">Bookmark</p>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    @endauth
                                </div>
                            @endforeach
                        @endif
                    @else
                        <p>No blogs found</p>
                    @endisset
                </div>
            </div>
        

                    </div>
                </div>
            </div>
        </div>
    </main>
@include('inc.footer')
@endsection
@section('javascript')
    <script src="https://expressyourself-laravel-production.up.railway.app/assets/js/universal.js"></script>
@endsection