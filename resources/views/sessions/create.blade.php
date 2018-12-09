@extends('layouts.default')
@section('title', 'Sign in')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Sign in</h5>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">emial：</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">password：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>

                <hr>

                <p>Have no account?<a href="{{ route('signup') }}">Sign up now!！</a></p>
            </div>
        </div>
    </div>
@stop