@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-xl font-bold mb-4">
        Monthly Report for {{ \Carbon\Carbon::createFromDate(null, (int) $month)->format('F Y') }}
    </h2>

    {{-- ✅ Meals --}}
    <h3 class="mt-4 font-semibold">Meals</h3>
    <ul>
        @forelse($meals as $meal)
            <li>
                {{ $meal->user->name ?? 'Unknown' }} —
                {{ $meal->date ?? $meal->created_at->format('Y-m-d') }} —
                {{ $meal->quantity ?? 'N/A' }} meals
            </li>
        @empty
            <li>No meals recorded.</li>
        @endforelse
    </ul>

    {{-- ✅ Payments --}}
    <h3 class="mt-4 font-semibold">Payments</h3>
    <ul>
        @forelse($payments as $payment)
            <li>
                {{ $payment->user->name ?? 'Unknown' }} —
                {{ $payment->payment_date ?? $payment->created_at->format('Y-m-d') }} —
                ৳{{ $payment->amount }}
            </li>
        @empty
            <li>No payments recorded.</li>
        @endforelse
    </ul>

    {{-- ✅ Expenses --}}
    <h3 class="mt-4 font-semibold">Expenses</h3>
    <ul>
        @forelse($expenses as $expense)
            <li>
                {{ $expense->created_at->format('Y-m-d') }} —
                {{ $expense->description ?? $expense->category ?? 'Uncategorized' }} —
                ৳{{ $expense->amount }}
            </li>
        @empty
            <li>No expenses recorded.</li>
        @endforelse
    </ul>
</div>
@endsection