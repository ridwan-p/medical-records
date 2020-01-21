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
	<div class="container">
		<div class="row">
			<form action="{{ route('dashboard.patients.journals.store', ['patient' => $patient]) }}" method="POST" class="col-md-6">
				<h3 class="mb-3">{{__('Create')}} {{__('Medical Journal')}} <strong>{{$patient->name}}</strong></h3>
				@csrf
				<div class="form-group">
					<label for="anamnese">{{ __('Anamnese') }} <span class="text-danger">*</span></label>
					<tags-input valid="@error('anamnese.*') is-invalid @enderror" value="{{old('anamnese-text')}}" name="anamnese"></tags-input>
					@error('anamnese.*')
		                <small class="d-block text-danger" role="alert">
		                    <strong>{{ $message }}</strong>
		                </small>
		            @enderror
				</div>
				<div class="form-group">
					<label for="physical_report">{{ __('Physical Report') }}</label>
					<tags-input valid="@error('physical_report.*') is-invalid @enderror" value="{{old('physical_report-text')}}" name="physical_report"></tags-input>

					@error('physical_report.*')
		                <small class="d-block text-danger" role="alert">
		                    <strong>{{ $message }}</strong>
		                </small>
		            @enderror
				</div>
				<div class="form-group">
					<label for="diagnosis">{{ __('Diagnosis') }} <span class="text-danger">*</span></label>
					<tags-input valid="@error('diagnosis.*.name') is-invalid @enderror" value="{{ old('diagnosis-text') }}" name="diagnosis" object="name"></tags-input>

					{{-- <autocomplate-select url="{{ route('local-api.diagnosis.index') }}" label="name" name="diagnosis"></autocomplate-select> --}}

					@error('diagnosis.*.name')
		                <small class="d-block text-danger" role="alert">
		                    <strong>{{ $message }}</strong>
		                </small>
		            @enderror
				</div>
				<div class="form-group">
					<label for="medications">{{ __('Medications') }} <span class="text-danger">*</span></label>
					<tags-input valid="@error('medications.*.name') is-invalid @enderror" value="{{old('medications-text')}}" name="medications" object="name"></tags-input>
					@error('medications.*.name')
		                <small class="d-block text-danger" role="alert">
		                    <strong>{{ $message }}</strong>
		                </small>
		            @enderror
				</div>
				<div class="form-group">
					<label for="note">{{ __("Note") }}</label>
					<textarea name="note" id="note" cols="30" rows="10" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
					@error('note')
		                <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
				</div>

				<div class="form-group">
					<button class="btn btn-primary">{{__('Submit')}}</button>
					<a href="{{ route('dashboard.patients.show', ['patient' => $patient]) }}" class="btn btn-outline-primary">{{ __('Back') }}</a>
				</div>
			</form>
			<div class="col-md-6">
				<div class="table-responsive rounded-top bg-white">
					<table class="table table-striped">
						<thead class="bg-primary text-white">
							<tr>
								<th>{{ __('No') }}</th>
                                <th>{{ __('Anamnese') }}</th>
                                <th>{{ __('Diagnosis') }}</th>
                                <th>{{ __('Medications') }}</th>
                                <th>{{ __('Created at') }}</th>
							</tr>
						</thead>
		            	<tbody>
				            @forelse ($patient->journals as $index => $journal)
				            		<tr>
				            			<td>{{ $index + $patient->journals->firstItem() }}</td>
				            			<td>{{ implode(', ', $journal->anamnese) }}</td>
				            			<td>{{ $journal->diagnosis->implode('name', ', ') }}</td>
				            			<td>{{ $journal->medications->implode('name', ', ') }}</td>
				            			<td>{{ optional($journal->created_at)->diffForHumans() }}</td>
				            		</tr>
				            @empty
				                <tr>
				                	<td colspan="5">{{__('Data is empty')}}</td>
				                </tr>
				            @endforelse
		            	</tbody>
					</table>
				</div>
	            {{ $patient->journals->links() }}
			</div>
		</div>
	</div>
		{{-- <div class="row">
			<div class="col-md-12"></div>
		</div> --}}
@endsection