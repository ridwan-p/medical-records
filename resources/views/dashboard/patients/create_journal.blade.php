@extends('layouts.app')

@section('content')
	<form action="{{ route('dashboard.patients.journals.store', ['patient' => $patient]) }}" method="POST" class="container">
		@csrf
		<div class="row">
			<div class="col-md-12"><h3>{{__('Create')}} {{__('Medical Journal')}} <strong>{{$patient->name}}</strong> </h3></div>
		</div>
		<div class="row">

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
				<tags-input valid="@error('diagnosis.*.name') is-invalid @enderror" value="{{old('diagnosis-text')}}" name="diagnosis" object="name"></tags-input>
				<searching-tags url="/local-api/diagnosis" column="name"></searching-tags>
				{{-- <search-component url="/local-api/diagnosis" column="name"></search-component> --}}
				@error('diagnosis.*.name')
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
			</div>
		</div>
	</form>
@endsection