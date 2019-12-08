@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row mb-3">
			<div class="col-md-9">
				<a href="{{ route('dashboard.patients.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
			</div>
			<div class="col-md-3">
				<div class="input-group">
					<input type="search" class="form-control" placeholder="{{ __('Search') }}">
					<div class="input-group-append">
						<button class="btn btn-primary" type="button" id="button-addon2">{{ __('Search') }}</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			@forelse ($patients as $patient)
				<div class="col-md-3 my-1 px-1">
					<div class="card">
						<div class="card-body">
							<div class="media">
								<img src="{{ asset('images/user.svg') }}" alt="defaul avatar" width="60" class="align-self-center mr-3">
								<div class="media-body">
									<h6 class="font-weight-bolder my-0">{{ $patient->name }}</h6>
									<p class="my-0 font-italic">{{ __('Parent') }}  : {{ $patient->parent }}</p>
									<p class="my-0">{{ $patient->birth }}</p>
									<p class="my-0">{{ $patient->gender ? __('Male') : __("Female") }}</p>
									<p class="my-0 text-muted"> 2 days ago</p>
								</div>
							</div>
						</div>
						<div class="card-footer text-center">
							<a href="{{ route('dashboard.patients.show', ['patient' => $patient]) }}" class="btn btn-link">{{ __('Details') }}</a>
						</div>
					</div>
				</div>
			@empty
				Data is empty ....
			@endforelse
		</div>
	{{-- 	<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<h3 class="m-0">Patients</h3>
					<a href="{{ route('dashboard.patients.create') }}" class="btn btn-sm btn-primary">{{ __('Add') }}</a>
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
									<td>
										<a href="{{ route('dashboard.patients.show', ['patient' => $patient]) }}" class="btn btn-sm btn-primary">{{ __('Show') }}</a>
										<a href="{{ route('dashboard.patients.edit', ['patient' => $patient]) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
										<a href="{{ route('dashboard.patients.destroy', ['patient' => $patient]) }}" class="btn btn-sm btn-primary" data-action="destroy" data-target="#destroy-patient" data-message="{{ __('Are you sure to delete this item?') }}">{{ __('Delete') }}</a>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="8">Data is empty...</td>
								</tr>
							@endforelse
						</tbody>
					</table>
					<form id="destroy-patient" method="POST">
						@csrf
						@method('DELETE')
					</form>
				</div>
			</div>
		</div> --}}
	</div>
@endsection