<?php require_once('find_flights_controller.php'); ?>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style type="text/css">
			html { height: 100% }
			body { height: 100%; margin: 0; padding: 0 }
			#map-canvas { height: 100% }
		</style>
		<script type="text/javascript"
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQrfmbUdImjLrxAgzucoNLD8srtFBwOM8&sensor=true"></script>
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
				
				<?php $count = 0; ?>
				<?php foreach ($flights as $flight): ?>
				
					var contentString<?php echo $count; ?> = '<div id="content">'+
					'<div id="siteNotice">'+
					'</div>'+
					'<h3>Arrive at <?php echo mysql_real_escape_string($flight['name']) ?> Airport</h3>'+
					'<div id="bodyContent">'+
					'<p>You would fly on a <b><?php echo $flight['airplane']['make'] ?> <?php echo $flight['airplane']['model'] ?></b><br/>' +
					'<img width=200px height=100px  src="<?php echo $flight['airplane']['image_url'] ?>" /></p>'+
					'</div>'+
					'</div>';
					
					var infowindow<?php echo $count; ?> = new google.maps.InfoWindow({
					content: contentString<?php echo $count; ?>,
					});
					
					
					var marker<?php echo $count; ?> = new google.maps.Marker({
					position: new google.maps.LatLng(<?php echo $flight['latitude'] ?>, <?php echo $flight['longitude'] ?>),
					map: map,
					title: '<?php echo mysql_real_escape_string($flight['name']) ?>'
					});
					
					google.maps.event.addListener(marker<?php echo $count; ?>, 'mouseover', function() {
					infowindow<?php echo $count; ?>.open(map,marker<?php echo $count; ?>);
					});
					
					google.maps.event.addListener(marker<?php echo $count; ?>, 'mouseout', function() {
					infowindow<?php echo $count; ?>.close();
					});
				
				marker<?php echo $count++; ?>.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
				<?php endforeach ?>
				
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</head>
	<body>
		<div id="map-canvas"/>
	</body>
</html>