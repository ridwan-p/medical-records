@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <h4>{{ __('Journal') }}</h4>
        </div>
        <div class="row mb-3">
            <div class="col-md-9 px-1">
                <a href="{{ route('dashboard.journals.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
            </div>
            <div class="col-md-3 px-1">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="{{ __('Search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="button-addon2">{{ __('Search') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
