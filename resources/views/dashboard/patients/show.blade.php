@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6 my-3">
				<h4><strong>{{$patient->name}}</strong> {{ __('Medical Record') }}</h4>
			</div>
			<div class="col-md-6 my-3 d-flex justify-content-end">
				<a href="{{ route('dashboard.patients.edit', ['patient' => $patient]) }}" class="btn btn-primary mx-1">Edit</a>
				<a href="{{ route('dashboard.patients.destroy', ['patient' => $patient]) }}" class="btn btn-danger mx-1">Delete</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 px-2">
				<div class="card my-3">
					<div class="p-3 d-flex justify-content-center">
						<img src="{{ asset($patient->photo['medium'] ?? 'images/user.svg') }}" class="img-fluid rounded-circle" alt="avatar default">
					</div>
					<div class="card-body text-center">
						<h5 class="font-weight-bold">{{$patient->name}}</h5>
						<p class="my-0 font-italic">{{ __('Parent') }}  : {{ $patient->parent }}</p>
						<p class="my-0">{{ $patient->age }} {{ __('old') }}</p>
						<p class="my-0">{{ $patient->gender ? __('Male') : __("Female") }}</p>
						<p class="my-0 text-muted"> 2 days ago</p>
					</div>
				</div>
				<div class="card my-3">
					<div class="card-body">
						<p class="m-0"><i class="fas fa-phone"></i> {{ $patient->place_of_birth }}, {{$patient->date_of_birth->format('d M Y')}}</p>
						<p class="m-0"> <i class="fas fa-phone"></i> {{$patient->phone}}</p>
						<p class="m-0"><i class="fas fa-phone"></i> {{$patient->address}}</p>
						<p class="m-0"><i class="fas fa-phone"></i> {{ __('Blood') }} : {{$patient->blood}}</p>
					</div>
				</div>
				<div class="card my-3">
					<div class="card-header border-bottom-0 bg-white">
						<h6 class="m-0">{{__('Allergies')}}</h6>
					</div>
					<div class="card-body">
						<ul class="pl-3">
							@forelse ($patient->allergies as $allergie)
								<li>{{ $allergie }}</li>
							@empty
								this is empty ....
							@endforelse
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9 px-2">
				<div class="card my-3">
					<div class="card-header border-bottom-0 bg-white">
						<h6 class="m-0"><strong>{{$patient->name}}</strong> {{__('Medical Journal')}}</h6>
					</div>
					<div class="card-body">
						<a href="{{ route('dashboard.patients.journals.add', ['patient' => $patient]) }}" class="btn btn-primary mb-3">Add</a>
						@forelse ($patient->journals as $journal)
							<div class="card col-md-12 mb-3 bg-light">
			                    <div class="card-body">
			                        <p>therapy : {{ implode(',', $journal->therapy) }}</p>
			                        <p>anamnese : {{ implode(',', $journal->anamnese) }}</p>
			                        <p>diagnosis : {{ implode(',', $journal->diagnosis) }}</p>
			                        <p>medications : {{ optional($journal->medications)->pluck('name')->implode(',') }}</p>
			                        <p>note : {{ $journal->note }}</p>
			                        <p>created_at : {{ $journal->created_at->diffForHumans() }}</p>
			                    </div>
			                    <div class="card-footer">
			                        <a href="{{ route('dashboard.journals.edit', ['journal' => $journal]) }}" class="btn btn-link">edit</a>
			                    </div>
			                </div>
						@empty
							This is empty ....
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection