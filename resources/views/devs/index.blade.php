@extends('layouts.app')

@section('content')
	

<div class="wrap-table">
	
		<a href="{{route('dev.create')}}" class="btn btn-primary">Create New Developer</a><br><br>
		<div class="card shadow">
			<div class="card-body">
				<h2>All Developers</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Age</th>
							<th>Location</th>
							<th>Skill</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($developers as $devs)
						<tr>
							<td>1</td>
							<td>{{$devs -> name}}</td>
							<td>{{$devs -> age}}</td>
							<td>{{$devs -> location}}</td>
							<td>{{$devs -> skill}}</td>
							<td><img src="assets/media/img/pp_photo/istockphoto-615279718-612x612.jpg" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info" href="{{route('dev.show', $devs->id)}}">View</a>
								<a class="btn btn-sm btn-warning" href="#">Edit</a>
								{{-- <a class="btn btn-sm btn-danger" href="{{route('dev.destroy', $devs->id)}}">Delete</a> --}}
								<form class="d-inline" action="{{ route('dev.destroy', $devs->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger btn-sm">Delete</button>
								</form>

							</td>
						</tr>	
						@endforeach
						
						
						

					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection