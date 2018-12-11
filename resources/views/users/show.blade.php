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
                @endif
            </div>
        </div>
    </div>
@stop