@extends('layouts.app')

@section('content')
	<form action="{{ route('dashboard.journals.update', ['journal' => $journal]) }}" method="POST" class="container" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-md-12"><h3>{{__('Edit')}} {{__('Journal')}}</h3></div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="patient_id">{{ __("Patient") }} <span class="text-danger">*</span></label>
				<select name="patient_id" id="patient_id" class="form-control">
					@foreach ($patients as $patient)
						<option value="{{$patient->id}}" @if(old('patient_id', $journal->patient_id)) selected @endif>{{$patient->name}}</option>
					@endforeach
				</select>
				@error('patient_id')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

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