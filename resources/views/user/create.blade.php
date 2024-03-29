@extends('master')
@section('title', 'Create Blog')
@section('css')
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/universal.css">
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/create.css">
     <!-- Summernote CSS - CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->
@endsection
@section('content')
@include('inc.userNav')
    <div class="container-fluid title-container py-5">
        <h1 class="fw-bold text-center create-title">Create New Blog</h1>
    </div>
    <div class="container mt-5">
        <div class="d-flex flex-wrap justify-content-center">
            <form id="createBlogs" action="/blogs/create/store" method="post" enctype="multipart/form-data" class="col-12 col-lg-9 d-flex flex-wrap justify-content-center">
                @csrf
    
                    <div class="form-group col-12">
                        <input type="text" name="title" id="title" placeholder="Title" maxlength="80" class="form-control in-box text-center" required>
                        <div class="char-counter counter-hide" id="charCount"></div>
                    </div>
                    <div class="form__error--message text-center col-12 mt-3" id="titleError"></div>
                    @error('title')
                        <div class="form__error--message text-center">{{$message}}</div>
                    @enderror
                    <div class="row col-12">
                        <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center">
                            <div class="form-group">
                                <select name="category" id="category" class="form-control in-box text-center" required>
                                    <option value="0">--Select Category--</option>
                                    <option value="Artwork">Artwork</option>
                                    <option value="Craft">Craft</option>
                                    <option value="literature">literature</option>
                                    <option value="Photography">Photography</option>
                                </select>
                            </div>
                            <div class="form__error--message text-center col-12 mt-3"  id="categoryError"></div>
                            @error('category')
                                <div class="form__error--message text-center">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center">
                            <div class="form-group">
                                <input type="file" id="thumbnail" name="thumbnail" class="form-control in-box">
                            </div>
                            <div class="form__error--message text-center col-12 mt-3" id="thumbError"></div>
                            @error('thumbnail')
                                <div class="form__error--message text-center">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <textarea name="about" id="about" class="form-control in-box" placeholder="Blog Description" cols="30" rows="3"></textarea>
                        <div class="about-counter counter-hide" id="aboutCount"></div>
                    </div>
                    <div class="form__error--message text-center col-12 mt-3" id="aboutError"></div>
                    @error('about')
                        <div class="form__error--message text-center">{{$message}}</div>
                    @enderror
                    
                <div class="col-12 mt-5">
                    <textarea name="content" id="your_summernote" rows="5" required></textarea>
                </div>
                <div class="form__error--message text-center col-12 mt-3" id="descError"></div>
                @error('category')
                        <div class="form__error--message text-center">{{$message}}</div>
                @enderror
                <div class="d-flex justify-content-center mt-3 col-12">
                    <button type="submit" class="btn btn-post btn-lg col-12 col-lg-5" id="postSubmit">Create Post</button>
                </div>
            </form>
        </div>
    </div>
@include('inc.footer')
@endsection
@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Summernote JS - CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#your_summernote").summernote({
                charset: 'UTF-8',
                placeholder: "Write your content",
                tabsize:2,
                height: 500,
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <!-- //Summernote JS - CDN Link -->
    <script src="https://expressyourself-laravel-production.up.railway.app/assets/js/universal.js"></script>
    <script src="https://expressyourself-laravel-production.up.railway.app/assets/js/create.js"></script>

@endsection
