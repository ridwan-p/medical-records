@extends('layouts.app')

@section('content')
	<form action="{{ route('dashboard.patients.journals.store', ['patient' => $patient]) }}" method="POST" class="container">
		@csrf
		<div class="row">
			<div class="col-md-12"><h3>{{__('Create')}} <strong>{{$patient->name}}</strong>  {{__('Medical Journal')}}</h3></div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<label for="therapy">{{ __('Therapy') }} <span class="text-danger">*</span></label>
				<tags-input valid="@error('therapy.*') is-invalid @enderror" value="{{old('therapy-text')}}" name="therapy"></tags-input>

				@error('therapy.*')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="anamnese">{{ __('Anamnese') }} <span class="text-danger">*</span></label>
				<tags-input valid="@error('anamnese.*') is-invalid @enderror" value="{{old('anamnese-text')}}" name="anamnese"></tags-input>
				@error('anamnese.*')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="diagnosis">{{ __('Diagnosis') }} <span class="text-danger">*</span></label>
				<tags-input valid="@error('diagnosis.*') is-invalid @enderror" value="{{old('diagnosis-text')}}" name="diagnosis"></tags-input>
				@error('diagnosis.*')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="medications">{{ __('Medications') }} <span class="text-danger">*</span></label>
				<tags-input valid="@error('medications.*.name') is-invalid @enderror" value="{{old('medications-text')}}" name="medications" object="name"></tags-input>
				@error('medications.*.name')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="note">{{ __("Note") }}</label>
				<textarea name="note" id="note" cols="30" rows="10" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
				@error('note')
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