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

        <h4 class="my-3">{{ __('List Journal') }}</h4>
        <table-journals></table-journals>
        {{-- <div class="d-flex mb-3">
            <div class="col-md-9 px-1">
                <a href="{{ route('dashboard.journals.create') }}" class="btn btn-primary"><i class="material-icons">post_add</i> {{ __('Add') }}</a>
            </div>
            <div class="col-md-3 px-1">
                <form action="{{ route('dashboard.journals.index') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="{{ __('Search') }}" value="{{request()->search}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i class="material-icons">search</i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex flex-column mb-3">
            @php
                $color=[ 'primary', 'info', 'warning', 'danger' , 'success'];
            @endphp
            @forelse ($journals as $index => $journal)
                <div class="col-md-12 p-1">
                    <div class="card border-{{$color[$index % 5]}}" style="border-left: 1em solid">
                        <div class="card-body row align-items-center">
                            <div class="col-3">
                                <h5 class="my-0">{{__('Anamnese')}}</h5>
                                <p class="mb-1">{{ implode(', ', $journal->anamnese) }}</p>
                                <h5 class="my-0">{{__('Diagnosis')}}</h5>
                                <p class="mb-1">{{ $journal->diagnosis->implode('name', ', ') }}</p>
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
                    </div>
                </div>
            @empty
                {{__('Data is empty')}}
            @endforelse

        </div>
        {{$journals->links()}} --}}
    </div>
@endsection
