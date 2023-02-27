@extends('layouts.app')
@section('title', 'Accueil')
@section('content')

<nav class="mt-5" aria-label="breadcrumb">
  <ol class="breadcrumb pt-4">
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>

<div class="container">

<div class="pt-5">
    <h1 class="mt-5">WELCOME TO THE STUDENT'S FORUM</h1>
</div>
<a class="nav-link active" aria-current="page" href="{{route('user.registration')}}">@lang('lang.signup')</a>
<a class="nav-link" href="{{route('login')}}">@lang('lang.login')</a>


</div>
@endsection