<?php
require('mysql_connect.php');

$result = mysql_query("SELECT * FROM _airport ORDER BY airport_id ASC") 
or die(mysql_error());  

global $AIRPORT_LIST;

while($row = mysql_fetch_array( $result )) {
	$airport['airport_id'] = $row['airport_id'];
	$airport['name'] = $row['name'];
	$airport['city'] = $row['city'];
	$airport['latitude'] = $row['latitude'];
	$airport['longitude'] = $row['longitude'];
	$AIRPORT_LIST[] = $airport;
} 

?>
 
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
</head>
<body>
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
</body>
</html>