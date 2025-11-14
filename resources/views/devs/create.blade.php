@extends('layouts.app')
@section('content')
    <div class="wrap">
		@if($errors -> any())
		{{print_r($errors -> all())}}
		@endif
		<a href="{{route('dev.index')}}" class="btn btn-primary">Back</a><br><br>
		<div class="card shadow">
			<div class="card-body">
				<h2>Create New Devs</h2>
				<form action="{{route('dev.store')}}" method="POST">
					@csrf
					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control" name="name" type="text">
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input class="form-control" name="age" type="text">
					</div>
					<div class="form-group">
						<label for="">Location</label>
						<input class="form-control" name="location" type="text">
					</div>
					<div class="form-group">
						<label for="">Skill</label>
						<input class="form-control" name="skill" type="text">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
