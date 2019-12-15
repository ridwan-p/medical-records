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

	<form action="{{ route('dashboard.profile.update') }}" method="POST" class="container">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-md-12"><h3>{{__('Edit')}}</h3></div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="therapy">{{ __('Name') }} <span class="text-danger">*</span></label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $user->name)}}"  />
				@error('name')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>
			<div class="form-group col-md-6">
				<label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
				<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email', $user->email)}}"  />
				@error('email')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>
			<div class="form-group col-md-6">
				<label for="password">{{ __('Password') }}</label>
				<input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" />
				@error('password')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>
			<div class="form-group col-md-6">
				<label for="password_confirmation">{{ __('Re Password') }}</label>
				<input type="password" id='password_confirmation' class="form-control @error('password') is-invalid @enderror" name="password_confirmation" />
				@error('password')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<button class="btn btn-primary">{{__('Submit')}}</button>
			</div>
		</div>
	</form>
@endsection