<?php require_once('find_flights_controller.php'); ?>
<?php require_once('index_controller.php'); ?>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style type="text/css">
			html { height: 100% }
			body { height: 100%; margin: 0; padding: 0; font-family: arial }
			#map-canvas { height: 100% }
		</style>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQrfmbUdImjLrxAgzucoNLD8srtFBwOM8&sensor=true"></script>
		<script>
			$(function() {
			  $( "#datepicker" ).datepicker();
			});
		</script>
		<script type="text/javascript">
			var flightRadius;
			
			function initialize() {
					
				  mapOptions = {
					center: new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
					zoom: 4,
					styles:[
						  {
							featureType: "administrative",
							elementType: "labels.text",
							stylers: [
							  { color: "#808080" },
							  { visibility: "off" }
							]
						  },{
							featureType: "landscape",
							
							stylers: [
							  { visibility: "on" },
							  { color: "#e67e22" }
							]
						  },{
							featureType: "road",
							elementType: "geometry.stroke",
							stylers: [
							  { visibility: "off" }
							]
						  },{
							featureType: "road.arterial",
							elementType: "geometry.fill",
							stylers: [
							  { visibility: "on" }
							]
						  },{
							featureType: "road.highway",
							elementType: "geometry.fill",
							stylers: [
							  { visibility: "off" }
							]
						  },{
							elementType: "labels",
							stylers: [
							  { visibility: "off", color: "white" }
							]
						  },{
							featureType: "water",
							stylers: [
							  { color: "#16828c" }
							]
						  }
						],
						mapTypeId: google.maps.MapTypeId.TERRAIN 
				  };
				  
				  map = new google.maps.Map(document.getElementById("map-canvas"),
					  mapOptions);
				
				<?php $count = 1; ?>
				<?php foreach ($flights as $flight): ?>
				
				setTimeout(function() {
				
					
						var flightPlanCoordinates = [
					
						new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
						new google.maps.LatLng(<?php echo $flight['latitude'] ?>, <?php echo $flight['longitude'] ?>),
						];
						var flightPath = new google.maps.Polyline({
						path: flightPlanCoordinates,
						geodesic: true,
						strokeColor: 'gray',
						strokeOpacity: 0.75,
						strokeWeight: 2,
						zIndex: 1000
						});
						
						
						flightPath.setMap(map);
						polylines.push(flightPath);
					
					}, <?php echo $count++; ?> * 60 + 550);
					
				<?php endforeach ?>
				
				var marker = new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
				map: map,
				strokeColor: '#474748',
				title: '<?php echo mysql_real_escape_string($departure_airport['name']) ?>',
				animation: google.maps.Animation.DROP
				});
				
				marker.setIcon('white.png');
				
				var circleOptions = {
				  strokeColor: '#cce5ff',
				  strokeOpacity: 0.8,
				  strokeWeight: 2,
				  fillColor: '#cce5ff',
				  fillOpacity: 0.3,
				  map: map,
				  center: new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
				  radius: <?php echo $_REQUEST['radius'] ?> * 1609.34
				};
				
				flightRadius = new google.maps.Circle(circleOptions);
				
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
					
					setTimeout(function() {
					
						var marker<?php echo $count; ?> = new google.maps.Marker({
						position: new google.maps.LatLng(<?php echo $flight['latitude'] ?>, <?php echo $flight['longitude'] ?>),
						map: map,
						title: '<?php echo mysql_real_escape_string($flight['name']) ?>',
						animation: google.maps.Animation.DROP
						});
						
						google.maps.event.addListener(marker<?php echo $count; ?>, 'mouseover', function() {
						infowindow<?php echo $count; ?>.open(map,marker<?php echo $count; ?>);
						});
						
						google.maps.event.addListener(marker<?php echo $count; ?>, 'mouseout', function() {
						infowindow<?php echo $count; ?>.close();
						});
					
						marker<?php echo $count; ?>.setIcon('black.png');
						markers.push(marker<?php echo $count++; ?>);
					
					}, <?php echo $count; ?> * 50 + 300);	
			
				<?php endforeach ?>		
				
			}
				
			google.maps.event.addDomListener(window, 'load', initialize);
			
			// slider control 
			$(function() {
				$( "#slider-vertical" ).slider({
					orientation: "horizontal",
					range: "min",
					min: 0,
					max: 3000,
					step: 10,
					value: <?php echo $_REQUEST['radius']; ?>,
					stop: function(event, ui){
						flightRadius.setRadius(ui.value * 1609.34);
						$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) + " miles" );
						window.location = ('find_flights.php?departure_airport=DSM&departure_date=12%2F03%2F2013&radius=' + ui.value); 
					},
					slide: function( event, ui ) {
						flightRadius.setRadius(ui.value * 1609.34);
						$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) + " miles" );
					}
					
					//
				});
				
				$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) + " miles" );
			});	
			
		</script>
	</head>
	<body>
		<div align="center">
				<form action="find_flights.php" method="get">
					I am departing from  
					<select name="departure_airport">
						<?php foreach ($AIRPORT_LIST as $value): ?>
							<option <?php if ($value['airport_id'] == $_REQUEST['departure_airport']) echo 'selected'; ?> value="<?php echo $value['airport_id'] ?>"><?php echo $value['airport_id'] ." - ". $value['name'] ?></option>
						<?php endforeach ?>
					</select>
					on
					<input name="departure_date" type="text" id="datepicker" />
					<input type="submit" value="Find Flights" />
					<input type="hidden" name="radius" value="1000" />
				</form>
		

			Flight Radius Maximum:
			<input type="text" id="amount" style="color:#e67e22">
			<br />
		<div id="slider-vertical" style="width:500px;"></div>
		<br />
		<div id="map-canvas"/>
		</div>
	</body>
</html>