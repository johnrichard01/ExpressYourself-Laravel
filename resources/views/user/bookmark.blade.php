@extends('master')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/universal.css') }}">
    <style>
        /* Add your custom styles here */
        .profile-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .blog-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .blog-table th, .blog-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .blog-item a {
            text-decoration: none;
            color: #333;
        }

        .blog-item:hover {
            background-color: #f5f5f5;
        }

    </style>
@endsection

@section('content')
    @include('inc.navbar')

    <div class="container mt-5">

        <h1>Bookmarked Blogs</h1>

        @if($bookmarks->count() > 0)
            <table class="blog-table">
                <thead>
                    <tr>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookmarks as $bookmark)
                        <tr class="blog-item" onclick="window.location='{{ route('blogs.show', $bookmark->blog) }}';" style="cursor: pointer;">
                            <td>
                                <img src="{{ $bookmark->blog->user->avatar ? asset('storage/' . $bookmark->blog->user->avatar) : asset('assets/images/noprofile.png') }}" alt="Author Avatar" class="user-avatar img-fluid">
                                {{ $bookmark->blog->user->username }}
                            </td>

                            <td>
                                {{ $bookmark->blog->title }}
                            </td>

                            <td>
                                {{ $bookmark->blog->description }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No bookmarked blogs yet.</p>
        @endif
    </div>
@endsection

