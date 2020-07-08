function initMap() {



  var infowindow;
  var map;
  var red_icon = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
  var purple_icon = 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png';
  var locations = [];
  var myOptions = {
    zoom: 7,
    center: new google.maps.LatLng(30.5852, 36.2384),
    mapTypeId: 'roadmap'
  };
  map = new google.maps.Map(document.getElementById('googleMap'), myOptions);


  var markers = {};


  var getMarkerUniqueId = function (lat, lng) {
    return lat + '_' + lng;
  };

  var getLatLng = function (lat, lng) {
    return new google.maps.LatLng(lat, lng);
  };


  var addMarker = google.maps.event.addListener(map, 'click', function (e) {
    var lat = e.latLng.lat(); // lat of clicked point
    var lng = e.latLng.lng(); // lng of clicked point
    var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
    marker = new google.maps.Marker({
      position: getLatLng(lat, lng),
      map: map,
      animation: google.maps.Animation.DROP,
      id: 'marker_' + markerId,
      html: "    <div id='info_" + markerId + "'>\n" +
        "        <div class=\"map1\">\n" +
        "                 <textarea  id='manual_description' placeholder='قم بكتابة وصف للمكان هنا'></textarea>\n" +
        "                 <button type='button' id='saveMarkerInput' onclick='window.saveData(" + lat + "," + lng + ")'>حفظ</button>" +
        "                 <button type='button' id='deleteLocationInput' onclick='window.deleteLoction( " + lat + " , " + lng + ")'>حذف</button>" +
        "        </div>\n" +
        "    </div>"
    });
    markers[markerId] = marker; // cache marker in markers object
    bindMarkerEvents(marker); // bind right click event to marker
    bindMarkerinfo(marker); // bind infowindow with click event to marker
  });



  var bindMarkerinfo = function (marker) {
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

  var bindMarkerEvents = function (marker) {
    google.maps.event.addListener(marker, "rightclick", function (point) {
      var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
      var marker = markers[markerId]; // find marker
      window.removeMarker(marker, markerId); // remove it
    });
  };


  window.removeMarker = function (marker, markerId) {
    marker.setMap(null); // set markers setMap to null to remove it from map
    delete markers[markerId]; // delete marker instance from markers object
  };



  var i; var confirmed = 0;
  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map,
      icon: locations[i][4] === '1' ? red_icon : purple_icon,
      html: "<div>\n" +
        "<table class=\"map1\">\n" +
        "<tr>\n" +
        "<td><a>Description:</a></td>\n" +
        "<td><textarea disabled id='manual_description' placeholder='Description'>" + locations[i][3] + "</textarea></td></tr>\n" +
        "</table>\n" +
        "</div>"
    });

    google.maps.event.addListener(marker, 'click', (function (marker, i) {
      return function () {
        infowindow = new google.maps.InfoWindow();
        confirmed = locations[i][4] === '1' ? 'checked' : 0;
        $("#confirmed").prop(confirmed, locations[i][4]);
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
  window.saveData = function (lat, lng) {

    // get description
    var description = document.getElementById('manual_description').value;

    axios.post('/locations/', {
      lat: lat,
      lng: lng,
      description: description,
    })
      .then(function (response) {

        if (response.data.error == 0) {


          locations.forEach(function (el) {
            var markerId = el.lat + '_' + el.lng;
            var marker = markers[markerId];
            window.removeMarker(marker, markerId); // remove it
          });


          var markerId = lat + '_' + lng;
          var marker = markers[markerId];
          window.removeMarker(marker, markerId);


          console.log(JSON.stringify(response.data.locations));
          locations = response.data.locations;
          locations.forEach(function (location) {
            var lat = location.lat; // lat of clicked point
            var lng = location.lng; // lng of clicked point
            var markerId = lat + '_' + lng; // an that will be used to cache this marker in markers object.
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng(lat, lng),
              map: map,
              icon: purple_icon,
              animation: google.maps.Animation.DROP,
              id: 'marker_' + markerId,
              html: "    <div id='info_" + markerId + "'>\n" +
                "        <div class=\"map1\">\n" +
                "                 <textarea  id='manual_description' placeholder='قم بكتابة وصف للمكان هنا'>" + location.description + "</textarea>\n" +
                "                 <button type='button' id='deleteLocationInput' onclick='window.deleteLoction( " + lat + " , " + lng + ")'>حذف</button>" +
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

    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        callback(request.responseText, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }











var locations = {!! $locations !!};


locations.forEach(function (location) {
  var lat = location.lat; // lat of clicked point
  var lng = location.lng; // lng of clicked point
  var markerId = lat + '_' + lng; // an that will be used to cache this marker in markers object.
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(lat, lng),
    map: map,
    icon: purple_icon,
    animation: google.maps.Animation.DROP,
    id: 'marker_' + markerId,
    html: "    <div id='info_" + markerId + "'>\n" +
      "        <div class=\"map1\">\n" +
      "                 <textarea  id='manual_description' placeholder='قم بكتابة وصف للمكان هنا'>" + location.description + "</textarea>\n" +
      "                 <button type='button' id='deleteLocationInput' onclick='window.deleteLoction( " + lat + " , " + lng + ")'>حذف</button>" +
      "        </div>\n" +
      "    </div>"
  });
  markers[markerId] = marker; // cache marker in markers object
  bindMarkerEvents(marker); // bind right click event to marker
  bindMarkerinfo(marker); // bind infowindow with click event to marker "+location.id+"
});



window.deleteLoction = function (lat, lng) {

  var lat = lat;
  var lng = lng;
  var markerId = lat + '_' + lng;
  var marker = markers[markerId]; // find marker


  axios.delete('/locations/' + markerId, {
    params: {
      lat: lat,
      lng: lng,
    }

  })
    .then(function (response) {

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

