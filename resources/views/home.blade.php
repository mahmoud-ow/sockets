<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Map</title>

    <style>
        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
        #map {
            height: 100%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>



</head>

<body>





    <h1>My Google Map</h1>

    <div id="map"></div>













    <script>
        function initMap(){
            
            
            var options = {
                zoom   : 6,
                center : {lat: -25.344, lng: 131.036},
            }



            var map = new google.maps.Map(document.getElementById('map'), options);

    
            var marker = new google.maps.Marker({
                position: {lat: -25.344, lng: 131.036},
                map : map,
            });



            google.maps.event.addListener(map, 'click', function( event ){
               // alert( "Latitude: "+event.latLng.lat()+" "+", longitude: "+event.latLng.lng() );
                //     -22.593726063929296 , longitude: 122.27783203125
       
               var lat = -22.593;
               var lang = 122.277;
               var newLocation = {lat: event.latLng.lat(), lng: event.latLng.lng()}
               marker.setPosition(newLocation);
            });




            // add marker
            /* var marker = new google.maps.Marker({
                position: {lat: -25.344, lng: 131.036},
                map : map,
            });

            var infoWindow = new google.maps.InfoWindow({
                content: '<h1>Hello There</h1>'
            });

            marker.addListener('click', function(){
                infoWindow.open( map , marker );
            }); */

        }/* /initMap() */
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCl5BSaL_eA3VcBuWtxW7pBjkcGif-HzPk&callback=initMap"
        type="text/javascript"></script>


</body>

</html>






































{{-- 
    
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">We Code Messenger</div>



                <div class="card-body" id="app" style="padding: 0">

                  

                </div>




            </div>
        </div>
    </div>
</div>
@endsection
    
--}}