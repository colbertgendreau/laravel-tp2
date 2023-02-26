@extends('layouts.app')
@section('title', 'Create')
@section('content')

<div class="container pt-5">
    <div class="row mt-5">

        <div class="col-12 text-center mt-2">
            <h1 class="display-one">
                @lang('lang.add_article')
                Ajouter un document
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


            <!-- https://www.webtrickshome.com/forum/call-to-a-member-function-getclientoriginalname-on-string-laravel-file-upload -->
            <!-- https://getbootstrap.com/docs/5.2/components/navs-tabs/ -->

            <form method="POST" enctype="multipart/form-data">
                @csrf

                <div class="d-flex align-items-start justify-content-center">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Englais</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Écrire en francais</button>
                        <input type="submit" value="@lang('lang.save')" class=" nav-link bg-success">
                    </div>


                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                            <div class="card">
                                <div class="card-header text-center">
                                    @lang('lang.form')
                                </div>
                                <div class="card-body">


                                    <div class="form-floating control-group col-12 mb-3">
                                        <input type="text" id="floatingtitleDoc" placeholder="@lang('lang.title')" name="title" class="form-control alert alert-primary">
                                        <label for="floatingtitleDoc">@lang('lang.title')</label>
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


                                    <div class="form-floating control-group col-12 mb-3">
                                        <input type="text" id="floatingtitleFrDoc" placeholder="@lang('lang.title')" name="title_fr" class="form-control alert alert-primary">
                                        <label for="floatingtitleFrDoc">@lang('lang.title')</label>
                                    </div>




                                </div>

                            </div>
                        </div>
                        <div class="control-group col-12">

                            <label class="form-label" for="inputFile">File:</label>

                            <input type="file" name="path" id="path" class="form-control alert alert-warning">

                        </div>

                    </div>
                </div>

            </form>






        </div>
    </div>
</div>



@endsection('content')