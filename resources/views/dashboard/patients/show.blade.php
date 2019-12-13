@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session('success'))
			<div class="alert alert-success">{{session('success')}}</div>
		@endif
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 my-3">
				<h4><strong>{{$patient->name}}</strong> {{ __('Medical Record') }}</h4>
			</div>
			<div class="col-md-6 my-3 d-flex justify-content-end">
				<a href="{{ route('dashboard.patients.edit', ['patient' => $patient]) }}" class="btn btn-primary mx-1">{{__('Edit')}}</a>
				<a href="{{ route('dashboard.patients.destroy', ['patient' => $patient]) }}" data-action='destroy' data-target="#form-delete-patient" class="btn btn-danger mx-1">{{__('Delete')}}</a>
				<form id='form-delete-patient' method="POST">
					@method('DELETE')
					@csrf
				</form>
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
						<p class="my-0">{{ $patient->age }} {{ __('Year') }}</p>
						<p class="my-0">{{ $patient->gender ? __('Male') : __("Female") }}</p>
					{{-- 	@if (!empty($patient->latestJournals()))
							<p class="my-0 text-muted"> {{$patient->latestJournals()->created_at->diffForHumans()}}</p>
                        @endif --}}
					</div>
				</div>
				<div class="card my-3">
					<div class="card-body">
						<p class="m-0"><i class="material-icons text-secondary">date_range</i> {{ $patient->place_of_birth }}, {{optional($patient->date_of_birth)->format('d M Y')}}</p>
						<p class="m-0"> <i class="material-icons text-secondary">contact_phone</i> {{$patient->phone}}</p>
						<p class="m-0"><i class="material-icons text-secondary">map</i> {{$patient->address}}</p>
						<p class="m-0"><i class="material-icons text-secondary">nature_people</i> {{ __('Blood') }} : {{$patient->blood}}</p>
					</div>
				</div>
				<div class="card my-3">
					<div class="card-header border-bottom-0 bg-white">
						<h6 class="m-0">{{__('Allergies')}}</h6>
					</div>
					<div class="card-body pt-0">
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
				<div class="card my-3" >
					<div class="card-header border-bottom-0 bg-white">
						<h6 class="m-0"><strong>{{$patient->name}}</strong> {{__('Medical Journal')}}</h6>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3">
								<a href="{{ route('dashboard.patients.journals.add', ['patient' => $patient]) }}" class="btn btn-primary mb-3">{{__('Add')}}</a>
							</div>
							@php
				                $color=[ 'primary', 'info', 'warning', 'danger' , 'success'];
				            @endphp
							@forelse ($journals as $index => $journal)
								<div class="col-md-12 ">
									<div class="card mb-3 border-{{$color[$index % 5]}}" style="border-left: 1em solid">
					                    <div class="card-body">
					                    	<h5 class="my-0">{{__('Anamnese')}}</h5>
				                            <p class="mb-1">{{ implode(', ', $journal->anamnese) }}</p>
			                                <h5 class="my-0">{{__('Diagnosis')}}</h5>
			                                <p class="mb-1">{{ implode(', ', $journal->diagnosis) }}</p>
				                            <p class="mb-1">{{__('Created at')}} : {{ $journal->created_at->diffForHumans() }}</p>
					                    </div>
					                    <div class="card-footer">
					                        <a href="{{ route('dashboard.patients.journals.edit', ['journal' => $journal]) }}" class="btn btn-link">{{__('Edit')}}</a>
					                    </div>
					                </div>
								</div>
							@empty
								<div class="col-md-12">
									<div class="alert alert-info" role="alert">This is empty ....</div>
								</div>
							@endforelse
						</div>
						<nav class="mb-3">
							{{ $journals->links() }}
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection