@extends('layouts.default')
@section('title',$user->uname)
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="col-md-12">
                <div class="col-md-offset-2 col-md-8">
                    <section class="user_info">
                        @include('shared._user_info', ['user' => $user])
                    </section>
                </div>
            </div>
            <div class="col-md-12">
                @if (count($notes) > 0)
                    <ol class="notes">
                        @foreach ($notes as $note)
                            @include('notes._note')
                        @endforeach
                    </ol>
                    {!! $notes->render() !!}
                    @else
                    <div class="alert alert-warning" role="alert">Wooops, you have no note, try to create one or find others notes</div>
                @endif
            </div>

            {{-- 用户发布的内容 --}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-body">--}}
                    {{--<ul class="nav nav-tabs">--}}
                        {{--<li class="{{ active_class(if_query('tab', null)) }}">--}}
                            {{--<a href="{{ route('users.show', $user->id) }}">Ta 的Notes</a>--}}
                        {{--</li>--}}
                        {{--<li class="{{ active_class(if_query('tab', 'comments')) }}">--}}
                            {{--<a href="{{ route('users.show', [$user->id, 'tab' => 'comments']) }}">Ta 的Comments</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--@if (if_query('tab', 'comments'))--}}
                        {{--@include('users._comments', ['comments' => $user->comments()->with('note')->paginate(3)])--}}
                    {{--@else--}}
                        {{--@include('users._notes', ['notes' => $user->notes()->paginate(3)])--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>
@stop