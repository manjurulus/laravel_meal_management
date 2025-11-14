@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">All Members</h2>
<table class="w-full bg-white shadow">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
