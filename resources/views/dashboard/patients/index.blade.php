@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session('success'))
			<div class="alert alert-success">
				<strong>{{ __('Success') }} !</strong> {{ __(session('success')) }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
		@endif
		<div class="row mb-3">
			<h4 class="p-2 m-0">{{ __('Patient') }}</h4>
		</div>
		<div class="row mb-3">
			<div class="col-md-9 p-2 d-inline-flex flex-row">
				<a href="{{ route('dashboard.patients.create') }}" class="btn btn-primary mr-2"><i class="material-icons">post_add</i> {{ __('Add') }}</a>
				<button class="btn btn-info import-file" data-target=".import-file-upload"><i class="material-icons">library_add</i> Import</button>

				<form action="{{ route('dashboard.patients.import.list') }}" id="form-import" method="POST" enctype='multipart/form-data'>
					@csrf
					<input type="file" name="file" class="d-none import-file-upload">
				</form>
			</div>
			<div class="col-md-3 p-2">
				<form action="{{ route('dashboard.patients.index') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="{{ __('Search') }}" value="{{request()->search}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
		<div class="table-responsive rounded-top">
			<table class="table table-striped">
				<thead class="bg-primary text-white">
					<tr>
						{{-- <th>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="all-patient">
								<label class="custom-control-label" for="all-patient"></label>
							</div>
						</th> --}}
						<th>{{__('No')}}</th>
						<th>{{__('Name')}}</th>
						<th>{{__('Code')}}</th>
						<th>{{__('Address')}}</th>
						<th>{{__('Date of birth')}}</th>
						<th>{{__('Age')}}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@forelse ($patients as $index => $patient)
						<tr>
							{{-- <td>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input patient" id="patient-{{$index}}">
									<label class="custom-control-label" for="patient-{{$index}}"></label>
								</div>
							</td> --}}
							<td>{{ $patients->firstItem() + $index }}</td>
							<td>
								<a href="{{ route('dashboard.patients.show', ['patient' => $patient]) }}"><img src="{{ asset($patient->photo['medium'] ?? 'images/user.svg') }}" alt="defaul avatar" width="30" class="rounded-circle"> {{$patient->name}}</a>
							</td>
							<td>{{$patient->code}}</td>
							<td>{{ $patient->address }}</td>
							<td>{{ optional($patient->date_of_birth)->format("d M Y") }}</td>
							<td>{{ $patient->age }} </td>
							<td>
								<div class="dropdown">
								    <button class="btn btn-outline-primary btn-icon material-icons" type="button" id="dropdownMenuButton" data-toggle="dropdown">more_horiz</button>
								    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								        <a class="dropdown-item" href="{{ route('dashboard.patients.show', ['patient' => $patient]) }}"><i class="material-icons">remove_red_eye</i> {{ __('Show') }}</a>
								        <a class="dropdown-item" href="{{ route('dashboard.patients.edit', ['patient' => $patient]) }}"><i class="material-icons">edit</i>  {{ __('Edit') }}</a>
								        <a class="dropdown-item" data-action='destroy' data-target="#form-delete-patient" data-message="{{ __('Are you sure delete it') }} !!!" href="{{ route('dashboard.patients.destroy', ['patient' => $patient]) }}"><i class="material-icons">delete_outline</i> {{ __('Delete') }}</a>
								    </div>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="8">{{ __('Data is empty') }} ...</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		{{ $patients->links() }}
	</div>

	<form id='form-delete-patient' method="POST">
		@method('DELETE')
		@csrf
	</form>
@endsection