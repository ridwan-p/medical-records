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
                <form action="{{ route('dashboard.journals.index') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="{{ __('Search') }}" value="{{request()->search}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mb-3">
            @forelse ($journals as $index => $journal)
                <div class="card col-md-12 mb-3">
                    <div class="card-body">
                        <p>nama : {{$journal->patient->name}}</p>
                        <p>therapy : {{ implode(',', $journal->therapy) }}</p>
                        <p>anamnese : {{ implode(',', $journal->anamnese) }}</p>
                        <p>diagnosis : {{ implode(',', $journal->diagnosis) }}</p>
                        <p>medications : {{ optional($journal->medications)->pluck('name')->implode(',') }}</p>
                        <p>note : {{ $journal->note }}</p>
                    </div>
                </div>
            @empty
                This is empty ....
            @endforelse
        </div>
    </div>
@endsection
