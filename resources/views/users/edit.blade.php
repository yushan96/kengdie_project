@extends('layouts.default')
@section('title', 'update_information')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Update personal information</h5>
            </div>
            <div class="panel-body">

                @include('shared._errors')


                <form method="POST" action="{{ route('users.update', $user->uid )}}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">name：</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->uname }}">
                    </div>

                    <div class="form-group">
                        <label for="email">email：</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="password">password：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">confirm password：</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@stop