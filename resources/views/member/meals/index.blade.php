@extends('layouts.app')

@section('content')
<h2 class="mb-4">My Meals</h2>

{{-- Meal Entry Form --}}
<form method="POST" action="{{ route('meals.store') }}" class="mb-4">
    @csrf
    <div class="row g-2">
        <div class="col-md-4">
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="col-md-4">
            <input type="number" name="quantity" class="form-control" placeholder="Meal count" required>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Add Meal</button>
        </div>
    </div>
</form>

{{-- Meal List --}}
@if($meals->count())
    <ul class="list-group">
        @foreach($meals as $meal)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $meal->date }}
                <span class="badge bg-success rounded-pill">{{ $meal->quantity }} meals</span>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-muted">No meals recorded yet.</p>
@endif
@endsection