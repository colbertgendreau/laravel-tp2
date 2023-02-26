@extends('layouts.app')
@section('content')



<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                </tr>
                @foreach($blogs as $blog)
                <tr>
                    <td>{{$blog->title}}</td>
                    <td>{{$blog->blogHasuser->name}}</td>
                </tr>
                @endforeach
            </table>
            {{ $blogs }}
        </div>
    </div>
</div>

@endsection