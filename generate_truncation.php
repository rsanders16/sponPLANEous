<?php

require_once('mysql_connect.php');
require_once('constants.php');

mysql_query("TRUNCATE TABLE  `_airplane`") 
or die(mysql_error());  

mysql_query("TRUNCATE TABLE  `_airport`") 
or die(mysql_error());   

mysql_query("TRUNCATE TABLE  `_flight`") 
or die(mysql_error());  

mysql_query("TRUNCATE TABLE  `_flights`") 
or die(mysql_error());  

mysql_query("TRUNCATE TABLE  `_trip`") 
or die(mysql_error());

echo "Database Truncated<br/>";
