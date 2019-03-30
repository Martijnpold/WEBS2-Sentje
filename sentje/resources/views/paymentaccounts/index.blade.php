@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a href="{{ route('paymentaccounts.create')  }}"class ="btn btn-outline-success">Account toevoegen</a>
            <div class="card">
                <div class="card-header">{{ __('sentje.Payment Accounts') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table style="width:100%">
                        <tr>
                            <td>#</td>
                            <td>{{ __('sentje.Name') }}</td>
                            <td>{{ __('sentje.Balance') }}</td>
                            <td></td>
                            @foreach ($payment_accounts as $account)
                        <tr>
                            <td>{{ $account->id }}</td>
                            <td>{{ $account->name }}</td>
                            <td>{{ '€ ' . number_format($account->balance, 2, __('sentje.decimalformat'), __('sentje.thousandsformat')) }}</td>
                            <td><a href="{{ route('paymentaccounts.show', $account->id) }}">{{ __('sentje.Requests') }}</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection