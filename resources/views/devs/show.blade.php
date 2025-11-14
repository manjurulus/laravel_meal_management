@extends('layouts.app')
@section('content')
    <div class="wrap shadow">
        <a href="{{route('dev.index')}}" class="btn btn-primary">Back</a><br><br>
		<div class="card">
			<div class="card-body">
				<h1>{{$dev -> name}}</h1>
				<h3>{{$dev -> age}}</h3>
				<h3>{{$dev -> skill}}</h3>
				<h3>{{$dev -> location}}</h3>
				
			</div>
		</div>
	</div>
@endsection
