@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">All Users</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection