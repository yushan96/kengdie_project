@extends('layouts.default')

@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="notes_form">


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

                    {{--@include('notes._note')--}}
                </section>
                {{--<h3>Note list</h3>--}}
                {{--@include('shared._feed')--}}
            </div>
            {{--<aside class="col-md-4">--}}
                {{--<section class="user_info">--}}
                    {{--@include('shared._user_info', ['user' => Auth::user()])--}}
                {{--</section>--}}
            {{--</aside>--}}
        </div>
    @else
        <div class="jumbotron">
            <h1>Oingo</h1>
            <p class="lead">
                Welcome to OINGO
            </p>
            <p>
                <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">Sign up now</a>
            </p>
        </div>
    @endif
@stop