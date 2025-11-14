@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Welcome, {{ Auth::user()->name }}</h1>

    @php $role = Auth::user()->role; @endphp

    <div class="bg-white p-6 rounded shadow">
        @if ($role === 'member')
            <h2 class="text-xl font-semibold mb-4">Member Panel</h2>
            <ul class="list-disc list-inside space-y-2">
                <li><a href="{{ route('meals.index') }}" class="text-blue-600 hover:underline">Manage Meals</a></li>
                <li><a href="{{ route('payments.index') }}" class="text-blue-600 hover:underline">Make Payments</a></li>
            </ul>
        @elseif ($role === 'manager')
            <h2 class="text-xl font-semibold mb-4">Manager Panel</h2>
            <ul class="list-disc list-inside space-y-2">
                <li><a href="{{ route('bills.index') }}" class="text-blue-600 hover:underline">Manage Bills</a></li>
                <li><a href="{{ route('manager.users.create') }}" class="text-blue-600 hover:underline">Create User</a></li>
                <li><a href="{{ route('manager.members.search') }}" class="text-blue-600 hover:underline">Search Members</a></li>
            </ul>
        @elseif ($role === 'accountant')
            <h2 class="text-xl font-semibold mb-4">Accountant Panel</h2>
            <ul class="list-disc list-inside space-y-2">
                <li><a href="{{ route('reports.monthly') }}" class="text-blue-600 hover:underline">Monthly Reports</a></li>
            </ul>
        @elseif ($role === 'operations')
            <h2 class="text-xl font-semibold mb-4">Operations Panel</h2>
            <ul class="list-disc list-inside space-y-2">
                <li><a href="{{ route('expenses.create') }}" class="text-blue-600 hover:underline">Create Expense</a></li>
            </ul>
        @else
            <p class="text-red-600">No dashboard available for your role.</p>
        @endif
    </div>
</div>
@endsection