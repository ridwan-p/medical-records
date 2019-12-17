@extends('layouts.app')

@section('content')
	<div class="container px-1">
		@if(session('success'))
			<div class="alert alert-success">
				<strong>{{ __('Success') }} !</strong> {{ __(session('success')) }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
		@endif
	</div>
	<div class="container">
		<div class="row mb-3">
			<h4 class="p-2 m-0">{{ __('Patient') }}</h4>
		</div>
		<div class="row mb-3">
			<div class="col-md-9 p-2">
				<a href="{{ route('dashboard.patients.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
				<form action="{{ route('dashboard.patients.export.list') }}" method="POST" enctype='multipart/form-data'>
					@csrf
					<input type="file" class="form-control" name="file">
					<button class="btn btn-primary">Export</button>
				</form>
				{{-- <a href="{{ route('dashboard.patients.exportList') }}" class="btn btn-primary">{{ __('Export') }}</a> --}}
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
		<div class="row">
			@forelse ($patients as $patient)
				<div class="col-lg-3 col-md-4 p-2">
					<div class="card card-patient">
						<div class="card-body">
							<div class="media">
								<img src="{{ asset($patient->photo['medium'] ?? 'images/user.svg') }}" alt="defaul avatar" width="60" class="align-self-center mr-3 rounded-circle">
								<div class="media-body">
									<h6 class="font-weight-bolder my-0">{{ $patient->name }}</h6>
									<p class="my-0 font-italic">{{ __('Code') }}  : {{ $patient->code }}</p>
									<p class="my-0">{{ __('Parent') }}  : {{ $patient->parent }}</p>
									<p class="my-0">{{ $patient->birth }}</p>
									<p class="my-0">{{ $patient->gender ? __('Male') : __("Female") }}</p>
									@if (!empty($patient->latestJournals()))
										<p class="my-0 text-muted"> {{$patient->latestJournals()->created_at->diffForHumans()}}</p>
									@endif
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
			<nav class="col-12 my-1">{{$patients->links()}}</nav>
		</div>
	</div>
@endsection