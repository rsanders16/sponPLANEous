<?php

for($i = 1 ; $i <= 100 ; $i++) 
{
	mysql_query("INSERT INTO `coms461`.`_trip` 
	(`trip_id`, `price`) 
	VALUES ('".$i."', '".$i."');") 
	or die(mysql_error());  
}

echo "Trip Data Inserted<br/>";