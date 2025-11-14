@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="container text-center">
        <h1>Welcome to the Meal Management System</h1>
        <p class="lead">Track meals, manage bills, and streamline your operations.</p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary mt-4">Login</a>
        @endguest

        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-success mt-4">Go to Dashboard</a>
        @endauth
    </div>
</div>
@endsection