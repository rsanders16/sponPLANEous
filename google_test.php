<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQrfmbUdImjLrxAgzucoNLD8srtFBwOM8&sensor=true">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(42.0360,-93.4652),
          zoom: 4,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
		
		  var flightPlanCoordinates = [
			new google.maps.LatLng(42.0360,-93.4652),
			new google.maps.LatLng(32.0360,-83.4652),
			new google.maps.LatLng(42.0360,-73.4652),
			new google.maps.LatLng(42.0360,-63.4652)
		  ];
		  var flightPath = new google.maps.Polyline({
			path: flightPlanCoordinates,
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
		  });
		  
		 var marker = new google.maps.Marker({
			position: new google.maps.LatLng(42.0360,-93.4652),
			map: map,
			title: 'Hello World!'
		});
		
		 var marker = new google.maps.Marker({
			position: new google.maps.LatLng(32.0360,-83.4652),
			map: map,
			title: 'Hello World!'
		});
		
		 var marker = new google.maps.Marker({
			position: new google.maps.LatLng(42.0360,-73.4652),
			map: map,
			title: 'Hello World!'
		});
		 var marker = new google.maps.Marker({
			position: new google.maps.LatLng(42.0360,-63.4652),
			map: map,
			title: 'Hello World!'
		});

		  flightPath.setMap(map);
		
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"/>
  </body>
</html>