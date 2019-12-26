@extends('layouts.app')

@section('content')
	<form action="{{ route('dashboard.patients.journals.store', ['patient' => $patient]) }}" method="POST" class="container">
		@csrf
		<div class="row">
			<div class="col-md-12"><h3>{{__('Create')}} {{__('Medical Journal')}} <strong>{{$patient->name}}</strong> </h3></div>
		</div>
		<div class="row">
			<div class="col-md-6">
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
					<label for="diagnosis">{{ __('Diagnosis') }} <span class="text-danger">*</span></label>
					<tags-input valid="@error('diagnosis.*.name') is-invalid @enderror" value="{{old('diagnosis-text')}}" name="diagnosis" object="name"></tags-input>
					{{-- <searching-tags url="/local-api/diagnosis" column="name"></searching-tags> --}}
					{{-- <search-component url="/local-api/diagnosis" column="name"></search-component> --}}
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
					<label for="action">{{ __('Action') }}</label>
					<tags-input valid="@error('action.*') is-invalid @enderror" value="{{old('action-text')}}" name="action"></tags-input>

					@error('action.*')
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
			</div>
			<div class="col-md-6">
				<div class="table-responsive rounded-top">
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
						{{-- @php
			                $color=[ 'primary', 'info', 'warning', 'danger' , 'success'];
			            @endphp --}}
			            @forelse ($patient->journals as $index => $journal)
			            	<tbody>
			            		<tr>
			            			<td>{{ $index + $patient->journals->firstItem() }}</td>
			            			<td>{{ implode(', ', $journal->anamnese) }}</td>
			            			<td>{{ $journal->diagnosis->implode('name', ', ') }}</td>
			            			<td>{{ $journal->medications->implode('name', ', ') }}</td>
			            			<td>{{ optional($journal->created_at)->diffForHumans() }}</td>
			            		</tr>
			            	</tbody>
		                    {{-- <div class="card border-{{$color[$index % 5]}}" style="border-left: 1em solid">
		                        <div class="card-body row align-items-center">
		                            <h5 class="my-0">{{__('Anamnese')}}</h5>
		                            <p class="mb-1">{{ implode(', ', $journal->anamnese) }}</p>
		                            <h5 class="my-0">{{__('Diagnosis')}}</h5>
		                            <p class="mb-1">{{ $journal->diagnosis->implode('name', ', ') }}</p>
		                            <div class="col-3">
		                            </div>
		                            <div class="col-3 border-left border-light">
		                                <h5 class="font-weight-bold"><i class="material-icons">access_time</i> {{$journal->created_at->format("d F Y h:m")}}</h5>
		                                <p class="my-0">{{__('Created at')}} : {{ $journal->created_at->diffForHumans() }}</p>
		                            </div>
		                            <div class="col-4 border-left border-light d-flex">
		                                <img src="{{ asset(asset($journal->patient->photo['medium'] ?? 'images/user.svg')) }}" alt="avatar" width="50" class="rounded-circle">
		                                <div class="ml-3">
		                                    <h5 class="font-weight-bold">{{$journal->patient->name}}</h5>
		                                    <p class="my-0"><i class="material-icons text-secondary">location_city</i> {{optional($journal->patient)->address}}</p>
		                                    <p class="my-0"><i class="material-icons text-secondary">date_range</i> {{optional($journal->patient->date_of_birth)->format('d F Y')}}</p>
		                                </div>
		                            </div>
		                            <div class="col-2 border-left border-light">
		                                <a href="{{ route('dashboard.journals.edit', ['journal' => $journal]) }}" class="btn btn-primary"> <i class="material-icons">edit</i> {{__('Edit')}}</a>
		                            </div>
		                         </div>
		                    </div> --}}
			               {{--  <div class="col-md-12 p-1">
			                </div> --}}
			            @empty
			                {{__('Data is empty')}}
			            @endforelse
					</table>
				</div>
	            {{ $patient->journals->links() }}
			</div>
		</div>
	</form>
@endsection