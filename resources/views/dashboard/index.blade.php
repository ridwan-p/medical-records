@extends('layouts.app')

@push('css')
    <link href="{{ asset('css/chart.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="chart"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- or -->
@endsection

@push('js')
    <script src="{{ asset('js/chart.js') }}" defer></script>
@endpush
