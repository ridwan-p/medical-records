@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <h4>{{ __('History') }}</h4>
        </div>
        <div class="row mb-3">
            <div class="card col-md-12">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                        <form action="{{ route('dashboard.history.index') }}" method="GET" class="d-inline-flex">
                        <input type="date" class="form-control" name="date_start" placeholder="{{ __('date start') }}" value="{{request()->date_start}}">
                        <input type="date" class="form-control mx-3" name="date_end" placeholder="{{ __('date end') }}" value="{{request()->date_end}}">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control" placeholder="{{ __('Search') }}" value="{{request()->search}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-addon2">{{ __('Search') }}</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Age')}} / {{ __('Gender') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Anamnese') }}</th>
                                    <th>{{ __('Diagnosis') }}</th>
                                    <th>{{ __('Medications') }}</th>
                                    <th>{{ __('Note') }}</th>
                                    <th>{{ __('Created at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($journals as $index => $journal)
                                    <tr>
                                        <td>{{$index + $journals->firstItem()}}</td>
                                        <td>{{ $journal->patient->name }}</td>
                                        <td>{{$journal->patient->age}}/ {{ $journal->patient->gender ? __('Male') : __("Female") }}</td>
                                        <td>{{ $journal->patient->address }}</td>
                                        <td>{{ implode(',', $journal->anamnese) }}</td>
                                        <td>{{ implode(',', $journal->diagnosis) }}</td>
                                        <td>{{ $journal->medications->implode('name', ',') }}</td>
                                        <td>{{ $journal->note }}</td>
                                        <td>{{ $journal->created_at->format("d M Y h:m:s") }}</td>
                                    </tr>                        
                                @empty
                                    <tr>
                                        <td colspan="9">This is empty ....</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">{{__('Total')}} : {{$journals->total()}} {{__('items')}}</td>
                                    <td colspan="6"><nav class="float-right"> {{ $journals->links() }} </nav></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
