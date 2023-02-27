@extends('layouts.app')
@section('title', 'Mettre a jour')
@section('content')
@php $locale = session()->get('locale'); @endphp



<nav class="mt-4" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('lang.account')</a></li>
        <li class="breadcrumb-item"><a href="{{route('blog.index')}}">@if ($locale=='fr' && isset($document->title_fr))
            {{ $document->title_fr }}
            @else
            {{ $document->title }}
            @endif</a></li>
        <li class="breadcrumb-item active" aria-current="page"> @lang('lang.update')
        </li>
    </ol>
</nav>




<div class="container">
    <div class="row">
        <div class="col-12 text-center mt-2">
            <h1 class="display-one ">
                @lang('lang.modify_document')
            </h1>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
            </div>
        </div>
    </div>
    @if(!$errors->isEmpty())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li class='text-danger'>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST">
        @csrf
        @method('put')
        <div class="d-flex align-items-start justify-content-center">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">@lang('lang.in_english_mandatory')</button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">@lang('lang.in_french')</button>
                <input type="submit" value="@lang('lang.save')" class=" nav-link bg-success">
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header text-center">
                            @lang('lang.form')
                        </div>
                        <div class="card-body">
                            <div class="control-group col-12">
                                <label for="title">@lang('lang.title')</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ $document->title}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header text-center">
                            @lang('lang.form')
                        </div>
                        <div class="card-body">
                            <div class="control-group col-12">
                                <label for="title_fr">@lang('lang.title')</label>
                                <input type="text" id="title_fr" name="title_fr" class="form-control" value="{{ $document->title_fr}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection