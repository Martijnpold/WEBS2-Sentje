@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center">Payment Request</div>
                <div class="card-body">
                    <h1 style="text-align:center">{{ $payment_request->description }}</h1>
                    <h2 style="text-align:center">€ {{ $payment_request->amount }}</h2>
                </div>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            </div>

            <br>
            <div class="card">
                <div class="card-header" style="text-align:center">Payments</div>
                <div class="card-body">
                    <table style="width:100%">
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Date</td>
                        </tr>
                        @foreach ($payments as $payment)
                        @if ($payment->paid)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->name() }}</td>
                            <td>{{ $payment->created_at }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection