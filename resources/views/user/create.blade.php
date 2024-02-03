@extends('master')

@section('content')
    <div class="container">
        <h2>Create a New Blog</h2>

        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category_id" id="category" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
