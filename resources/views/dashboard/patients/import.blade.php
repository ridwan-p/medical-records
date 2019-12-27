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
                    <div class="table-responsive rounded-top">
                        <table class="table table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="all-patient">
                                            <label class="custom-control-label" for="all-patient"></label>
                                        </div>
                                    </th>
                                    @foreach ($headers as $index => $header)
                                        <th>{{$header}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($patients as $index => $patient)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input patient" id="patient-{{$index}}">
                                                <label class="custom-control-label" for="patient-{{$index}}"></label>
                                            </div>
                                        </td>
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
