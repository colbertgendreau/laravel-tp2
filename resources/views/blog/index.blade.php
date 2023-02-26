@extends('layouts.app')
@section('title', 'Blog List')
@section('content')
@php $locale = session()->get('locale'); @endphp


<div class="container mt-5">
    <div class="row pt-5">
        <div class="col-12 text-center">
            <h1 class="display-one">
                @lang('lang.my_blog')
            </h1>
            <hr>
        </div>


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
                                <tr class="bg-warning-subtle">
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



            <div class="row mt-2">
                <div>
                    <a href="{{ route('blog.create')}}" class="btn btn-outline-primary">
                        @lang('lang.add_post')
                    </a>
                </div>
            </div>

            <div class="row mt-2">
<div class="d-flex justify-content-center">

    {{ $blogs }}
</div>






    </div>
</div>




@endsection