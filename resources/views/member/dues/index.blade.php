@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Bill Dues</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Bill Title</th>
                <th>Total Amount</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Payment Date</th>
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
</div>
@endsection