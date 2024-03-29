@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('sentje.Payment Requests') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table style="width:100%">
                    <tr>
                    <td>#</td>
                    <td>{{ __('sentje.Amount') }}</td>
                    <td>{{ __('sentje.Description') }}</td>
                    <td></td>
                    <td></td>
                    @foreach ($payment_requests as $request)
                    <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ '€ ' . number_format($request->amount, 2, __('sentje.decimalformat'), __('sentje.thousandsformat')) }}</td>
                    <td>{{ $request->description }}</td>
                    <td style='text-align:center'>
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

            </div>
        </div>
    </div>
</div>
@endsection
