<?php
require_once("DATABASE_SETTINGS.php");
mysql_connect(SERVER, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());

$query = "SELECT * FROM _airport ORDER BY airport_id ASC";
$result = mysql_query($query) 
or die(mysql_error());  

mysql_query("INSERT INTO _log (statement) VALUES('".mysql_real_escape_string($query)."')");

global $AIRPORT_LIST;

while($row = mysql_fetch_array( $result )) {
	$airport['airport_id'] = $row['airport_id'];
	$airport['name'] = $row['name'];
	$airport['city'] = $row['city'];
	$airport['latitude'] = $row['latitude'];
	$airport['longitude'] = $row['longitude'];
	$AIRPORT_LIST[] = $airport;
}