@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

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

                    You are logged in!

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
