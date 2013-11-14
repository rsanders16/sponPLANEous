<?php

require_once('mysql_connect.php');

// Get all the data from the "example" table
$result = mysql_query("SELECT * FROM _airport ORDER BY airport_id ASC") 
or die(mysql_error());  

$AIRPORT_LIST;

while($row = mysql_fetch_array( $result )) {
	$airport['airport_id'] = $row['airport_id'];
	$airport['name'] = $row['name'];
	$airport['city'] = $row['city'];
	$airport['latitude'] = $row['latitude'];
	$airport['longitude'] = $row['longitude'];
	$AIRPORT_LIST[] = $airport;
} 

$count = 0;
for($i = 1 ; $i <= 25 ; $i++) 
{
	
	//for($j = 1 ; $j <= 25 ; $j++) 
	//{
		mysql_query("INSERT INTO `coms461`.`_flight` 
		(`flight_id`, `airplane_id`, `departure_date`, `arrival_date`, `seats_available`, `departure_airport`, `arrival_airport`) 
		VALUES ('".($count++)."', '".$i."', '11/11/2013', '11/11/2013', '".(1000 - $i)."', 'DSM', '".$AIRPORT_LIST[rand(0,2236)]['airport_id']."');") 
		or die(mysql_error());
		
		mysql_query("INSERT INTO `coms461`.`_flight` 
		(`flight_id`, `airplane_id`, `departure_date`, `arrival_date`, `seats_available`, `departure_airport`, `arrival_airport`) 
		VALUES ('".($count++)."', '".$i."', '11/11/2013', '11/11/2013', '".(1000 - $i)."', 'ORD', '".$AIRPORT_LIST[rand(0,2236)]['airport_id']."');") 
		or die(mysql_error());
	//}
}

echo "Flight Data Inserted<br/>";