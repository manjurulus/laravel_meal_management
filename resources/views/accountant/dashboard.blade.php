@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Accountant Dashboard</h2>
<p>Welcome, {{ auth()->user()->name }}!</p>
<a href="{{ route('reports.monthly') }}" class="text-blue-600 underline">View Monthly Report</a>
@endsection
