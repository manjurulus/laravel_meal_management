@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required class="w-full mb-2 p-2 border">
        <input type="password" name="password" placeholder="Password" required class="w-full mb-2 p-2 border">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Login</button>
    </form>
</div>
@endsection