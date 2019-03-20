@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">

        {!! Form::open(['action' => 'PaymentRequestController@store']) !!}

            <div >
                {!! Form::label('amount', 'Amount') !!}
                {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => '0,00']) !!}
            </div>
            <br>
            <br>
            <div>
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'insert text here']) !!}
            </div>
            <br>
            <br>
            <div class ="row justify-content-center">
                {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
            </div>
                {!! Form::close() !!}

        </div>
    </div>
</div>

@endsection