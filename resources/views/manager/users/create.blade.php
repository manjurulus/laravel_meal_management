@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Create User</h2>

<form method="POST" action="{{ route('manager.users.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Name" required class="w-full mb-2 p-2 border">
    <input type="email" name="email" placeholder="Email" required class="w-full mb-2 p-2 border">
    <input type="password" name="password" placeholder="Password" required class="w-full mb-2 p-2 border">

    <select name="role" required class="w-full mb-4 p-2 border">
        <option value="" disabled selected>Select Role</option>
        <option value="member">Member</option>
        <option value="manager">Manager</option>
        <option value="accountant">Accountant</option>
        <option value="operations">Operations</option>
    </select>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2">Create</button>
</form>
@endsection