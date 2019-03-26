@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Payment') . ' #' . $payment_request->id }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 style="text-align:center">{{ __('Payment Request') }}</h1>
                    <h2 style="text-align:center">€ {{ $payment_request->amount }}</h2>
                    <br>
                    <h4 style="text-align:center">{{ __('Description') }}</h4>
                    <h5 style="text-align:center">"{{ $payment_request->description }}"</h5>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body d-flex justify-content-center" style="text-align:center">
                    {{ Form::open(array('route' => 'pay.store')) }}
                    <div style="display:none">{{ Form::text('request_id', $payment_request->id) }}</div>
                    {{ Form::label('name', __('Name')) }}<br>
                    {{ Form::text('name') }}<br><br>
                    {{ Form::label('currency', __('Currency')) }}<br>
                    {{ Form::select('currency', array('EUR' => __('Euro'), 'USD' => __('American Dollar')), 'EUR') }}<br><br>
                    {{ Form::submit(__('Pay')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
