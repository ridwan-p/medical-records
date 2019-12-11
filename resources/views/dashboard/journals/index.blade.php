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
                <div class="col-md-6 p-1">
                    <div class="card">
                        <div class="card-body">
                            <p>{{__("Name")}} : {{$journal->patient->name}}</p>
                            <p>{{__("Therapy")}} : {{ implode(',', $journal->therapy) }}</p>
                            <p>{{__('Anamnese')}} : {{ implode(',', $journal->anamnese) }}</p>
                            <p>{{__('Diagnosis')}} : {{ implode(',', $journal->diagnosis) }}</p>
                            <p>{{__('Medications')}} : {{ optional($journal->medications)->pluck('name')->implode(',') }}</p>
                            <p>{{__('Note')}} : {{ $journal->note }}</p>
                            <p>{{__('Created at')}} : {{ $journal->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('dashboard.journals.edit', ['journal' => $journal]) }}" class="btn btn-link">{{__('Edit')}}</a>
                        </div>
                    </div>
                </div>
            @empty
                This is empty ....
            @endforelse
        </div>
    </div>
@endsection
