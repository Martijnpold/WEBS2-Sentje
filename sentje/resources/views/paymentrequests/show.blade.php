@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
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

                    <table style="width:100%">
                    <tr>
                    <td>#</td>
                    <td>bedrag</td>
                    <td>omschrijving</td>
                    <tr>
                    <td>{{ $payment_request->id }}</td>
                    <td>{{ $payment_request->amount }}</td>
                    <td>{{ $payment_request->description }}</td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection