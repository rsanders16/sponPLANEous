<?php

require_once('mysql_connect.php');
require_once('constants.php');

for($i = 1 ; $i <= 100 ; $i++) 
{
	mysql_query("INSERT INTO `coms461`.`_flights` 
	(`flight_id`, `trip_id`) 
	VALUES ('".$i."', '".$i."');") 
	or die(mysql_error());  
}

echo "Trip Flight Data Inserted<br/>";