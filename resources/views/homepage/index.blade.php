@extends('master')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/index.css')}}">
@endsection
@section('content')
@include('inc.navbar')
<div class="container-fluid">
    <div class="title-container">
        <div class="container mt-5">
            <h1 class="fw-bold title-hero text-center">Discover new stories and creative ideas</h1>
        </div>
    </div>
    <div class="first-section mt-5">
        <div class="container">
            <div class="d-flex flex-wrap">
                <div class="image-container col-12 col-lg d-flex justify-content-center">
                    <img src="https://images.unsplash.com/photo-1682686578707-140b042e8f19?q=80&w=1975&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid hero-image" alt="">
                </div>
                <div class="container col-12 col-lg d-flex flex-wrap align-content-center justify-content-lg-start justify-content-center mx-0 mx-lg-5">
                    <div class="blog-title">
                        <h1 class="fw-bold blog-title text-center text-lg-start mt-3 mt-lg-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h1>
                    </div>
                    <div class="content-container">
                        <p class="lead mt-lg-3 mt-2 hero-desc">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci distinctio quasi non magnam placeat dolor, debitis rerum tempora accusantium unde nesciunt beatae a assumenda molestiae dolorem culpa quis in quos?
                        </p>
                    </div>
                    <div class="read-container">
                        <a href="#" class="btn btn-read text-decoration-none fw-bold" type="button">Read more</a>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <div class="second-section my-5 container-fluid bg-body-tertiary py-5">
        <div class="container">
            <div class="mb-5">
                <h2 class="section-title fw-bold text-lg-start text-center">Categories</h2>
            </div>
            <div class="d-flex flex-wrap">
                <div class="d-flex justify-content-center col-12 col-md-6 col-lg mb-3 mb-md-4 mb-lg-0">
                    <a href="categories/artwork.html" class="w-50 categ-btn btn btn-lg btn-artwork fw-bold">
                        Artwork
                    </a>
                </div>
                <div class="d-flex justify-content-center col-12 col-md-6 col-lg mb-3 mb-md-4 mb-lg-0">
                    <a href="categories/craft.html" class="w-50 categ-btn btn btn-lg btn-craft fw-bold">
                        Craft
                    </a>
                </div>
                <div class="d-flex justify-content-center col-12 col-md-6 col-lg mb-3 mb-md-4 mb-lg-0">
                    <a href="categories/literature.html" class="w-50 categ-btn btn btn-lg btn-literature fw-bold">
                        literature
                    </a>
                </div>
                <div class="d-flex justify-content-center col-12 col-md-6 col-lg mb-3 mb-md-4 mb-lg-0">
                    <a href="categories/photography.html" class="w-50 categ-btn btn btn-lg btn-photography fw-bold">
                        Photography
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="third-section mt-5 pb-5">
        <div class="container d-flex flex-lg-row flex-column">
            <div class="col-12 col-lg-9">
                <div class="mb-5">
                    <h2 class="section-title fw-bold text-lg-start text-center">Recent Posts</h2>
                </div>
                <div class="container-fluid">
                   @foreach ($blogs as $blog)
                    <x-recent-card :blog='$blog'/>
                   @endforeach
                   <div class="d-flex justify-content-start">
                    {!!$blogs->links()!!}
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="popular-container">
                    <div class=" mb-5">
                        <h2 class="section-title fw-bold  text-lg-start text-center">Most Popular</h2>
                    </div>
                <div class="d-flex flex-wrap justify-content-center gap-lg-2 gap-4">
                    <div class="popular-conten mb-4">
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
    <script src="{{asset('assets/js/universal.js')}}"></script>
@endsection