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
	<form action="{{ route('dashboard.patients.update', ['patient' => $patient]) }}" method="POST" class="container" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-md-12">
				<h3>{{__('Edit')}} <b>{{$patient->name}}</b></h3>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label for="name">{{ __("Name") }} <span class="text-danger">*</span></label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name', $patient->name)}}" autofocus>
				@error('name')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>
			<div class="form-group col-md-6">
				<label for="parent">{{ __("Parent") }}</label>
				<input type="text" class="form-control @error('parent') is-invalid @enderror" name="parent" id="parent" value="{{old('parent', $patient->parent)}}" autofocus>
				@error('parent')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

			<div class="form-group col-md-6">
				<label for="place_of_birth">{{ __("Place of birth") }}</label>
				<input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" id="place_of_birth" value="{{old('place_of_birth', $patient->place_of_birth)}}" autofocus>
				@error('place_of_birth')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>
			<div class="form-group col-md-6">
				<label for="date_of_birth">{{ __("Date of birth") }}</label>
				<input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" value="{{old('date_of_birth', $patient->date_of_birth->format("Y-m-d"))}}" autofocus>
				@error('date_of_birth')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

			<div class="form-group col-md-6">
				<label for="gender" class="d-block">{{ __("Gender") }} <span class="text-danger">*</span></label>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="gender-m" name="gender" value="m" class="custom-control-input @error('gender') is-invalid @enderror" @if(old('gender', $patient->gender) === 'm') checked @endif>
					<label for="gender-m" class="custom-control-label">{{__('Male')}}</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="gender-f" name="gender" value="f" class="custom-control-input @error('gender') is-invalid @enderror" @if(old('gender', $patient->gender) === 'f') checked @endif>
					<label for="gender-f" class="custom-control-label">{{__('Female')}}</label>
				</div>
				@error('gender')
	                <small class="text-danger d-block" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-6">
				<label for="blood" class="d-block">{{ __("Blood") }}</label>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="blood-a" name="blood" value="a" class="custom-control-input @error('blood') is-invalid @enderror" @if(old('blood', $patient->blood) === 'a') checked @endif>
					<label for="blood-a" class="custom-control-label">A</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="blood-b" name="blood" value="b" class="custom-control-input @error('blood') is-invalid @enderror" @if(old('blood', $patient->blood) === 'b') checked @endif>
					<label for="blood-b" class="custom-control-label">B</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="blood-ab" name="blood" value="ab" class="custom-control-input @error('blood') is-invalid @enderror" @if(old('blood', $patient->blood) === 'ab') checked @endif>
					<label for="blood-ab" class="custom-control-label">AB</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="blood-o" name="blood" value="o" class="custom-control-input @error('blood') is-invalid @enderror" @if(old('blood', $patient->blood) === 'o') checked @endif>
					<label for="blood-o" class="custom-control-label">O</label>
				</div>
				@error('blood')
	                <small class="text-danger d-block" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>


			<div class="form-group col-md-12">
				<label for="address">{{ __("Address") }} <span class="text-danger">*</span></label>
				<textarea name="address" id="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{old('address', $patient->address)}}</textarea>
				@error('address')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>
			<div class="form-group col-md-6">
				<label for="phone">{{ __("Contact") }}</label>
				<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{old('phone', $patient->phone)}}" autofocus>
				@error('phone')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>
			<div class="form-group col-md-6">
				<label for="allergies">{{ __("Allergies") }}</label>
				<tags-input valid="@error('allergies.*') is-invalid @enderror" value="{{old('allergies-text', implode(', ', $patient->allergies))}}" name="allergies"></tags-input>
				@error('allergies.*')
	                <small class="text-danger d-block" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-7">
				<label for="photo">{{ __("Photo") }}</label>
				<div class="input-group mb-3 d-flex align-items-center">
			  		<img src="{{ asset($patient->photo['medium'] ?? 'images/user.svg') }}" alt="photo" class="d-block mr-2 rounded-circle" width="100">
					<div class="custom-file">
						<input type="file" class="custom-file-input  @error('photo') is-invalid @enderror" name="photo" id="file-photo" >
						<label class="custom-file-label" for="file-photo">{{ __('Choose file') }}</label>
					</div>
				</div>
				@error('photo')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<button class="btn btn-primary">{{__('Submit')}}</button>
			</div>
		</div>
	</form>
@endsection