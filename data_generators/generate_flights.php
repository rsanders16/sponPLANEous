<?php

require_once('../mysql_connect.php');

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

$result = mysql_query("SELECT * FROM _airplane ORDER BY model ASC") 
or die(mysql_error());  

$AIRPLANE_LIST;

while($row = mysql_fetch_array( $result )) {
	$airplane['airplane_id'] = $row['airplane_id'];
	$airplane['make'] = $row['make'];
	$airplane['model'] = $row['model'];
	$airplane['capacity'] = $row['capacity'];
	$airplane['image_url'] = $row['image_url'];
	$AIRPLANE_LIST[] = $airplane;
} 

$count = 0;
for($i = 1 ; $i <= 25 ; $i++) 
{
		$random_index = rand(0, count($AIRPLANE_LIST) - 1);
		mysql_query("INSERT INTO `coms461`.`_flight` 
		(`flight_id`, `airplane_id`, `departure_date`, `arrival_date`, `seats_available`, `departure_airport`, `arrival_airport`) 
		VALUES ('".($count++)."', '".$AIRPLANE_LIST[$random_index]['airplane_id']."', '11/11/2013', '11/11/2013', '".rand(1, $AIRPLANE_LIST[$random_index]['capacity'])."', 'DSM', '".$AIRPORT_LIST[rand(0,count($AIRPORT_LIST) - 1)]['airport_id']."');") 
		or die(mysql_error());
		
		$random_index = rand(0, count($AIRPLANE_LIST) - 1);
		mysql_query("INSERT INTO `coms461`.`_flight` 
		(`flight_id`, `airplane_id`, `departure_date`, `arrival_date`, `seats_available`, `departure_airport`, `arrival_airport`) 
		VALUES ('".($count++)."', '".$AIRPLANE_LIST[$random_index]['airplane_id']."', '11/11/2013', '11/11/2013', '".rand(1, $AIRPLANE_LIST[$random_index]['capacity'])."', 'ORD', '".$AIRPORT_LIST[rand(0,count($AIRPORT_LIST) - 1)]['airport_id']."');") 
		or die(mysql_error());
}

echo "Flight Data Inserted<br/>";