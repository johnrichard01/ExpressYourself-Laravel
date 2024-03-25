@extends('master')
@section('title', 'My blogs')
@section('css')
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/universal.css">
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/myblogs.css">
@endsection
@section('content')
@include('inc.userNav')
@if (session('success'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-success flash-messages">
        {{ session('success') }}
    </div>
    @endif
{{-- modal for deleting user --}}
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/blogs/{blog}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Blog</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="user_delete_id" id="user_id">
                Are you sure you want to delete this blog ?
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
              </div>
        </form>
      </div>
    </div>
  </div>
{{-- content --}}
<div class="container-fluid title-container py-5">
    <h1 class="fw-bold text-center create-title">My Blogs</h1>
</div>
<div class="container-fluid">
    <div class="container mt-5">
        <div class="table-container d-flex justify-content-center">
            <table class="col-10 d-flex flex-wrap justify-content-center">
                <tbody class="w-100">
                    @unless ($blogs->isEmpty())
                        @foreach ($blogs as $blog)
                        <tr class="table-row d-flex flex-wrap justify-content-between align-items-center py-3">
                            <td class="col-2">
                                <div class="w-100 d-flex flex-wrap justify-content-center">
                                    <img class="manage-thumbnail" src="{{$blog->thumbnail ? asset('storage/app/public/' . $blog->thumbnail) : asset('assets/images/nothumbnail.png')}}" alt="">
                                </div>
                            </td>
                            <td class="col-6">
                                <a href="/blogs/{{$blog->id}}" class="text-decoration-none fw-bold title-blog">{{$blog->title}}</a>
                            </td>
                            <td class="col-2">
                                <div class="w-100 d-flex flex-wrap justify-content-center">
                                    <a href="/blogs/{{$blog->id}}/edit" class="btn btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                          </svg>
                                        Edit
                                    </a>
                                </div>
                            </td>
                            <td class="col-2">
                                <div class="w-100 d-flex flex-wrap justify-content-center">
                                    {{-- <form method="POST" action="/blogs/{{$blog->id}}" class="form-delete">
                                        @csrf
                                        @method('DELETE') --}}
                                        <button class="btn btn-delete" value="{{$blog->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                          </svg>Delete
                                        </button>
                                    {{-- </form> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p class="text-center">NO BLOGS FOUND</p>
                            </td>
                        </tr>
                    @endunless
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('inc.footer')
@endsection
@section('javascript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/universal.js')}}"></script>
    <script src="{{asset('assets/js/myblogs.js')}}"></script>
@endsection
