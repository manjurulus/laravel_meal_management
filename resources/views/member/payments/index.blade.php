@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Payments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Method</th>
                <th>Date</th> <!-- ✅ Add this column -->
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>৳{{ $payment->amount }}</td>
                    <td>{{ ucfirst($payment->method ?? 'N/A') }}</td>
                    <td>{{ $payment->created_at->format('d-m-Y') }}</td> <!-- ✅ Show created_at -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection