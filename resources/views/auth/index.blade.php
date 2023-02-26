@extends('layouts.app')
@section('content')
<main class="login-form">
    <div class="container mt-5">
        <div class="row justify-content-center pt-2">
            <div class="col-md-8 pt-4">
                <h3 class="text-center mb-2">
                    @lang('lang.login')
                </h3>
                <hr>
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(!$errors->isEmpty())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li class='text-danger'>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{route('login.auth')}}" method="post">
                            @csrf



                            <div class="form-floating mb-3">
                                <input novalidate type="email" id="floatingEmail" placeholder="@lang('lang.email')" class="form-control alert alert-primary" role="alert" name="email" value="{{old('email')}}">
                                <label for="floatingEmail">@lang('lang.email')</label>
                            </div>
                            
                            
                            
                            
                            <div class="form-floating mb-3">
                                <input type="password" id="floatingPassword" placeholder="@lang('lang.password')" class="form-control alert alert-primary" role="alert" name="password">
                                <label for="floatingPassword">@lang('lang.password')</label>
                            </div>
                            <div class="d-grid mx-auto">
                                <input type="submit" value="@lang('lang.connection')" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection