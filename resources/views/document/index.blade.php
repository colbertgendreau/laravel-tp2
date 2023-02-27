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
    <li class="breadcrumb-item active" aria-current="page">@lang('lang.documents')</li>
  </ol>
</nav>


<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1 class="display-one">
                @lang('lang.documents')
            </h1>
        </div>
        <hr>
        <div class="accordion-body table-responsive">
                        <table class="table table-sm ">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col">@lang('lang.title')</th>
                                    <th scope="col">@lang('lang.author')</th>
                                    <th scope="col">@lang('lang.date_publication')</th>
                                    <th scope="col">@lang('lang.download')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                <tr class="bg-warning-subtle">
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
                                    @lang('lang.no_date')
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
        <div class="row">
<div class="col-md-4 mt-2">
    <a href="{{ route('document.create')}}" class="btn btn-outline-primary">
        @lang('lang.add_document')
    </a>
</div>
</div>
    </div>
</div>
<div class="row mb-5">
    <div class="d-flex justify-content-center">
        {{ $documents }}
    </div>
</div>
@endsection