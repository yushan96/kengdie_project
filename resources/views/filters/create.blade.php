@extends('layouts.default')

@section('title','sign up')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Create filter</h5>
            </div>
            <div class="panel-body">
                @include('shared._errors')
                <form method="POST" action="{{route('filter.store')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name"> latitude: </label>
                        <input type="text" name="latitude" id="latclicked" value="">
                    </div>
                    <div class="form-group">
                        <label for="name"> longitude: </label>
                        <input type="text" name="longitude" id="longclicked" value="">
                    </div>

                    <div class="form-group">
                        <label for="from_who">from_who：</label>
                        <input type="radio" name="from_who" value=0 >From everyone
                        <input type="radio" name="from_who" value=1 >From myself
                        <input type="radio" name="from_who" value=2 >From my friends
                    </div>

                    <div class="form-group">
                        <label for="from_who">radius：</label>
                        <input type="number" name="radius" value=0 max=5000>m
                    </div>

                    <div class="form-group">
                        <div class="form-group" style="width: 30%; height: auto; display: inline ">
                            <p><input type="checkbox" name="tag[]" value=1 >eating</p>
                            <p><input type="checkbox" name="tag[]" value=2 >shopping</p>
                            <p><input type="checkbox" name="tag[]" value=3 >entertainment</p>
                            <p><input type="checkbox" name="tag[]" value=4 >me</p>
                            <p><input type="checkbox" name="tag[]" value=5 >holiday</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <textarea class="form-control"  rows="3" placeholder="input the state..." name="state" style="width: auto"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            Date:<input type="date" value="2018-12-12" name="date"/>
                        </div>
                    </div>

                    <div class="form-group">
                        Time:<input type="time" value="12:00:00" name="time"/>
                    </div>

                    <div class="form-group">
                        <div>
                            <input type="text" class="form-control"  rows="3" placeholder="keyword" name="keywords" style="width: auto"></input>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submmit</button>
                </form>
            </div>
        </div>
    </div>
@stop