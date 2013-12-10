<?php require_once('find_flights_controller.php'); ?>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style type="text/css">
			html { height: 100% }
			body { height: 100%; margin: 0; padding: 0 }
			#map-canvas { height: 100% }
		</style>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script type="text/javascript"
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQrfmbUdImjLrxAgzucoNLD8srtFBwOM8&sensor=true"></script>
		<script type="text/javascript">
		var mapOptions;
		var map;
		var cityCircle;
		var polylines = [];
		var markers = [];
		var infowindows = [];
			function initialize(radius) {
			
				if (!(radius > 100))
					radius = 1000;
					
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
							elementType: "geometry.fill",
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
							  { visibility: "off" }
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
							  { visibility: "off" }
							]
						  },{
							featureType: "water",
							stylers: [
							  { color: "##16828c" }
							]
						  }
						],
						mapTypeId: google.maps.MapTypeId.ROADMAP
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
				  radius: radius * 1609.34
				};
				
				cityCircle = new google.maps.Circle(circleOptions);
				
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
			
			
			var infowindow = "";
			function addLegs(radius) {
	
	
			$.get( "find_flights_controller.php?departure_airport=<?php echo $_REQUEST['departure_airport']; ?>&departure_date=<?php echo $_REQUEST['departure_date']; ?>&radius=" + radius, function( data ) {
				data = jQuery.parseJSON(data);
				
				
				for (i = 0 ; i < polylines.length; i++)
				{
					polylines[i].setMap(null);
					markers[i].setMap(null);
					//infowindows[i].setMap(null);
				}

				
				polylines = [];
				markers = [];
				infowindows = [];
				infowindows  = [data.length];
				
				for (i = 0 ; i < data.length; i++) 
				{
					
					
					var flightPlanCoordinates = [
					
						new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
						new google.maps.LatLng(data[i].latitude, data[i].longitude),
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
					
					contentString[i] = '<div id="content">'+
					'<div id="siteNotice">'+
					'</div>'+
					'<h3>Arrive at ' + data[i]['name'] + ' Airport</h3>'+
					'<div id="bodyContent">'+
					'<p>You would fly on a <b>' + data[i]['airplane']['make'] + ' ' + data[i]['airplane']['modle'] + '</b><br/>' +
					'<img width=200px height=100px  src="' + data[i]['airplane']['image_url'] + '" /></p>'+
					'</div>'+
					'</div>';
					
					var infowindow = new google.maps.InfoWindow({
					content: contentString[i],
					});
					
					var marker = new google.maps.Marker({
						position: new google.maps.LatLng(data[i].latitude, data[i].longitude),
						map: map,
						title: data[i].name
					});
					
					google.maps.event.addListener(marker, 'mouseover', function() {
						infowindow.open(map,marker);
					});
					
					google.maps.event.addListener(marker, 'mouseout', function() {
						infowindow.close();
					});
				
					marker.setIcon('black.png');
					markers.push(marker);
				}
			});
			
			return;
			
			<?php $offset = $count + 1; $count = 0 ?>
				<?php foreach ($flights as $flight): ?>
				
				setTimeout(function() {
					
						var flightPlanCoordinates = [
					
						new google.maps.LatLng(<?php echo $departure_airport['latitude'] ?>, <?php echo $departure_airport['longitude'] ?>),
						new google.maps.LatLng(<?php echo $flight['latitude'] ?>, <?php echo $flight['longitude'] ?>),
						];
						var flightPath = new google.maps.Polyline({
						path: flightPlanCoordinates,
						geodesic: true,
						strokeColor: 'pink',
						strokeOpacity: 1,
						strokeWeight: 6,
						zIndex: 1000 
						});
						
						flightPath.setMap(map);
					
					}, <?php echo $count++; ?> * 60 + 550);
					
				<?php endforeach ?>
				
				<?php $count = 0; ?>
				<?php foreach ($flights as $flight): ?>
				
					var contentString<?php echo $count + $offset; ?> = '<div id="content">'+
					'<div id="siteNotice">'+
					'</div>'+
					'<h3>Arrive at <?php echo mysql_real_escape_string($flight['name']) ?> Airport</h3>'+
					'<div id="bodyContent">'+
					'<p>You would fly on a <b><?php echo $flight['airplane']['make'] ?> <?php echo $flight['airplane']['model'] ?></b><br/>' +
					'<img width=200px height=100px  src="<?php echo $flight['airplane']['image_url'] ?>" /></p>'+
					'</div>'+
					'</div>';
					
					var infowindow<?php echo $count + $offset; ?> = new google.maps.InfoWindow({
					content: contentString<?php echo $count + $offset; ?>,
					});
					
					setTimeout(function() {
					
						var marker<?php echo $count + $offset; ?> = new google.maps.Marker({
						position: new google.maps.LatLng(<?php echo $flight['latitude'] ?>, <?php echo $flight['longitude'] ?>),
						map: map,
						title: '<?php echo mysql_real_escape_string($flight['name']) ?>',
						animation: google.maps.Animation.DROP,
						zIndex: 1000 
						});
						
						google.maps.event.addListener(marker<?php echo $count + $offset; ?>, 'mouseover', function() {
						infowindow<?php echo $count + $offset; ?>.open(map,marker<?php echo $count + $offset; ?>);
						});
						
						google.maps.event.addListener(marker<?php echo $count + $offset; ?>, 'mouseout', function() {
						infowindow<?php echo $count + $offset; ?>.close();
						});
					
						marker<?php echo ($count++) + $offset; ?>.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');
					
					}, <?php echo $count; ?> * 50 + 300);	

				<?php endforeach ?>	
			}


			
  $(function() {
    $( "#slider-vertical" ).slider({
      orientation: "vertical",
      range: "min",
      min: 0,
      max: 3000,
      value: <?php echo $_REQUEST['radius']; ?>,
	  stop: function(event, ui){ initialize(ui.value) },
      slide: function( event, ui ) {
		cityCircle.setRadius(ui.value * 1609.34);	
      }
    });
    
	$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) );
	
	
  });
  
  
			
		</script>
	</head>
	<body>
<p>
  <label for="amount">Volume:</label>
  <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
</p>
 
<div id="slider-vertical" style="height:200px;"></div>
		<div id="map-canvas"/>
		
	</body>
</html>

<script>
</script>