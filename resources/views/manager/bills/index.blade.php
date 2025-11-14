@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">All Bills (Generated from Meals)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('bills.createFromMeals') }}" class="btn btn-outline-primary">
            ➕ Create Bill from Member Meals
        </a>
    </div>

    <p class="text-muted">Total Bills: {{ $bills->count() }}</p>

    @forelse ($bills as $bill)
        <div class="card mb-4">
            <div class="card-header">
                <strong>{{ $bill->title }}</strong> — ৳{{ number_format($bill->amount, 2) }}
                <span class="float-end">Due: {{ $bill->due_date->format('Y-m-d') }}</span>
            </div>
            <div class="card-body">
                <p><strong>Created At:</strong> {{ $bill->created_at->format('Y-m-d') }}</p>

                <h6>Assigned Member</h6>
                @forelse ($bill->users as $user)
                    <div>
                        {{ $user->name }} —
                        Paid: ৳{{ number_format($user->pivot->paid_amount, 2) }},
                        Date: {{ optional($user->pivot->payment_date)->format('Y-m-d') ?? '—' }}
                    </div>
                @empty
                    <p class="text-muted">No member assigned.</p>
                @endforelse
            </div>
        </div>
    @empty
        <div class="alert alert-info">No bills found.</div>
    @endforelse
</div>
@endsection