@extends('layouts.app')
@section('title', 'Blog List')
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
    <li class="breadcrumb-item active" aria-current="page">@lang('lang.forum')</li>
  </ol>
</nav>

<div class="container mt-5">
    <div class="row pt-5">
        <div class="col-12 text-center">
            <h1 class="display-one">
                @lang('lang.forum')
            </h1>
            <hr>
        </div>
        <div class="accordion-body table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col">@lang('lang.title')</th>
                                    <th scope="col">@lang('lang.author')</th>
                                    <th scope="col">@lang('lang.date_publication')</th>
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