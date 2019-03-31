@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <form action="{{route('paymentaccounts.store')}}" method="post">
        @csrf
        <label>{{ __('sentje.Name') }}</label>
        <input type="text" name="name" placeholder="Voer jouw naam in...">


        <label>{{ __('sentje.Balance') }}</label>
        <input type="text" name="balance" placeholder="Voer het gewenste saldo in" >
        
        <button type="submit"> {{ __('sentje.Submit') }} </button>

        </form>
    </div>
</div>

@endsection