@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center">{{ __('sentje.Payment Account') }}</div>
                <div class="card-body">
                    <h1 style="text-align:center">{{ $payment_account->name }}</h1>
                    <h2 style="text-align:center">€ {{ number_format($payment_account->balance, 2, __('sentje.decimalformat'), __('sentje.thousandsformat')) }}</h2>
                </div>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            </div>

            <br>
            <div class="card">
                <div class="card-header" style="text-align:center">{{ __('sentje.Payment Requests') }}</div>
                <div class="card-body">
                    <table style="width:100%">
                        <tr>
                            <td>#</td>
                            <td>{{ __('sentje.Name') }}</td>
                            <td>{{ __('sentje.Description') }}</td>
                            <td></td>
                            <td></td>
                            @foreach ($payment_requests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ '€ ' . number_format($request->amount, 2, __('sentje.decimalformat'), __('sentje.thousandsformat')) }}</td>
                            <td>{{ $request->description }}</td>
                            <td>
                                @if ($request->can_be_removed())
                                <form action="{{ route('payments.destroy', $request->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button>{{ __('sentje.Delete') }}</button>
                                </form>
                                @endif
                            </td>
                            <td><a href="{{ route('payments.show', $request->id) }}">{{ __('sentje.Details') }}</a></td>
                        </tr>
                        @endforeach

                    </table>
                </div>
                <div class="row justify-content-center">
                    <a class="btn btn-outline-success"
                       href="{{ URL::route('create payment', ['paymentId' => $payment_account->id])}}">
                     {{ __('sentje.New Request') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection