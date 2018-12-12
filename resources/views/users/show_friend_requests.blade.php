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

                    <form action="{{route('friendship.acceptRequest',$request->uid)}}" method="POST">
                        {{csrf_field()}}
                        <button type="submit" class="btn">Accept</button>
                    </form>
                    <form action="{{route('friendship.denyRequest',$request->uid)}}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger delete-btn">Deny</button>
                    </form>
                </li>
            @endforeach
        </ul>

        {!! $requests->render() !!}
    </div>
@stop