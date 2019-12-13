@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session('success'))
			<div class="alert alert-success">{{session('success')}}</div>
		@endif
	</div>
	<form action="{{ route('dashboard.patients.journals.update', ['journal' => $journal]) }}" method="POST" class="container">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-md-12"><h3>{{__('Edit')}} <strong>{{$patient->name}}</strong>  {{__('Medical Journal')}}</h3></div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<label for="therapy">{{ __('Therapy') }} <span class="text-danger">*</span></label>
				<input type="text" class="form-control @error('therapy.*') is-invalid @enderror" id='therapy' name="therapy[]" value={{ old('therapy[]', $journal->therapy[0]) }}>
				@error('therapy.*')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="anamnese">{{ __('Anamnese') }} <span class="text-danger">*</span></label>
				<input type="text" class="form-control @error('anamnese.*') is-invalid @enderror" id='anamnese' name="anamnese[]" value={{ old('anamnese[]', $journal->anamnese[0]) }}>
				@error('anamnese.*')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="diagnosis">{{ __('Diagnosis') }} <span class="text-danger">*</span></label>
				<input type="text" class="form-control @error('diagnosis.*') is-invalid @enderror" id='diagnosis' name="diagnosis[]" value={{ old('diagnosis[]', $journal->diagnosis[0]) }}>
				@error('diagnosis.*')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="medications">{{ __('Medications') }} <span class="text-danger">*</span></label>
				<input type="text" class="form-control @error('medications.*.name') is-invalid @enderror" id='medications' name="medications[][name]" value={{ old('medications[][name]', $journal->medications[0]->name) }}>
				@error('medications.*.name')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="note">{{ __("Note") }}</label>
				<textarea name="note" id="note" cols="30" rows="10" class="form-control @error('note') is-invalid @enderror">{{ old('note', $journal->note) }}</textarea>
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