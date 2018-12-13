@extends('layouts.default')
@section('title', "add_new_note")

@section('content')
    <form action="{{ route('notes.store') }}" method="POST">
        @include('shared._errors')
        {{ csrf_field() }}
        <div>
            <textarea class="form-control" rows="8" placeholder="input something..."
                      name="notetext">{{ old('content') }}</textarea>

            <div class="form-group" style="width: 30%; height: auto; display: inline ">
                <div><span class="label label-primary">Choose some tags:</span></div>
                <span class="input-group-addon"><input type="checkbox" name="tag[]" value=1>eating </span>
                <span class="input-group-addon"><input type="checkbox" name="tag[]" value=2>shopping</span>
                <span class="input-group-addon"><input type="checkbox" name="tag[]" value=3>entertainment</span>
                <span class="input-group-addon"><input type="checkbox" name="tag[]" value=4>me</span>
                <span class="input-group-addon"><input type="checkbox" name="tag[]" value=5>holiday</span>
            </div>
            <br>
            <br>
            <div style="width: 50%; height: auto; display: inline ">
                <div>
                    <span class="label label-primary">Set a state for you note:</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">@</span>
                    <input class="form-control" rows="3" placeholder="input the state..." name="state_text"
                           style="width: auto">{{ old('content') }}
                </div>
            </div>
            <br>
            <div>
                <span class="label label-primary">Set period of validity for your note:</span><br>
                Start_date:<input type="date" value="2018-12-12" name="begin_date"/>
                End_date:<input type="date" value="2018-12-12" name="end_date"/>
            </div>
            <div><span class="label label-primary">Set permission:</span></div>
            <div class="col-md-8">
                <span class="input-group-addon"><input type="radio" name="permission" value=0>For everyone</span>
                <span class="input-group-addon"><input type="radio" name="permission" value=1>For myself</span>
                <span class="input-group-addon"><input type="radio" name="permission" value=2>For my friends</span>
            </div>
            <br>
            <br>
            <div>
                <div class="col-md-8">
                    <span class="label label-primary">Schedule_start_date:</span>
                    <input type="date" value="2018-12-12" name="repeat_start"/>
                    <div>
                        <span class="label label-primary">Schedule by interval:</span>
                    </div>
                    <div>input the interval (days)
                        <input type="number" value=1 name="repeat_interval">
                    </div>
                    <div><span class="label label-primary">Schedule by repeat day:(0 represent all)</span></div>
                    <div>
                        Every <input type="number" name="repeat_year" value=0 min=0> year<br>
                        Every <input type="number" name="repeat_month" value=0 max=12 min=0> month<br>
                        Every <input type="number" name="repeat_week" value=0 max=5 min=0> week<br>
                        Every <input type="number" name="repeat_weekday" value=0 min=0 max=7> day<br>
                    </div>
                    <div>
                        <span class="label label-primary">Start_time:</span><input type="time" value="12:00:00"
                                                                                   name="day_start"/>
                        <span class="label label-primary">End_time:</span><input type="time" value="12:00:00"
                                                                                 name="day_end"/>
                    </div>
                    {{--@include('map')--}}
                    <div style="padding:10px">
                        <div id="map" style="width:1000px;height:300px;">

                        </div>
                    </div>
                    {{--<form action=# method="POST">--}}
                    <div class="form-group">
                        <label for="name"> latitude: </label>
                        <input type="text" name="latitude" id="latclicked" value="1">
                    </div>
                    <div class="form-group">
                        <label for="name"> longitude: </label>
                        <input type="text" name="longitude" id="longclicked" value="1">
                    </div>
                    <div>
                        <span class="label label-primary">Set a radius for your note:</span>
                    </div>
                    <div>radius
                        <input type="number" value=1 name="radius"> m
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Upload</button>
    </form>

    <script type="text/javascript">
        var map;

        function initMap() {

            var latitude = 27.7172453; // YOUR LATITUDE VALUE
            var longitude = 85.3239605; // YOUR LONGITUDE VALUE

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