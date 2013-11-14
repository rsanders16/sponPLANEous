<?php

require_once('mysql_connect.php');
require_once('constants.php');

for($i = 1 ; $i <= 100 ; $i++) 
{
	mysql_query("INSERT INTO `coms461`.`_departures` 
	(`flight_id`, `airport_id`) 
	VALUES ('".$i."', '".$i."');") 
	or die(mysql_error());  
}

echo "Departure Data Inserted<br/>";