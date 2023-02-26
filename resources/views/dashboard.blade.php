@extends('layouts.app')
@section('title', 'Blog List')
@section('content')
@php $locale = session()->get('locale'); @endphp



<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1 class="display-one">
                Mon Compte
            </h1>
            <hr>
        </div>
        <a href="{{ route('blog.create')}}" class="btn bg-success-subtle btn-outline-primary mb-3 col-12">
            @lang('lang.add_post')
        </a>

        <a href="{{ route('document.create')}}" class="btn bg-success-subtle btn-outline-primary mb-3 col-12">
            @lang('lang.add_document')
        </a>



        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsedalert bg-info" role="alert" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h4>
                            Mes Articles
                        </h4>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse alert-warning" type="button" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body table-responsive">
                        <table class="table table-sm">
                            <thead>

                                <tr class="bg-light">

                                    <th scope="col">Titre</th>
                                    <th scope="col">Auteur</th>
                                    <th scope="col">Date de publication</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($blogs as $blog)
                                <tr>
                                    @if ($locale=='fr' && isset($blog->title_fr))
                                    <th><a href="{{ route('blog.show', $blog->id)}}">{{ $blog->title_fr }}</a></th>

                                    @else

                                    <th><a href="{{ route('blog.show', $blog->id)}}">{{ $blog->title }}</a></th>
                                    @endif


                                    <th>{{ $blog->blogHasUser->name}}</th>
                                    <th>{{ $blog->created_at->format('d/m/Y') }}</th>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed bg-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h4>

                            Mes Documents
                        </h4>

                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse alert-warning" role="alert" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body table-responsive">
                        <table class="table table-sm ">
                            <thead>

                                <tr class="bg-light">

                                    <th scope="col">Titre</th>

                                    <th scope="col">Auteur</th>
                                    <th scope="col">Date de publication</th>
                                    <th scope="col">Download</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($documents as $document)
                                <tr>
                                    @if ($locale=='fr' && isset($document->title_fr))
                                    <th><a href="{{ route('document.show', $document->id)}}">{{ $document->title_fr }}</a></th>

                                    @else

                                    <th><a href="{{ route('document.show', $document->id)}}">{{ $document->title }}</a></th>
                                    @endif


                                    <th>{{ $document->documentHasUser->name}}</th>

                                    @if(isset($document->created_at))
                                    <th>{{$document->created_at->format('d/m/Y')}}</th>

                                    @else
                                    <th>

                                        Pas de date
                                    </th>
                                    @endif
                                    <th> <a href="{{route('download', $document->id)}}" class="btn bg-success-subtle btn-outline-primary mb-3 col-12">
                                            @lang('lang.download')
                                        </a>
                                    </th>


                                    


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>









    </div>



</div>
@endsection