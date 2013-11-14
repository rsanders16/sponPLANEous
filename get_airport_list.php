<?php

require('mysql_connect.php');
require('constants.php');

// Get all the data from the "example" table
$result = mysql_query("SELECT * FROM _airport ORDER BY airport_id ASC") 
or die(mysql_error());  

global $AIRPORT_LIST;

while($row = mysql_fetch_array( $result )) {
	$airport['airport_id'] = $row['airport_id'];
	$airport['name'] = $row['name'];
	$airport['city'] = $row['city'];
	$airport['latitude'] = $row['latitude'];
	$airport['longitude'] = $row['longitude'];
	$AIRPORT_LIST[] = $airport;
} 

?>