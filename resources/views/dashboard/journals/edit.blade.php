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
						<option value="{{$patient->id}}" @if(old('patient_id', $journal->patient_id) == $patient->id) selected @endif>{{$patient->name}}</option>
					@endforeach
				</select>
				@error('patient_id')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="anamnese">{{ __('Anamnese') }} <span class="text-danger">*</span></label>
				<tags-input valid="@error('anamnese.*') is-invalid @enderror" value="{{old('anamnese-text', implode(', ', $journal->anamnese))}}" name="anamnese"></tags-input>
				@error('anamnese.*')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="physical_report">{{ __('Physical Report') }}</label>
				<tags-input valid="@error('physical_report.*') is-invalid @enderror" value="{{old('physical_report-text', implode(', ', $journal->physical_report))}}" name="physical_report"></tags-input>

				@error('physical_report.*')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="diagnosis">{{ __('Diagnosis') }} <span class="text-danger">*</span></label>
				<tags-input valid="@error('diagnosis.*') is-invalid @enderror" value="{{old('diagnosis-text', $journal->diagnosis->implode('name', ', ')) }}" name="diagnosis"  object="name"></tags-input>
				@error('diagnosis.*')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
	            @enderror
			</div>

			<div class="form-group col-md-12">
				<label for="medications">{{ __('Medications') }} <span class="text-danger">*</span></label>
				<tags-input valid="@error('medications.*.name') is-invalid @enderror" value="{{old('medications-text', $journal->medications->implode('name', ', '))}}" name="medications" object="name"></tags-input>
				@error('medications.*.name')
	                <small class="d-block text-danger" role="alert">
	                    <strong>{{ $message }}</strong>
	                </small>
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
				<a href="{{ route('dashboard.journals.index') }}" class="btn btn-outline-primary">{{ __('Back') }}</a>
			</div>
		</div>
	</form>
@endsection