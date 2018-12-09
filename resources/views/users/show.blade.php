@extends('layouts.default')
@section('title',$user->uname)
@section('content')
    {{$user->uname}}-{{$user->email}}
@stop