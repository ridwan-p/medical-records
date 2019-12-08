@extends('layouts.app')

@section('content')
	<form action="{{ route('dashboard.journals.store') }}" method="POST" class="container" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12"><h3>{{__('Create')}}</h3></div>
		</div>
		@csrf
		<div class="row">
			<div class="form-group col-md-6">
				<label for="name">{{ __("Patient") }}</label>
				<select name="patient_id" id="patient_id" class="form-control">
					@foreach ($patients as $patient)
						<option value="{{$patient->id}}">{{$patient->name}}</option>
					@endforeach
				</select>
				@error('name')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
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
				<button class="btn btn-primary">Submit</button>				
			</div>
		</div>
	</form>
@endsection