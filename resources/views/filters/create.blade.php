@extends('layouts.default')

@section('title','sign up')
@section('content')

    <form method="POST" action="{{route('filter.show')}}">
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary">Use my last filter</button>
    </form>

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
                        <label for="from_who"><span class="label label-primary">from_who：</span></label>
                        @if($filter->from_who==0)
                        <input type="radio" name="from_who" value=0 checked="checked">From everyone
                        @else
                            <input type="radio" name="from_who" value=0>From everyone
                        @endif
                        @if($filter->from_who==1)
                        <input type="radio" name="from_who" value=1 checked="checked">From myself
                        @else
                            <input type="radio" name="from_who" value=1 >From myself
                        @endif
                        @if($filter->from_who==2)
                        <input type="radio" name="from_who" value=2 checked="checked">From my friends
                        @else
                            <input type="radio" name="from_who" value=2 >From my friends
                        @endif
                    </div>


                    <div class="form-group" style="width: 30%; height: auto; display: inline ">
                        <div><span class="label label-primary">Choose some tags:</span></div>
                        @if($filter->tags->pluck('tid')->contains(1))
                        <span class="input-group-addon"><input type="checkbox" name="tag[]" value=1 checked="checked">eating </span>
                        @else
                            <span class="input-group-addon"><input type="checkbox" name="tag[]" value=1 >eating </span>
                        @endif
                        @if($filter->tags->pluck('tid')->contains(2))
                        <span class="input-group-addon"><input type="checkbox" name="tag[]" value=2 checked="checked">shopping</span>
                        @else
                            <span class="input-group-addon"><input type="checkbox" name="tag[]" value=2>shopping</span>
                        @endif
                        @if($filter->tags->pluck('tid')->contains(3))
                        <span class="input-group-addon"><input type="checkbox" name="tag[]" value=3 checked="checked">entertainment</span>
                        @else
                            <span class="input-group-addon"><input type="checkbox" name="tag[]" value=3>entertainment</span>
                        @endif
                        @if($filter->tags->pluck('tid')->contains(4))
                        <span class="input-group-addon"><input type="checkbox" name="tag[]" value=4 checked="checked">me</span>
                        @else
                            <span class="input-group-addon"><input type="checkbox" name="tag[]" value=4>me</span>
                        @endif
                        @if($filter->tags->pluck('tid')->contains(5))
                        <span class="input-group-addon"><input type="checkbox" name="tag[]" value=5 checked="checked">holiday</span>
                        @else
                            <span class="input-group-addon"><input type="checkbox" name="tag[]" value=5>holiday</span>
                        @endif
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <div><span class="label label-primary">Now, you state:</span></div>
                        <div>
                            <textarea class="form-control"  rows="3" placeholder="{{$filter->state}}" name="state" style="width: auto"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <span class="label label-primary" aria-placeholder="{{$filter->date}}">Date:</span> <input type="date" value="2018-12-12" name="date"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="label label-primary">Time:</span><input type="time" value="12:00:00" name="time"/>
                    </div>


                    <div><span class="label label-primary">My position:</span></div>
                    <div style="padding:10px">
                        <div id="map" style="width:500px;height:300px;">

                        </div>
                    </div>
                    {{--<form action=# method="POST">--}}
                    <div class="form-group">
                        <label for="name"> <span class="label label-primary">latitude:</span> </label>
                        <input type="text" name="latitude" id="latclicked" value="{{$filter->location->latitude}}">
                    </div>

                    <div class="form-group">
                        <label for="name"> <span class="label label-primary">longitude:</span> </label>
                        <input type="text" name="longitude" id="longclicked" value="{{$filter->location->longitude}}">
                    </div>

                    <div class="form-group">
                        <label for="from_who"><span class="label label-primary">radius：</span></label>
                        <input placeholder="{{$filter->location->radius}}" type="number" name="radius" value=0 max=5000>m
                    </div>


                    <div class="form-group">
                        <div>
                            <input type="text" class="form-control"  rows="3" placeholder="keyword" name="keywords" style="width: auto"></input>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Apply</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var map;

        function initMap() {

            var latitude = 40.6942; // YOUR LATITUDE VALUE
            var longitude = -73.9866; // YOUR LONGITUDE VALUE

            var myLatLng = {lat: latitude, lng: longitude};

            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 14,
                disableDoubleClickZoom: true, // disable the default map zoom on double click

            });

            // Update lat/long value of div when anywhere in the map is clicked
            google.maps.event.addListener(map,'click',function(event) {
                // document.getElementById('latclicked').innerHTML = event.latLng.lat();
                // document.getElementById('longclicked').innerHTML =  event.latLng.lng();
                document.getElementById('latclicked').value = event.latLng.lat();
                document.getElementById('longclicked').value =  event.latLng.lng();

            });

            // Update lat/long value of div when you move the mouse over the map
            // google.maps.event.addListener(map,'mousemove',function(event) {
            //     document.getElementById('latmoved').innerHTML = event.latLng.lat();
            //     document.getElementById('longmoved').innerHTML = event.latLng.lng();
            // });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                //title: 'Hello World'

                // setting latitude & longitude as title of the marker
                // title is shown when you hover over the marker
                title: latitude + ', ' + longitude
            });


            // Update lat/long value of div when the marker is clicked
            marker.addListener('click', function(event) {
                document.getElementById('latclicked').innerHTML = event.latLng.lat();
                document.getElementById('longclicked').innerHTML =  event.latLng.lng();
            });

            // Create new marker on double click event on the map
            google.maps.event.addListener(map,'dblclick',function(event) {
                marker.setMap(null);
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    title: event.latLng.lat()+', '+event.latLng.lng()
                });

                // Update lat/long value of div when the marker is clicked
                marker.addListener('click', function() {
                    document.getElementById('latclicked').innerHTML = event.latLng.lat();
                    document.getElementById('longclicked').innerHTML =  event.latLng.lng();
                });
            });

            // Create new marker on single click event on the map
            /*google.maps.event.addListener(map,'click',function(event) {
                var marker = new google.maps.Marker({
                  position: event.latLng,
                  map: map,
                  title: event.latLng.lat()+', '+event.latLng.lng()
                });
            });*/
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTK5dYiCSBUXQQH00IKHgeWVL5a2pKCf4&callback=initMap"
            async defer></script>

@stop