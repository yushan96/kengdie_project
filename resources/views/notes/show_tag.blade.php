@extends('layouts.default')
@section('title', $title)

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>{{ $title }}</h1>
        <ul >
            @foreach ($tags as $tag)
                <li>
                    <div>{{$tag->tid}}</div>
                    <div>{{$tag->tagname}}</div>
                </li>
            @endforeach
        </ul>
    </div>
@stop