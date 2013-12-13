<?php require_once('find_flights_controller.php'); ?>
<?php require_once('index_controller.php'); ?>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style type="text/css">
			html { height: 100%; }
			body { overflow: hidden; height: 100%; margin: 0; padding: 0; font-family: arial; font-size: 2em;  }
			#map-canvas { height: 60% }
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
					
					}, <?php echo $count++; ?> * 60 + 550);
					
				<?php endforeach ?>
				
				var marker = new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
				map: map,
				strokeColor: '#474748',
				title: '<?php echo mysql_real_escape_string($departure_airport['name']) ?>',
				animation: google.maps.Animation.DROP
				});
				
				marker.setIcon('images/white.png');
				
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
				
					var contentString<?php echo $count; ?> = '<div style="width: 300px" id="content">'+
					'<div id="siteNotice">'+
					'</div>'+
					'<h3>Arrive at <?php echo mysql_real_escape_string($flight['name']) ?> Airport</h3>'+
					'<div id="bodyContent">'+
					'<p><b>$ <?php echo $flight['price']; ?>.00</b></p><p>Hurry! There are only <?php echo $flight['seats_available']; ?> sets left!</p><p>You would fly on a <b><?php echo $flight['airplane']['make'] ?> <?php echo $flight['airplane']['model'] ?></b><br/>' +
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
					
						marker<?php echo $count++; ?>.setIcon('images/black.png');
					
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
						window.location = ('find_flights.php?departure_airport=<?php echo $_REQUEST['departure_airport']; ?>&departure_date=<?php echo $_REQUEST['departure_date']; ?>&radius=' + ui.value  + '&max_price=' + <?php echo $_REQUEST['max_price'] ?>); 
					},
					slide: function( event, ui ) {
						flightRadius.setRadius(ui.value * 1609.34);
						$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) + " miles" );
					}
					
					//
				});
				
				$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) + " miles" );
			});	
			
			$(function() {
				$( "#slider-vertical2" ).slider({
					orientation: "horizontal",
					range: "min",
					min: 0,
					max: 2000,
					step: 10,
					value: <?php echo $_REQUEST['max_price']; ?>,
					stop: function(event, ui){
						$( "#amount2" ).val( "$" + $( "#slider-vertical2" ).slider( "value" ) + ".00" );
						window.location = ('find_flights.php?departure_airport=<?php echo $_REQUEST['departure_airport']; ?>&departure_date=<?php echo $_REQUEST['departure_date']; ?>&radius=<?php echo $_REQUEST['radius']; ?>&max_price=' + ui.value); 
					},
					slide: function( event, ui ) {
						$( "#amount2" ).val( "$" + $( "#slider-vertical2" ).slider( "value" ) + ".00" );
					}
					
					//
				});
				
				$( "#amount2" ).val( "$" + $( "#slider-vertical2" ).slider( "value" ) + ".00" );
			});	
			
		</script>
	</head>
	<body>
		<div align="center" style="font-size:3em; color: #e67e22; text-shadow: 4px 2px #16828c">sponPLANEous</div><br/>
		<div align="center">
				<form action="find_flights.php" method="get">
					I am departing from  
					<select name="departure_airport" style="font-size:1em;">
						<?php foreach ($AIRPORT_LIST as $value): ?>
							<option <?php if ($value['airport_id'] == $_REQUEST['departure_airport']) echo 'selected'; ?> value="<?php echo $value['airport_id'] ?>"><?php echo $value['airport_id'] ." - ". $value['name'] ?></option>
						<?php endforeach ?>
					</select>
					on
					<input width="11" style="font-size:1em;" name="departure_date" type="text" id="datepicker" value="<?php echo $_REQUEST['departure_date']; ?>" />
					<input type="submit" value="Find Flights" style="font-size:1em;" />
					<input type="hidden" name="radius" value="1000" />
					<input type="hidden" name="max_price" value="1000" />
				</form>
	<div style="float:left; width = 200px; height: 100px; background-color:white; color:white">ddddddddddddddddddddd</div>
	<div align="center">
		<div align="center" style="float:left;">Maximum Distance:
			<input type="text" id="amount" style="color:#e67e22; border:0; font-weight:bold; font-size: 1em;"></input><br>	
			<div id="slider-vertical" style="width:500px;"></div>			
		</div>
		
		<div align="center" style="float:left;">Maximum Price:
			<input type="text" id="amount2" style="color:#e67e22; border:0; font-weight:bold; font-size: 1em;"></input><br>
			<div id="slider-vertical2" style="width:500px;"></div>
		</div>
		</div>
		
		
		<br/>
		<br/>
		<br/>
		

		<div style="border-style:solid;"id="map-canvas"/>
		</div>
		<div align="center">&copy 2013 sponPLANEous</div><br><br>
	</body>
</html>