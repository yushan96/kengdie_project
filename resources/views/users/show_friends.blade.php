@extends('layouts.default')
@section('title', $title)

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>{{ $title }}</h1>
        <ul class="users">
            @foreach ($friends as $friend)
                <li>
                    <img src="{{ $friend->gravatar() }}" alt="{{ $friend->uname }}" class="gravatar"/>
                    <a href="{{ route('users.show', $friend->uid )}}" class="username">{{ $friend->uname }}</a>
                </li>

                <form action="{{route('user.unfriend',$friend->uid)}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="'submit" class="btn btn-sm btn-danger friendship-delete-btn">Delete</button>
                </form>
            @endforeach


        </ul>

        {!! $friends->render() !!}
    </div>
@stop