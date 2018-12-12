@extends('layouts.default')
@section('title', $title)

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>{{ $title }}</h1>
        <ul class="users">
            @foreach ($requests as $request)
                <li>
                    <img src="{{ $request->gravatar() }}" alt="{{ $request->uname }}" class="gravatar"/>
                    <a href="{{ route('users.show', $request->uid )}}" class="username">{{ $request->uname }}</a>
                </li>


            @endforeach
        </ul>

        {!! $requests->render() !!}
    </div>
@stop