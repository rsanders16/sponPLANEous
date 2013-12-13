<?php

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
set_time_limit(0);
for($i = 0 ; $i <= count($AIRPORT_LIST) - 1 ; $i++) 
{
		$max = rand(15, 20);
		for($j = 0; $j < $max ; $j++)
		{
			$random_index = rand(0, count($AIRPLANE_LIST) - 1);
			$random_index_to = rand(0, count($AIRPORT_LIST) - 1);
			
			if ($i == $random_index_to)
				continue;
			
			mysql_query("INSERT INTO `coms461`.`_flight` 
			(`flight_id`, `airplane_id`, `departure_date`, `arrival_date`, `seats_available`, `departure_airport`, `arrival_airport`) 
			VALUES ('".($count)."', '".$AIRPLANE_LIST[$random_index]['airplane_id']."', '11/11/2013', '11/11/2013', '".rand(1, $AIRPLANE_LIST[$random_index]['capacity'])."', '".$AIRPORT_LIST[$i]['airport_id']."', '".$AIRPORT_LIST[$random_index_to]['airport_id']."');") 
			or die(mysql_error());
			
			mysql_query("INSERT INTO `coms461`.`_flights` 
			(`flight_id`, `trip_id`) 
			VALUES ('".$count."', '".$count."');") 
			or die(mysql_error());

			mysql_query("INSERT INTO `coms461`.`_trip` 
			(`trip_id`, `price`) 
			VALUES ('".$count++."', '".rand(200, 1000)."');") 
			or die(mysql_error());  			
			
		}
}
set_time_limit(30);

echo "Flight Data Inserted<br/>";