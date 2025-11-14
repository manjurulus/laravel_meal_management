@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Received Payments</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->user->name ?? 'Unknown' }}</td>
                    <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                    <td>৳{{ $payment->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection