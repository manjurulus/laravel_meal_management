@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Add Expense</h2>
<form method="POST" action="{{ route('expenses.store') }}">
    @csrf
    <input type="text" name="category" placeholder="Category" required class="w-full mb-2 p-2 border">
    <input type="number" name="amount" placeholder="Amount" required class="w-full mb-2 p-2 border">
    <input type="date" name="date" required class="w-full mb-2 p-2 border">
    <textarea name="note" placeholder="Note" class="w-full mb-2 p-2 border"></textarea>
    <button type="submit" class="bg-green-600 text-white px-4 py-2">Save</button>
</form>
@endsection