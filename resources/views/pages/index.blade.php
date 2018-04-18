
@extends('layouts.homeapp')

@section('content')
<div id="index-bg-img" class="jumbotron text-center">
      <h1>{{$title}}</h1>
      <p>Where all the latest gist goes down </p>
      <p><a class="btn btn-danger" href="{{ route('login') }}">{{ __('Login') }}</a> <a role="button" class="btn btn-success" href="{{ route('register') }}">{{ __('Register') }}</a> </p>
</div>

@endsection
