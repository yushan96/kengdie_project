@extends('layouts.default')

@section('title','index')

@section('content')
    <div class="jumbotron">
        <h1>Oingo</h1>
        <p class="lead">
            坑爹的project
        </p>
        <p>
            <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">Sign up now</a>
        </p>
    </div>
@stop