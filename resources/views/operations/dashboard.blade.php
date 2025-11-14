@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Operations Dashboard</h2>
<p>Welcome, {{ auth()->user()->name }}!</p>
<a href="{{ route('expenses.create') }}" class="text-green-600 underline">Add New Expense</a>
@endsection