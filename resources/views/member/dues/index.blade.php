@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Bill Dues</h2>

    {{-- ✅ Aggregated Dues --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bill Title</th>
                <th>Total Amount</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Latest Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bills as $bill)
                <tr>
                    <td>{{ $bill['title'] }}</td>
                    <td>৳{{ number_format($bill['total'], 2) }}</td>
                    <td>৳{{ number_format($bill['paid'], 2) }}</td>
                    <td>৳{{ number_format($bill['due'], 2) }}</td>
                    <td>{{ $bill['payment_date'] ?? '—' }}</td>
                </tr>
            @empty
                <tr><td colspan="5">No bills assigned.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- ✅ Payment History --}}
    <h3 class="mt-5 mb-3">Payment History</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Method</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date ?? $payment->created_at->format('Y-m-d') }}</td>
                    <td>৳{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ ucfirst($payment->method) }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No payments made.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection