@extends('layouts.app')
@section('content')
    <div class="wrap shadow">
        <a href="{{url('/dev')}}" class="btn btn-primary">Back</a><br><br>
		<div class="card">
			<div class="card-body">
				<h2>Update Developers</h2>
				<form action="">
					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input class="form-control" type="text">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
