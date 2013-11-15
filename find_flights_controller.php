<?php
require_once("DATABASE_SETTINGS.php");
mysql_connect(SERVER, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());

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

$flights = array();

$result = mysql_query("SELECT arrival_airport, airplane_id FROM _flight
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
