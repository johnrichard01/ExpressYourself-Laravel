@extends('master')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/userdash.css')}}">
@endsection
@section('content')
@include('inc.navbar')

    <header>
        
        <div class="activities"><h1>Activities</h1></div>
        
    </header>

    <section class="activities-container">
        @foreach($userActivities as $activity)
            <div class="activity-card">
                <h2>{{ $activity->title }}</h2>
                <p>{{ $activity->description }}</p>
                <a href="#" class="btn">View Details</a>
            </div>
        @endforeach
    </section>
