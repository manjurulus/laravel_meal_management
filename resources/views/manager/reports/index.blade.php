@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        Monthly Report for {{ now()->format('F Y') }}
    </h2>

    {{-- ✅ Meals --}}
    <h4>Meals</h4>
    <ul>
        @forelse ($meals as $meal)
            <li>
                {{ $meal->user->name ?? 'Unknown' }} —
                {{ $meal->created_at->format('Y-m-d') }} —
                {{ $meal->quantity ?? 'N/A' }} meals
            </li>
        @empty
            <li>No meals recorded.</li>
        @endforelse
    </ul>

    {{-- ✅ Payments --}}
    <h4 class="mt-4">Payments</h4>
    <ul>
        @forelse ($payments as $payment)
            <li>
                {{ $payment->user->name ?? 'Unknown' }} —
                {{ $payment->created_at->format('Y-m-d') }} —
                ৳{{ $payment->amount }}
            </li>
        @empty
            <li>No payments recorded.</li>
        @endforelse
    </ul>

    {{-- ✅ Expenses --}}
    <h4 class="mt-4">Expenses</h4>
    <ul>
        @forelse ($expenses as $expense)
            <li>
                {{ $expense->created_at->format('Y-m-d') }} —
                {{ $expense->description ?? 'No description' }} —
                ৳{{ $expense->amount }}
            </li>
        @empty
            <li>No expenses recorded.</li>
        @endforelse
    </ul>
</div>
@endsection