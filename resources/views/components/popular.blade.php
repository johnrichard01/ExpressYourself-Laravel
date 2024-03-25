@props(['popular'])
<div class="popular-content mb-4">
    <div class="popular-categ mb-2 d-flex align-items-center justify-content-center justify-content-lg-start">
        <div class="popular-box col-6 d-flex align-items-center justify-content-center">
            {{$popular->category}}
        </div>
    </div>
    <div class="popular-title d-flex justify-content-center justify-content-lg-start">
        <a href="/blogs/{{$popular->id}}" class="text-decoration-none">
            <h6 class="popular-title text-lg-start text-center fs-4">{{$popular->title}}</h6>
        </a>
    </div>
    <div class="author-container  d-flex align-items-center justify-content-center justify-content-lg-start  ">
        <div class="name-container lead fw-bold">
            {{$popular->user->username}}
        </div>
        <div class="author-time lead">
            -{{$popular->created_at}}
        </div>
    </div>
</div>