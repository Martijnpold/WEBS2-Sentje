@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment #{{ $payment_request->id }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table style="width:100%">
                    <tr>
                    <td>#</td>
                    <td>amount</td>
                    <td>description</td>
                    <td>status</td>
                    <tr>
                    <td>{{ $payment_request->id }}</td>
                    <td>{{ $payment_request->amount }}</td>
                    <td>{{ $payment_request->description }}</td>
                    <!-- status column needs to be added through mollie.-->
                    </tr>
                    </table>
                </div>
                

                

            </div>
        </div>
    </div>
</div>
@endsection
