@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Profile</h2>
<p><strong>Name:</strong> {{ auth()->user()->name }}</p>
<p><strong>Email:</strong> {{ auth()->user()->email }}</p>
<p><strong>Role:</strong> {{ auth()->user()->role }}</p>
@endsection