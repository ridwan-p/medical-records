@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">
				<h3>Create</h3>

				<form action="{{ route('dashboard.patients.store') }}" class="col-md-6 offset-md-3" method="POST">
					@csrf
					<div class="form-group">
						<label for="name">{{ __("Name") }}</label>
						<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" autofocus>
						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="address">{{ __("Address") }}</label>
						<textarea name="address" id="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
						@error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="date_of_birth">{{ __("Date of birth") }}</label>
						<input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" value="{{old('date_of_birth')}}" autofocus>
						@error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="place_of_birth">{{ __("Place of birth") }}</label>
						<input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" name="place_of_birth" id="place_of_birth" value="{{old('place_of_birth')}}" autofocus>
						@error('place_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="gender">{{ __("Gender") }}</label>
						<div class="form-check">
							<input type="radio" id="gender-m" name="gender" value="m" class="form-check-input @error('gender') is-invalid @enderror" @if(old('gender') === 'm') checked @endif>
							<label for="gender-m" class="form-check-label">{{__('Male')}}</label>
						</div>
						<div class="form-check">
							<input type="radio" id="gender-f" name="gender" value="f" class="form-check-input @error('gender') is-invalid @enderror" @if(old('gender') === 'f') checked @endif>
							<label for="gender-f" class="form-check-label">{{__('Female')}}</label>
						</div>
						@error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>	
					<div class="form-group">
						<label for="blood">{{ __("Blood") }}</label>
						<div class="form-check">
							<input type="radio" id="blood-a" name="blood" value="a" class="form-check-input @error('blood') is-invalid @enderror" @if(old('blood') === 'a') checked @endif>
							<label for="blood-a" class="form-check-label">A</label>
						</div>
						<div class="form-check">
							<input type="radio" id="blood-b" name="blood" value="b" class="form-check-input @error('blood') is-invalid @enderror" @if(old('blood') === 'b') checked @endif>
							<label for="blood-b" class="form-check-label">B</label>
						</div>
						<div class="form-check">
							<input type="radio" id="blood-ab" name="blood" value="ab" class="form-check-input @error('blood') is-invalid @enderror" @if(old('blood') === 'ab') checked @endif>
							<label for="blood-ab" class="form-check-label">AB</label>
						</div>
						<div class="form-check">
							<input type="radio" id="blood-o" name="blood" value="o" class="form-check-input @error('blood') is-invalid @enderror" @if(old('blood') === 'o') checked @endif>
							<label for="blood-o" class="form-check-label">O</label>
						</div>
						@error('blood')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>	
					<div class="form-group">
						<label for="phone">{{ __("Contact") }}</label>
						<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{old('phone')}}" autofocus>
						@error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>	
					<div class="form-group">
						<label for="parent">{{ __("Parent") }}</label>
						<input type="text" class="form-control @error('parent') is-invalid @enderror" name="parent" id="parent" value="{{old('parent')}}" autofocus>
						@error('parent')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>	
					<div class="form-group">
						<label for="allergies">{{ __("Allergies") }}</label>
						<input type="text" class="form-control @error('allergies') is-invalid @enderror" name="allergies[]" id="allergies" value="{{old('allergies[]')}}" autofocus>
						@error('allergies')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>	
					<button class="btn btn-primary">Submit</button>				
				</form>
			</div>
		</div>
	</div>
@endsection