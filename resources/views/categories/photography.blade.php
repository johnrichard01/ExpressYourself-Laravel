@extends('master')
@section('title', 'Photography')
@section('css')
<link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/universal.css">
<link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/category.css">
@endsection
@section('content')
@if (auth()->check())
            @include('inc.userNav')
        @else
            @include('inc.navbar')
    @endif
<div class="container-fluid p-0">
    <div class="container-fluid categ-container px-0 py-5">
        <h1 class="categ-title fw-bold text-center">Photography</h1>
    </div>
    <div class="third-section mt-3 pb-5">
        <div class="container d-flex flex-lg-row flex-column">
            <div class="col-12 col-lg-9">
                <div class="mb-5">
                    <h2 class="section-title fw-bold text-lg-start text-center">Recent Posts</h2>
                </div>
                @if (count($blogs)== 0)
                        <p>No blogs found</p>
                    @else
                        @foreach ($blogs as $blog)
                            <x-recent-card :blog='$blog'/>
                        @endforeach
                    @endif
                   <div class="d-flex justify-content-start">
                    {!!$blogs->links()!!}
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
                                    <a href="/category/artwork" class="w-100 categ-btn btn btn-lg btn-artwork fw-bold">
                                        Artwork
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3">
                                    <a href="/category/craft" class="w-100 categ-btn btn btn-lg btn-craft fw-bold">
                                        Craft
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3">
                                    <a href="/category/literature" class="w-100 categ-btn btn btn-lg btn-literature fw-bold">
                                        Literature
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3 ">
                                    <a href="/category/photography" class="w-100 categ-btn btn btn-lg btn-photography fw-bold">
                                        Photography
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="popular-container">
                    <div class=" mb-5">
                        <h2 class="section-title fw-bold  text-lg-start text-center">Most Popular</h2>
                    </div>
                <div class="d-flex flex-wrap justify-content-center gap-lg-2 gap-4">
                    @if (count($populars)== 0)
                        <p>No blogs found</p>
                    @else
                        @foreach ($populars as $popular)
                            <x-popular :popular='$popular'/>
                        @endforeach
                    @endif
                </div>
                </div>
                <!-- next topic -->
            </div>
        </div>
    </div>
</div>
@include("inc.footer")
@endsection
@section('javascript')
    <script src="{{asset('assets/js/universal.js')}}"></script>
@endsection