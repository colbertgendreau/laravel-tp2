@extends('layouts.app')
@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 pt-4">
                <div class="card">
                    <h3 class="card-header text-center">
                        Nouveau mot ed passe
                    </h3>
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
                        <form action="" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Nouveau mot de passe" id="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Confirmez le mot de passe" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="d-grid mx-auto">
                                <input type="submit" value="Connecter" class="btn btn-dark btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection