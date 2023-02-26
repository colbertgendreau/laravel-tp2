@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1 class="display-one mt-5">
                @lang('lang.my_blog')
            </h1>
            <p>
            @lang('lang.homeText')
            </p>
            <a href="{{ route('blog.index')}}" class="btn btn-outline-primary">
                @lang('lang.showArticles')
            </a>
        </div>
    </div>
</div>
@endsection