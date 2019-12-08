@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row mb-3">
			<h4>{{ __('Patients') }}</h4>
		</div>
		<div class="row mb-3">
			<div class="col-md-9 px-1">
				<a href="{{ route('dashboard.patients.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
			</div>
			<div class="col-md-3 px-1">
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
				<div class="col-md-3 my-1 px-1">
					<div class="card card-patient">
						<div class="card-body">
							<div class="media">
								<img src="{{ asset($patient->photo ?? 'images/user.svg') }}" alt="defaul avatar" width="60" class="align-self-center mr-3">
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
	</div>
@endsection