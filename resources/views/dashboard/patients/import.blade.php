@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3 mx-3">
            <h4>{{ __('Import Data') }}</h4>
        </div>
        <div class="row mb-3 mx-3">
            <div class="card col-md-12">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                        <form action="{{ route('dashboard.patients.import.store') }}" method="POST" class="d-inline-flex">
                            @csrf
                            <button class="btn btn-primary"> <i class="material-icons">save</i> {{__('Save')}}</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    @foreach ($headers as $header)
                                        <th>{{$header}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($patients as $patient)
                                    <tr>
                                        @foreach ($headers as $header)
                                            <td>{{ $patient[$header] }}</td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">This is empty ....</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
