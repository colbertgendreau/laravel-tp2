@extends('layouts.app')
@section('title', 'Accueil')
@section('content')

<nav class="mt-5" aria-label="breadcrumb">
  <ol class="breadcrumb pt-4">
    <li class="breadcrumb-item active" aria-current="page">@lang('lang.home')</li>
  </ol>
</nav>

<div class="container text-center">

<div>
    <h1 class="mt-5">@lang('lang.welcome')</h1>
</div>
@guest
<div class="row d-flex justify-content-center">

    <a class="btn btn-info col-md-3 m-1" aria-current="page" href="{{route('user.registration')}}">@lang('lang.signup')</a>
    <a class="btn btn-info col-md-3 m-1" href="{{route('login')}}">@lang('lang.login')</a>
    @else
    <a class="btn btn-info col-md-3 m-1" href="{{route('dashboard')}}">@lang('lang.account')</a>
    @endguest
</div>
</div>
@endsection