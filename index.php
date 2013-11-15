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
			html { height: 100% }
			body { height: 100%; margin: 0; padding: 0;  }
		</style>
	</head>
	<body>
		<div align="center">
			<form action="find_flights.php" method="get">
				I am departing from  
				<select name="departure_airport">
					<?php foreach ($AIRPORT_LIST as $value): ?>
						<option value="<?php echo $value['airport_id'] ?>"><?php echo $value['airport_id'] ." - ". $value['name'] ?></option>
					<?php endforeach ?>
				</select>
				on
				<input name="departure_date" type="text" id="datepicker" />
				<input type="submit" value="Find Flights" />
			</form>
		</div>
	</body>
</html>