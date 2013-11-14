<?php

require('mysql_connect.php');
require('constants.php');

for($i = 1 ; $i <= 100 ; $i++) 
{
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`) 
	VALUES ('".$i."', 'Boeing', '".(747 + $i)."', '1000');") 
	or die(mysql_error());  
}

echo "Airplane Data Inserted<br/>";