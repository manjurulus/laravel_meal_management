@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">All Bills</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ✅ Bill Creation Form --}}
    <div class="card mb-4">
        <div class="card-header">Create New Bill</div>
        <div class="card-body">
            <form method="POST" action="{{ route('bills.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="title" class="form-control" placeholder="Bill Title" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="amount" class="form-control" placeholder="Amount" required min="0">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="due_date" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ✅ Bill Listing --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bill ID</th>
                <th>Title</th>
                <th>Amount</th>
                <th>Due Date</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->title ?? 'N/A' }}</td>
                    <td>৳{{ $bill->amount }}</td>
                    <td>{{ \Carbon\Carbon::parse($bill->due_date)->format('Y-m-d') }}</td>
                    <td>{{ $bill->created_at->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td colspan="5">
                        {{-- ✅ Assignment Form --}}
                        <form method="POST" action="{{ route('bills.assign', $bill->id) }}" class="row g-3 align-items-end">
                            @csrf
                            <div class="col-md-3">
                                <label for="user_id_{{ $bill->id }}" class="form-label">User</label>
                                <select name="user_id" id="user_id_{{ $bill->id }}" class="form-select" required>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="paid_amount_{{ $bill->id }}" class="form-label">Paid Amount</label>
                                <input type="number" name="paid_amount" id="paid_amount_{{ $bill->id }}" class="form-control" required min="0">
                            </div>
                            <div class="col-md-2">
                                <label for="payment_date_{{ $bill->id }}" class="form-label">Payment Date</label>
                                <input type="date" name="payment_date" id="payment_date_{{ $bill->id }}" class="form-control">
                            </div>
                            <div class="col-md-2 d-grid">
                                <button type="submit" class="btn btn-success">Assign</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No bills found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection