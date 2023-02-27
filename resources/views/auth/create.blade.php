@extends('layouts.app')
@section('content')

<!-- POur le "im not a robot" -->
<head>
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.enterprise.render('recaptcha', {
                // 'sitekey': '6LePBkskAAAAAKAejL4nBLJ4IT8f5QgRGm7LNgMg'
                'sitekey': '6LePBkskAAAAAKAejL4nBLJ4IT8f5QgRGm7LNgMg'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/enterprise.js?render="></script>
    <script>
        grecaptcha.enterprise.ready(function() {
            grecaptcha.enterprise.execute('6LePBkskAAAAAKAejL4nBLJ4IT8f5QgRGm7LNgMg', {
                action: 'create'
            });
        });
    </script>
</head>

<nav class="mt-4" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@lang('lang.signup')</li>
  </ol>
</nav>


<main class="login-form mt-5">
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 pt-4">
                <div class="card">
                    <h3 class="card-header text-center">
                        @lang('lang.signup')
                    </h3>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                        @endif
                        <form class="d-flex flex-column align-items-center" action="{{route('user.store')}}" method="post" novalidate>
                            @csrf

                            <div class="form-floating mb-3">
                                <input id="floatingName" type="text" placeholder="@lang('lang.name')" class="form-control alert alert-primary" name="name" value="{{old('name')}}">
                                <label for="floatingName">@lang('lang.name')</label>

                                @if ($errors->has('name'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('name')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input id="floatingEmail" type="email" placeholder="@lang('lang.email')" class="form-control alert alert-primary" name="email" value="{{old('email')}}">
                                <label for="floatingEmail">@lang('lang.email')</label>

                                @if ($errors->has('email'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('email')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input id="floatingPassword" type="password" placeholder="@lang('lang.password')" class="form-control alert alert-primary form-floating" name="password">
                                <label for="floatingPassword">@lang('lang.password')</label>

                                @if ($errors->has('password'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('password')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input id="floatingPassword_confirmation" type="password" placeholder="@lang('lang.password_confirmation')" class="form-control alert alert-primary" name="password_confirmation">
                                <label for="floatingPassword_confirmation">@lang('lang.password_confirmation')</label>
                            </div>


                            <div class="g-recaptcha" id="recaptcha"></div>
                            <div class="d-grid mx-auto">
                                <button class="mt-3 btn btn-dark btn-block g-recaptcha" data-sitekey="6LePBkskAAAAAKAejL4nBLJ4IT8f5QgRGm7LNgMg" data-callback='onSubmit' data-action='submit' value="submit">@lang('lang.save')
                                </button>
                            </div>
                        </form>

                        <script src="https://www.google.com/recaptcha/enterprise.js?onload=onloadCallback&render=explicit" async defer>
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection