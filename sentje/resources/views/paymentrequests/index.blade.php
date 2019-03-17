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
                    @foreach ($payment_requests as $request)
                    <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->amount }}</td>
                    <td>{{ $request->description }}</td>
                    </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
