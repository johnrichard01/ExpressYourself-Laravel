@extends('master')
@section('title', $user->username . "'s Profile")
@section('css')

@endsection

@section('content')
@include('inc.userNav')

    <main>
        <div class="container mt-5">
            <div class="profile-header">
                <img src="{{ asset('storage/app/public/' . $user->avatar) }}" alt="User Avatar" class="avatar-img">
                <h1>{{ $user->username }}</h1>
            </div>

            <div class="profile-posts">
                <h2>Posts</h2>
                @foreach($user->posts as $post)
                    <div class="post">
                        <p>{{ $post->content }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('inc.footer')
@endsection

@section('javascript')
    <!-- Bootstrap JS, Popper.js, and Cropper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/js/universal.js')}}"></script>
@endsection
