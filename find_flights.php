<?php

require('mysql_connect.php');

$airport_id = $_REQUEST['departure_airport'];
$departure_date = $_REQUEST['departure_date'];

$result = mysql_query("SELECT name, latitude, longitude FROM _airport
WHERE airport_id = '".$airport_id."'") 
or die(mysql_error());
$row = mysql_fetch_array( $result );
$departure_airport['airport_id'] = $airport_id;
$departure_airport['name'] = $row['name'];
$departure_airport['latitude'] = $row['latitude'];
$departure_airport['longitude'] = $row['longitude'];

echo "Finding flights that depart from ".$departure_airport['airport_id']." on $departure_date...\n\n";

$flights = array();

$result = mysql_query("SELECT arrival_airport FROM _flight
WHERE departure_date = '$departure_date' AND departure_airport = '$airport_id'") 
or die(mysql_error());  

while($row = mysql_fetch_array( $result )) {

	$flight['airport_id'] = $row['arrival_airport'];
	
	$result2 = mysql_query("SELECT name, latitude, longitude FROM _airport
	WHERE airport_id = '".$row['arrival_airport']."'") 
	or die(mysql_error());
	
	$row2 = mysql_fetch_array( $result2 );
	$flight['name'] = $row2['name'];
	$flight['latitude'] = $row2['latitude'];
	$flight['longitude'] = $row2['longitude'];
	
	array_push($flights, $flight);

}
?>
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
          center: new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
          zoom: 4,
          mapTypeId: google.maps.MapTypeId.TERRAIN 
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);


<?php foreach ($flights as $flight): ?>
		
		  var flightPlanCoordinates = [
		  
			new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
			new google.maps.LatLng(<?php echo $flight['latitude'] ?>, <?php echo $flight['longitude'] ?>),
		  ];
		  var flightPath = new google.maps.Polyline({
			path: flightPlanCoordinates,
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 0.5,
			strokeWeight: 5
		  });
		  
		  flightPath.setMap(map);
<?php endforeach ?>
		  
		 var marker = new google.maps.Marker({
			position: new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
			map: map,
			strokeColor: '#FF00FF',
			title: '<?php echo mysql_real_escape_string($departure_airport['name']) ?>'
		});

<?php foreach ($flights as $flight): ?> 
		 var marker = new google.maps.Marker({
			position: new google.maps.LatLng(<?php echo $flight['latitude'] ?>, <?php echo $flight['longitude'] ?>),
			map: map,
			title: '<?php echo mysql_real_escape_string($flight['name']) ?>'
		});
		
		marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
<?php endforeach ?>

		
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"/>
  </body>
</html>