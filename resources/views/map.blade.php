{{--@extends('layouts.default')--}}

{{--<html>--}}
{{--<head>--}}
    {{--<title>Google Map</title>--}}
    {{--<meta name="viewport" content="initial-scale=1.0">--}}
    {{--<meta charset="utf-8">--}}

{{--</head>--}}
{{--<body>--}}



<div style="padding:10px">
    <div id="map"  style="width:1000px;height:300px;" >
        {{--<style>--}}
            {{--#map {--}}
                {{--height: 300px;--}}
                {{--width: 1000px;--}}
            {{--}--}}
        {{--</style>--}}
    </div>
</div>
{{--<form action=# method="POST">--}}
    <div class="form-group">
        <label for="name"> latitude: </label>
        <input type="text" name="latitude" id="latclicked" value="">
    </div>
    <div class="form-group">
        <label for="name"> longitude: </label>
        <input type="text" name="longitude" id="longclicked" value="">
    </div>

    {{--<button type="submit" class="btn btn-primary">Sign up</button>--}}
{{--</form>--}}

<script type="text/javascript">
    var map;
    var notes=@json($notes);
    console.log(notes);
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


        // var marker = new google.maps.Marker({
        //     position: {lat:note['latitude'],lng:note['longitude']},
        //     map:map,
        //     label: note['noteid'].toString(),
        // });
        for(var n in notes){
            var marker = new google.maps.Marker({
                position: {lat:notes[n]['latitude'],lng:notes[n]['longitude']},
                map:map,
                label: notes[n]['noteid'].toString(),
            });
        }

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
                title: event.latLng.lat()+', '+event.latLng.lng(),
                // label: 'A',
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
{{--</body>--}}
{{--</html>--}}