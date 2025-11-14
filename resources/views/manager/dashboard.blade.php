@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Manager Dashboard</h2>
<p>Welcome, {{ auth()->user()->name }}!</p>
@include('manager.members.index')
@endsection