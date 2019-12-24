@extends('layouts.app')

@section('content')
	<form action="{{ route('dashboard.journals.store') }}" method="POST" class="container" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-md-12"><h3>{{__('Create')}}</h3></div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="patient_id">{{ __("Patient") }} <span class="text-danger">*</span></label>
				<select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror">
					@foreach ($patients as $patient)
						<option value="{{$patient->id}}" @if(old('patient_id')) selected @endif>{{$patient->name}}</option>
					@endforeach
				</select>
				@error('patient_id')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

{{-- 			<div class="form-group col-md-12">
				<label for="therapy">{{ __('Therapy') }} <span class="text-danger">*</span></label>
				<tags-input valid="@error('therapy.*') is-invalid @enderror" value="{{old('therapy-text')}}" name="therapy"></tags-input>
				@error('therapy.*')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div> --}}

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
				<tags-input valid="@error('diagnosis.*') is-invalid @enderror" value="{{old('diagnosis-text')}}" name="diagnosis"  object="name"></tags-input>
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
				<label for="action">{{ __('Action') }}</label>
				<tags-input valid="@error('action.*') is-invalid @enderror" value="{{old('action-text')}}" name="action"></tags-input>

				@error('action.*')
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
				<a href="{{ route('dashboard.journals.index') }}" class="btn btn-outline-primary">{{ __('Back') }}</a>
			</div>
		</div>
	</form>
@endsection