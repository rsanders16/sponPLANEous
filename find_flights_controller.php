<?php
require_once("DATABASE_SETTINGS.php");
mysql_connect(SERVER, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());

function log_query($query) 
{
	mysql_query("INSERT INTO _log (statement) VALUES('".mysql_real_escape_string($query)."')");
}

$airport_id = mysql_real_escape_string($_REQUEST['departure_airport']);
$departure_date = mysql_real_escape_string($_REQUEST['departure_date']);
$departure_date = "11/11/2013"; //comment this line out to stop demo

$query = "SELECT name, latitude, longitude FROM _airport WHERE airport_id = '".$airport_id."'";
$result = mysql_query($query) 
or die(mysql_error());
log_query($query);

$row = mysql_fetch_array( $result );
$departure_airport['airport_id'] = $airport_id;
$departure_airport['name'] = mysql_real_escape_string($row['name']);
$departure_airport['latitude'] = $row['latitude'];
$departure_airport['longitude'] = $row['longitude'];

$flights = array();


$price = ($_REQUEST['max_price'] > -1) ? $_REQUEST['max_price'] : 9000;
$query = "SELECT flight_id, arrival_airport, airplane_id, seats_available FROM _flight WHERE departure_date =  '".$departure_date."' AND departure_airport =  '".$_REQUEST['departure_airport']."' AND flight_id = ANY(SELECT flight_id FROM _flights WHERE trip_id = ANY (SELECT trip_id FROM _trip WHERE price <= ".$price."))";
$result = mysql_query($query) 
or die(mysql_error());
log_query($query);
//echo $query;
//die;

$count = 0;
while($row = mysql_fetch_array( $result )) {

	$flight['airport_id'] = $row['arrival_airport'];
	
	$result2 = mysql_query("SELECT price FROM _trip WHERE trip_id = " . $row['flight_id']);
	$row2 = mysql_fetch_array( $result2 );
	$flight['price'] = $row2['price'];
	$flight['seats_available'] = $row['seats_available'];
	
	$radius = $_REQUEST['radius'];
	
	if (!($radius > -1))
		$radius = 1000;
	
	$d = "((ACOS(SIN(RADIANS(".$departure_airport['latitude']."))*SIN(RADIANS(latitude)) + COS(RADIANS(".$departure_airport['latitude']."))*COS(RADIANS(latitude)) * COS(RADIANS(longitude)-RADIANS(".$departure_airport['longitude']."))) * 6371) < (".$radius." * 1.60934))";

	
	$query = "SELECT name, latitude, longitude FROM _airport WHERE airport_id = '".$row['arrival_airport'] . "' AND " . $d;
	$result2 = mysql_query($query) 
	or die(mysql_error());
	
	if ($count == 0)
		log_query($query);
	$count++;

	if (mysql_num_rows($result2) == 0)
		continue;
	
	$row2 = mysql_fetch_array( $result2 );
	$flight['name'] = $row2['name'];
	$flight['latitude'] = $row2['latitude'];
	$flight['longitude'] = $row2['longitude'];
	
	$result3 = mysql_query("SELECT * FROM _airplane
	WHERE airplane_id = '".$row['airplane_id']."'") 
	or die(mysql_error());
	
	$row3 = mysql_fetch_array( $result3 );
	$airplane['airplane_id'] = $row3['airplane_id'];
	$airplane['make'] = $row3['make'];
	$airplane['model'] = $row3['model'];
	$airplane['capacity'] = $row3['capacity'];
	$airplane['image_url'] = $row3['image_url'];
	$flight['airplane'] = $airplane;
	
	array_push($flights, $flight);

}

//echo json_encode($flights);



















