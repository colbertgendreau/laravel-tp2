@extends('layouts.app')
@section('title', 'Create')
@section('content')
<div class="container pt-5">
    <div class="row mt-5">
        <div class="col-12 text-center mt-2">
            <h1 class="display-one">
                @lang('lang.add_article')
            </h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        @if(!$errors->isEmpty())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li class='text-danger'>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
            <!-- https://getbootstrap.com/docs/5.2/components/navs-tabs/ -->
            <form method="POST" class="col-12">
                @csrf
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
                                    @lang('lang.in_english')
                                </div>
                                <div class="card-body">
                                    <div class="form-floating control-group col-12 mb-3">
                                        <input type="text" id="floatingtitle" placeholder="@lang('lang.title')" name="title" class="form-control alert alert-primary">
                                        <label for="floatingtitle">@lang('lang.title')</label>
                                    </div>
                                    <div class="form-floating control-group col-12 mb-3">
                                        <textarea id="body" placeholder="@lang('lang.text')" name="body" class="form-control alert alert-primary"></textarea>
                                        <label for="body">@lang('lang.text')</label>
                                    </div>
                                    <div>
                                        <select class="form-select alert alert-primary" id="categories_id" name="categories_id">
                                            <option selected>@lang('lang.category_selection')</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->categorie }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <div class="card">
                                <div class="card-header text-center">
                                    @lang('lang.in_french')
                                </div>
                                <div class="card-body">
                                    <div class="form-floating control-group col-12 mb-3">
                                        <input type="text" id="floatingtitle_fr" placeholder="@lang('lang.title')" name="title_fr" class="form-control alert alert-primary">
                                        <label for="floatingtitle_fr">@lang('lang.title')</label>
                                    </div>
                                    <div class="form-floating control-group col-12 mb-3">
                                        <textarea id="floatingbody_fr" placeholder="@lang('lang.text')" name="body_fr" class="form-control alert alert-primary"></textarea>
                                        <label for="floatingbody_fr">@lang('lang.text')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')