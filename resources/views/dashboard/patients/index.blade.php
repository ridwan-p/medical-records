@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session('success'))
			<div class="alert alert-success">
				<strong>{{ __('Success') }} !</strong> {{ __(session('success')) }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
		@endif

		<h4 class="my-3">{{ __('List Patient') }}</h4>

		<table-patients>
			<form id='form-delete-patient' method="POST">
				@method('DELETE')
				@csrf
			</form>
		</table-patients>
	</div>


@endsection