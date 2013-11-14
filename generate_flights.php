<?php

require_once('mysql_connect.php');
require_once('constants.php');

for($i = 1 ; $i <= 100 ; $i = $i + 2) 
{
	mysql_query("INSERT INTO `coms461`.`_flight` 
	(`flight_id`, `airplane_id`, `departure_date`, `arrival_date`, `seats_available`) 
	VALUES ('".$i."', '".$i."', '11/".$i."/2013', '".$i."', '".(1000 - $i)."');") 
	or die(mysql_error());

	mysql_query("INSERT INTO `coms461`.`_flight` 
	(`flight_id`, `airplane_id`, `departure_date`, `arrival_date`, `seats_available`) 
	VALUES ('".($i + 1)."', '".$i."', '11/".$i."/2013', '".$i."', '".(1000 - $i)."');") 
	or die(mysql_error());	
}

echo "Flight Data Inserted<br/>";