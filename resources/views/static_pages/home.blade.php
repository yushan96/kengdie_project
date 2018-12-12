@extends('layouts.default')

@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                {{--<section class="notes_form">--}}
                    {{--@include('shared._note_form')--}}
                {{--</section>--}}
                <h3>Note list</h3>
                @include('shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared._user_info', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>Oingo</h1>
            <p class="lead">
                坑爹的project
            </p>
            <p>
                <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">Sign up now</a>
            </p>
        </div>
    @endif
@stop