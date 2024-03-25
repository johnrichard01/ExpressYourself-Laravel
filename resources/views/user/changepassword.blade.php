@extends('master')
@section('title', 'Change password')
@section('css')
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/universal.css">
    <link rel="stylesheet" href="https://expressyourself-laravel-production.up.railway.app/assets/css/change-password.css">
@endsection
@section('content')
@include('inc.userNav')
@if (session('success'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-success flash-messages">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
<div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-danger flash-messages">
    {{ session('error') }}
</div>
@endif
<div class="container-fluid">
    <div class="container d-flex flex-wrap justify-content-center py-5">
        <div class="card col-6 my-5">
            <div class="card-header">
              Change Password
            </div>
            <div class="card-body">
               
               <form action="/change-password/update" id="change_password_form" method="post" novalidate> 
                  @csrf
                 <div class="form-group">
                  <label for="old_password">Old Password</label>
                  <input type="password" name="old_password" class="form-control" id="old_password" required>
              
                  @if($errors->any('old_password'))
                    <span class="text-danger">{{$errors->first('old_password')}}</span>
                  @endif
                  <div class="form__error--message text-center mt-3" id="oldpasserror"></div>
                </div>
                <div class="form-group">
                  <label for="password">New Password</label>
                  <input type="password" name="new_password" class="form-control" id="new_password" required>
                  @if($errors->any('new_password'))
                    <span class="text-danger">{{$errors->first('new_password')}}</span>
                  @endif
                  <div class="form__error--message text-center mt-3" id="newpasserror"></div>
                </div>
                <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                  @if($errors->any('confirm_password'))
                    <span class="text-danger">{{$errors->first('confirm_password')}}</span>
                  @endif
                  <div class="form__error--message text-center mt-3" id="cpasserror"></div>
                </div>
          
                <button type="submit" class="btn btn-primary mt-3" id="update_password">Update Password</button>
              </form>
            </div>
          </div>
    </div>
</div>

@include('inc.footer')

@endsection

@section('javascript')
    <script src="{{asset('assets/js/universal.js')}}"></script>
    <script src="{{asset('assets/js/change-password.js')}}"></script>
@endsection
