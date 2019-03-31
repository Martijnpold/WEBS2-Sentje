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

        <div class ="form-group">
        <label>{{ __('sentje.Amount') }}</label>
        <input type="text" class="form-control"name="amount">
        </div>

        <input type="hidden" name="accountId" value="{{$account->id}}">
        
        <div class ="form-group">
        <label>{{ __('sentje.Description') }}</label>
        <textarea type="textarea" class="form-control" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary"> {{ __('sentje.Submit') }} </button>


        </form>
    </div>
</div>

@endsection