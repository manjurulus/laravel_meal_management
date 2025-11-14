@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Create Bill from Member Meals</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('bills.storeFromMeals') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label for="user_id" class="form-label">Select Member</label>
                <select name="user_id" class="form-select" required>
                    <option value="" disabled selected>Choose member</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="rate" class="form-label">Rate per Meal (৳)</label>
                <input type="number" name="rate" class="form-control" required min="0" value="100">
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Generate Bill</button>
        </div>
    </form>
</div>
@endsection