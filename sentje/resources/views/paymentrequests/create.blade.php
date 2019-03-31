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
        <form action="{{route('payments.store')}}" method="post">
        @csrf
        <label>{{ __('sentje.Amount') }}</label>
        <input type="text" name="amount" placeholder="0,00">
    
        <input type="hidden" name="accountId" value="{{$account->id}}">
        
        <input type="hidden" name="accountName" value="{{$account->name}}">

        <label>{{ __('sentje.Description') }}</label>
        <input type="text" name="description" placeholder="insert text here" >
        
        <button type="submit"> {{ __('sentje.Submit') }} </button>


        </form>
    </div>
</div>

@endsection