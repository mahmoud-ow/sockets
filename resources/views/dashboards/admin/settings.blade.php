@extends('dashboards.layouts.master-dashboard')


@section('header')
@parent

<title>Admin Dashboard</title>

<link href='{{asset($asset."/css/app.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<link href='{{asset($asset."/css/dashboards/dashboards.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>

<link href='{{asset($asset."/plugins/country-picker-flags/build/css/countrySelect.min.css?ver=".$ver)}}'
  rel='stylesheet' type='text/css'>
@endsection




@section('body')
@parent


<div class="dashboard_content dashboard_settings_page">





  @include('/dashboards.admin.side_menu')

  <!-- DASHBOARD BODY -->
  <div class="dashboard-body">


    @include('/dashboards.admin.header')


    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
      <!-- HEADLINE -->
      <div class="headline buttons primary">
        <h4>{{__('dashboard.account_settings')}}</h4>
        <button id="save_changes" form="profile-info-form"
          class="button mid-short primary">{{__('dashboard.save_changes')}}</button>
      </div>
      <!-- /HEADLINE -->

      <!-- FORM BOX ITEMS -->
      <div class="form-box-items">
        <!-- FORM BOX ITEM -->
        <div class="form-box-item">
          <h4>{{__('dashboard.profile_information')}}</h4>
          <hr class="line-separator">
          <!-- PROFILE IMAGE UPLOAD -->
          <div class="profile-image">
            <div class="profile-image-data">
              <figure class="user-avatar medium">
                <img
                  src="{{ ( auth()->user()->getMedia('avatar')->first() ) ? auth()->user()->getMedia('avatar')->first()->getUrl('thumb') : 'images/dashboard/profile-default-image.png' }}"
                  alt="profile-default-image">
              </figure>
              <p class="text-header">{{__('dashboard.profile_photo')}}</p>
              <p class="upload-details">Minimum size 70x70px</p>
            </div>
            <a href="#" id="upload_image_btn"
              class="button mid-short dark-light">{{__('dashboard.upload_image_dotted')}}</a>
          </div>
          <!-- PROFILE IMAGE UPLOAD -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <label for="acc_name" class="rl-label required">{{__('dashboard.account_name')}}</label>
            <input type="text" id="acc_name" name="acc_name" value="{{ auth()->user()->username }}"
              placeholder="{{__('dashboard.enter_account_name')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container half">
            <label for="new_pwd" class="rl-label">{{__('dashboard.new_password')}}</label>
            <input type="password" id="new_pwd" name="new_pwd" placeholder="{{__('dashboard.enter_password_here')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container half">
            <label for="new_pwd2" class="rl-label">{{__('dashboard.repeat_password')}}</label>
            <input type="password" id="new_pwd2" name="new_pwd2" placeholder="{{__('dashboard.repeat_password_here')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <label for="new_email" class="rl-label">{{__('dashboard.email')}}</label>
            <input readonly disabled type="email" id="new_email" name="new_email"
              placeholder="{{__('dashboard.enter_email_here')}}" value="{{ auth()->user()->email }}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container half">
            <label for="website_url" class="rl-label">{{__('dashboard.website')}}</label>
            <input type="text" id="website_url" name="website_url" value="{{auth()->user()->website}}"
              placeholder="{{__('dashboard.enter_website')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container half">

            <label for="country1" class="rl-label required">{{__('dashboard.country')}}</label>
            <input type="text" id="country_selector" style="width: 100%;">


            {{-- <label for="country1" class="select-block">
              <select name="country1" id="country1">
                <option value="0">{{__('dashboard.select_your_country')}}</option>
            <option value="1">United States</option>
            <option value="2">Argentina</option>
            <option value="3">Brasil</option>
            <option value="4">Japan</option>
            </select>
            <!-- SVG ARROW -->
            <svg class="svg-arrow">
              <use xlink:href="#svg-arrow"></use>
            </svg>
            <!-- /SVG ARROW -->
            </label> --}}


          </div>
          <!-- /INPUT CONTAINER -->




          <!-- INPUT CONTAINER -->
          <div class="input-container">

            <br>
            <hr class="line-separator">

            <label for="country1" class="rl-label">خرائط و مواقع</label>


            <div id="googleMap" style="height: 340px;width: 100%;background-color:rgb(163, 163, 163);"></div>



          </div>
          <!-- /INPUT CONTAINER -->





        </div>
        <!-- /FORM BOX ITEM -->











        <!-- FORM BOX ITEM -->
        <div class="form-box-item spaced">
          <h4>{{__('dashboard.social_media')}}</h4>
          <hr class="line-separator">

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="fb"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_fb_link" name="social_fb_link"
              value="{{$social->fb_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="twt"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_twt_link" name="social_twt_link"
              value="{{$social->twt_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="gplus"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_gplus_link" name="social_gplus_link"
              value="{{$social->gplus_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="rss"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_rss_link" name="social_rss_link"
              value="{{$social->rss_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="db"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_db_link" name="social_db_link"
              value="{{$social->db_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="be"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_be_link" name="social_be_link"
              value="{{$social->be_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="de"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_de_link" name="social_de_link"
              value="{{$social->de_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->
        </div>
        <!-- /FORM BOX ITEM -->







      </div>
      <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
  </div>
  <!-- /DASHBOARD BODY -->

  <div class="shadow-film closed"></div>



</div>
<!-- /.dashboard_content -->

@endsection




@section('footer')


<!-- XM Pie Chart -->
<script src="js/vendor/jquery.xmpiechart.min.js"></script>
<!-- Side Menu -->
<script src="js/side-menu.js"></script>
<!-- Dashboard Header -->
<script src="js/dashboard-header.js"></script>

<script src='{{asset($asset."/js/dashboards/admin/settings.js?ver=".$ver)}}' type='text/javascript'></script>
<script src='{{asset($asset."/plugins/country-picker-flags/build/js/countrySelect.js?ver=".$ver)}}'
  type='text/javascript'></script>


<script>
  
  


  function initMap(){
    var infowindow;
    var map;
    var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
    var purple_icon =  'http://maps.google.com/mapfiles/ms/icons/purple-dot.png' ;
    var locations = [];
    var myOptions = {
        zoom: 7,
        center: new google.maps.LatLng(30.5852, 36.2384),
        mapTypeId: 'roadmap'
    };
    map = new google.maps.Map(document.getElementById('googleMap'), myOptions);


    var markers = {};


    var getMarkerUniqueId= function(lat, lng) {
      return lat + '_' + lng;
    };

    var getLatLng = function(lat, lng) {
      return new google.maps.LatLng(lat, lng);
    };


    var addMarker = google.maps.event.addListener(map, 'click', function(e) {
      var lat = e.latLng.lat(); // lat of clicked point
      var lng = e.latLng.lng(); // lng of clicked point
      var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
      marker = new google.maps.Marker({
          position: getLatLng(lat, lng),
          map: map,
          animation: google.maps.Animation.DROP,
          id: 'marker_' + markerId,
          html: "    <div id='info_"+markerId+"'>\n" +
          "        <div class=\"map1\">\n" +        
          "                 <textarea  id='manual_description' placeholder='قم بكتابة وصف للمكان هنا'></textarea>\n" +
          "                 <button type='button' id='saveMarkerInput' onclick='window.saveData("+lat+","+lng+")'>حفظ</button>" +
          "                 <button type='button' id='deleteLocationInput' onclick='window.deleteLoction( "+lat+" , "+lng+")'>حذف</button>" +
          "        </div>\n" +
          "    </div>"
      });
      markers[markerId] = marker; // cache marker in markers object
      bindMarkerEvents(marker); // bind right click event to marker
      bindMarkerinfo(marker); // bind infowindow with click event to marker
    });



    var bindMarkerinfo = function(marker) {
      google.maps.event.addListener(marker, "click", function (point) {
        var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
        //console.log(markerId);
        var marker = markers[markerId]; // find marker
        infowindow = new google.maps.InfoWindow();
        infowindow.setContent(marker.html);
        infowindow.open(map, marker);
        
        // window.removeMarker(marker, markerId); // remove it
      });
    };

    var bindMarkerEvents = function(marker) {
        google.maps.event.addListener(marker, "rightclick", function (point) {
            var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
            var marker = markers[markerId]; // find marker
            window.removeMarker(marker, markerId); // remove it
        });
    };


    window.removeMarker = function(marker, markerId) {
      marker.setMap(null); // set markers setMap to null to remove it from map
      delete markers[markerId]; // delete marker instance from markers object
    };



    var i ; var confirmed = 0;
    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon :   locations[i][4] === '1' ?  red_icon  : purple_icon,
        html: "<div>\n" +
        "<table class=\"map1\">\n" +
        "<tr>\n" +
        "<td><a>Description:</a></td>\n" +
        "<td><textarea disabled id='manual_description' placeholder='Description'>"+locations[i][3]+"</textarea></td></tr>\n" +
        "</table>\n" +
        "</div>"
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow = new google.maps.InfoWindow();
          confirmed =  locations[i][4] === '1' ?  'checked'  :  0;
          $("#confirmed").prop(confirmed,locations[i][4]);
          $("#id").val(locations[i][0]);
          $("#description").val(locations[i][3]);
          $("#form").show();
          infowindow.setContent(marker.html);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }








    /**
    * SAVE save marker from map.
    * @param lat  A latitude of marker.
    * @param lng A longitude of marker.
    */
    window.saveData = function (lat,lng) {

    // get description
    var description = document.getElementById('manual_description').value;

    axios.post('/locations/', {
      lat: lat,
      lng: lng,
      description: description,
    })
      .then(function (response) {

        if (response.data.error == 0) {

          var markerId = lat + '_' + lng;
          var marker = markers[markerId];
          window.removeMarker(marker, markerId);


          locations.forEach(function(el){
            var markerId = el.lat + '_' + el.lng;
            var marker = markers[markerId];
            window.removeMarker(marker, markerId); // remove it
          });


          

          console.log( JSON.stringify(response.data.locations) );
          locations = response.data.locations;
          locations.forEach(function(location){
            var lat = location.lat; // lat of clicked point
            var lng = location.lng; // lng of clicked point
            var markerId = lat + '_' + lng; // an that will be used to cache this marker in markers object.
            var marker = new google.maps.Marker({
                position:  new google.maps.LatLng(lat, lng),
                map: map,
                icon : purple_icon,
                animation: google.maps.Animation.DROP,
                id: 'marker_' + markerId,
                html: "    <div id='info_"+markerId+"'>\n" +
                "        <div class=\"map1\">\n" +        
                "                 <textarea  id='manual_description' placeholder='قم بكتابة وصف للمكان هنا'>"+location.description+"</textarea>\n" +
                "                 <button type='button' id='deleteLocationInput' onclick='window.deleteLoction( "+lat+" , "+lng+")'>حذف</button>" +
                "        </div>\n" +
                "    </div>"
            });
            markers[markerId] = marker; // cache marker in markers object
            bindMarkerEvents(marker); // bind right click event to marker
            bindMarkerinfo(marker); // bind infowindow with click event to marker "+location.id+"
          });

          window.Toast.fire({
            icon: 'success',
            title: response.data.message
          });

        } else {
          infowindow.setContent("<div style='color: red; font-size: 25px;'>Inserting Errors</div>");
        }
      });
    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                callback(request.responseText, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }




    var locations = {!! $locations !!};
    
    console.log(locations);
    

    locations.forEach(function(location){
      var lat = location.lat; // lat of clicked point
      var lng = location.lng; // lng of clicked point
      var markerId = lat + '_' + lng; // an that will be used to cache this marker in markers object.
      var marker = new google.maps.Marker({
          position:  new google.maps.LatLng(lat, lng),
          map: map,
          icon :  purple_icon,
          animation: google.maps.Animation.DROP,
          id: 'marker_' + markerId,
          html: "    <div id='info_"+markerId+"'>\n" +
          "        <div class=\"map1\">\n" +        
          "                 <textarea  id='manual_description' placeholder='قم بكتابة وصف للمكان هنا'>"+location.description+"</textarea>\n" +
          "                 <button type='button' id='deleteLocationInput' onclick='window.deleteLoction( "+lat+" , "+lng+")'>حذف</button>" +
          "        </div>\n" +
          "    </div>"
      });
      markers[markerId] = marker; // cache marker in markers object
      bindMarkerEvents(marker); // bind right click event to marker
      bindMarkerinfo(marker); // bind infowindow with click event to marker "+location.id+"
    });



    window.deleteLoction = function(lat, lng){

        var lat = lat;
        var lng = lng;
        var markerId = lat + '_' + lng;
        var marker = markers[markerId]; // find marker

        axios.delete('/locations/' + markerId, { data: { lat: lat, lng:lng } }).then(function (response) {

            console.log(JSON.stringify(response.data));
            
            if (response.data.error == 0) {

              window.Toast.fire({
                icon: 'success',
                title: response.data.message
              })

              
              window.removeMarker(marker, markerId); // remove it
              
            } else {

              window.Toast.fire({
                icon: 'error',
                title: response.data.message
              })

            }
          });

    }

  }/* /initMap() */








  $(document).ready(function(){

   


    window.TRANSLATION = {

      change_profile_picture : "{!! trans('dashboard.change_profile_picture') !!}",
      save : "{!! trans('dashboard.save') !!}",
      cancel : "{!! trans('dashboard.cancel') !!}",

    };/* TRANSLATION */


    $("#country_selector").countrySelect({
      preferredCountries: ['jo'],
    });

    $("#country_selector").countrySelect("setCountry", '{!! (auth()->user()->country) ? auth()->user()->country : "Iraq (‫العراق‬‎)" !!}');
  });

  
  window.translation = {

    'please_choose_image': "{!! __('dashboard.please_choose_image') !!} ",

  };


</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCl5BSaL_eA3VcBuWtxW7pBjkcGif-HzPk&callback=initMap"
  type="text/javascript"></script>
@parent

@endsection