<?php
require_once("../DATABASE_SETTINGS.php");
mysql_connect(SERVER, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE) or die(mysql_error());
require_once('generate_tables.php');
require_once('generate_truncation.php');
require_once('generate_airplanes.php');
require_once('generate_airports.php');
require_once('generate_flights.php');
require_once('generate_trip_flights.php');
require_once('generate_trips.php');

echo "All Data Inserted<br/>";