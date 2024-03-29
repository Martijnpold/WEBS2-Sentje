@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center">{{ __('sentje.Payment Request') }}</div>
                <div class="card-body">
                    <h1 style="text-align:center">{{ $payment_request->description }}</h1>
                    <h2 style="text-align:center">€ {{ number_format($payment_request->amount, 2, __('sentje.decimalformat'), __('sentje.thousandsformat')) }}</h2>
                </div>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            </div>

            <br>

            <div class="card">
                <div class="card-header" style="text-align:center">{{ __('sentje.Payment Link') }}</div>
                <div class="card-body justify-content-center">
                    <input type="text" name="pay-link" style="text-align:center;width:100%" value="{{ url('/pay/' . $payment_request->id) }}" readonly><br>
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-header" style="text-align:center">{{ __('sentje.Payments') }}</div>
                <div class="card-body">
                    <table style="width:100%">
                        <tr>
                            <td>#</td>
                            <td>{{ __('sentje.Name') }}</td>
                            <td>{{ __('sentje.Date') }}</td>
                        </tr>
                        @foreach ($payments as $payment)
                        @if ($payment->paid)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->name() }}</td>
                            <td>{{ date(__('sentje.dateformat'), $payment->datetime()) }}</td>
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