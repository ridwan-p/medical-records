@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<h3 class="m-0">Patients</h3>
					<a href="{{ route('dashboard.patients.create') }}" class="btn btn-sm btn-primary">Add</a>
				</div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Age</th>
								<th>Blood</th>
								<th>Gender</th>
								<th>Parent</th>
								<th>Allergies</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($patients as $index => $patient)
								<tr>
									<td>{{$patients->firstItem() + $index}}</td>
									<td>{{$patient->name}}</td>
									<td>{{$patient->age}}</td>
									<td>{{$patient->blood}}</td>
									<td>{{$patient->gender}}</td>
									<td>{{$patient->parent}}</td>
									<td>{{implode(',', $patient->allergies)}}</td>
									<td>{{$patient->name}}</td>
								</tr>
							@empty
								<tr>
									<td colspan="8">Data is empty...</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection