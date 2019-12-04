@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h6 class="card-title">{{$patient->name}}</h6>
				<a href="{{ route('dashboard.patients.edit', ['patient' => $patient]) }}" class="btn btn-sm btn-primary">Edit</a>
			</div>
			<div class="card-body">
				name: {{$patient->name}}
			</div>
		</div>
	</div>
@endsection