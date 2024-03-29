@extends('master')
@section('title', 'Profile Settings')
@section('css')
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/admin-nav.css">
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/edit-profile.css">
@endsection
@section('content')
@include('inc.admin-navbar')
@include('inc.admin-sidebar')
@if (session('success'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-success flash-messages">
        {{ session('success') }}
    </div>
@endif
        <main>

            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center mt-5">

                        <h1 class="prof--head">Profile Settings
                            <span class="material-symbols-outlined">
                            settings
                            </span></h1>

                    </div>
                </div>
            </div>
            

            <div class="container mt-5">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-profile-form">
                    @csrf
                    @method('PATCH')

                            <!-- Update Avatar -->
                            <div class="form-group">
                                <div class="current-avatar">
                                    @if($currentUser->avatar)
                                        <img id="cropperImage" src="{{ asset('storage/' . $currentUser->avatar) }}" alt="Current Avatar" class="avatar-img img-thumbnail">
                                    @else
                                        <img id="cropperImage" src="{{ asset('assets/images/noprofile.png') }}" alt="No Avatar" class="avatar-img img-thumbnail">
                                    @endif
                                </div>
                                <input type="file" name="new_avatar" id="new_avatar" class="avatar-input form-control-file">
                                    <!-- Bio -->

                                    <hr>

                                <div class="row">
                                    <div class="col mt-3">

                                        <div class="form-group">
                                            <label for="bio" class="bio-label">Bio:</label>
                                            <textarea name="bio" id="bio" class="bio-textarea form-control mt-2">{{ old('bio', $currentUser->bio) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col mt-3">
                                        <!-- Username -->
                                        <div class="form-group">
                                            <label for="username" class="username-label">Username:</label>
                                            <input type="text" name="username" id="username" class="username-input form-control mt-2" value="{{ old('username', $currentUser->username) }}">
                                        </div>
                                    </div>

                                    <div class="col mt-3">
                                        <!-- Gender -->
                                        <div class="form-group">
                                            <label for="gender" class="gender-label">Gender:</label>
                                            <select name="gender" id="gender" class="gender-select form-control mt-2">
                                                <option value="male" {{ old('gender', $currentUser->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', $currentUser->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('gender', $currentUser->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col mt-3">
                                        
                                    <!-- City -->
                                        <div class="form-group">
                                            <label for="city" class="city-label">Location:</label>
                                            <input type="text" name="city" id="city" class="city-input form-control mt-2" value="{{ old('city', $currentUser->city) }}">
                                        </div>
                                    </div>

                                </div>

                                
                                <div class="row">
                                    <div class="col mt-3">

                                        <!-- First Name -->
                                        <div class="form-group">
                                            <label for="first_name" class="first-name-label">First Name:</label>
                                            <input type="text" name="first_name" id="first_name" class="first-name-input form-control mt-2" value="{{ old('first_name', $currentUser->first_name) }}">
                                        </div>

                                    </div>

                                    <div class="col mt-3">

                                        <!-- Last Name -->
                                        <div class="form-group">
                                            <label for="last_name" class="last-name-label">Last Name:</label>
                                            <input type="text" name="last_name" id="last_name" class="last-name-input form-control mt-2" value="{{ old('last_name', $currentUser->last_name) }}">
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col submit--update">
                                        <!-- Update Profile Button -->
                                        <button type="submit" class="btn update--btn">Update Profile</button>

                                    </div>
                                </div>
                </form>
            </div>
        </main>
@endsection

@section('javascript')
    <!-- Bootstrap JS, Popper.js, and Cropper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://expressyourself-laravel-production.up.railway.app/assets/js/admin-nav.js"></script>
@endsection
