@extends('layouts.app')
@section('title', 'Blog')
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
        <li class="breadcrumb-item"><a href="{{route('blog.index')}}">@lang('lang.forum')</a></li>
        <li class="breadcrumb-item active" aria-current="page"> @if ($locale=='fr' && isset($blogPost->title_fr))
            {{ $blogPost->title_fr }}
            @else
            {{ $blogPost->title }}
            @endif
        </li>
    </ol>
</nav>


<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <h4 class="display-one mt-2">
                @if ($locale=='fr' && isset($blogPost->title_fr))
                {{ $blogPost->title_fr }}
                @else
                {{ $blogPost->title }}
                @endif
            </h4>
            <hr>
            <p>
                @if ($locale=='fr' && isset($blogPost->body_fr))
                {!! $blogPost->body_fr !!}
                @else
                {!! $blogPost->body !!}
                @endif
            </p>
            @if ($locale=='fr')
            <strong>@lang('lang.category'): @isset($blogPost->blogHasCategory->categorie_fr) {{ $blogPost->blogHasCategory->categorie_fr}} @endisset</strong>
            @else
            <strong>@lang('lang.category'): @isset($blogPost->blogHasCategory->categorie) {{ $blogPost->blogHasCategory->categorie}} @endisset</strong>
            @endif
            <hr>
            <strong>@lang('lang.author'): {{ $blogPost->blogHasUser->name}}</strong>
            <hr>
        </div>
    </div>
    <div class="row text-center mb-2">
        @if ($userId == $blogPost->user_id)
        <div class="col-4">
            <a href="{{route('blog.edit', $blogPost->id)}}" class="btn btn-success">@lang('lang.update')</a>
        </div>
        <div class="col-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                @lang('lang.erase')
            </button>
        </div>
        @endif
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('lang.erase_article')</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @lang('lang.erase_text')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                <form action="{{ route('blog.edit', $blogPost->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="@lang('lang.erase')">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection