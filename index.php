<?php require_once('index_controller.php'); ?>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>sponPLANEous</title>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script>
			$(function() {
			  $( "#datepicker" ).datepicker();
			});
		</script>
		<style type="text/css">
			html { height: 100%; }
			body { overflow: hidden; height: 100%; margin: 0; padding: 0; font-family: arial; font-size: 2em;  }
			#map-canvas { height: 50% }
		</style>
	</head>
	<body>
		<div align="center" style="font-size:3em; color: #e67e22; text-shadow: 4px 2px #16828c">sponPLANEous</div><br/>
		<div align="center">
				<form action="find_flights.php" method="get">
					I am departing from  
					<select name="departure_airport" style="font-size:1em;">
						<?php foreach ($AIRPORT_LIST as $value): ?>
							<option value="<?php echo $value['airport_id'] ?>"><?php echo $value['airport_id'] ." - ". $value['name'] ?></option>
						<?php endforeach ?>
					</select>
					on
					<input width="11" style="font-size:1em;" name="departure_date" type="text" id="datepicker" />
					<input type="submit" value="Find Flights" style="font-size:1em;" />
					<input type="hidden" name="radius" value="1000" />
				</form>
	
	
		<div align="center">&copy 2013 sponPLANEous</div>
	</body>
</html>