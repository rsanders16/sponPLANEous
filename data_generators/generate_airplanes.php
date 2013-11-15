<?php

require('../mysql_connect.php');

	$i = 0;
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Boeing', '".(737)."', '215', 'http://en.wikipedia.org/wiki/File:Lufthansa-1.jpg');") 
	or die(mysql_error());	$i++;
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Boeing', '".(747)."', '1000', 'http://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Ba_b747-400_g-bnle_arp.jpg/300px-Ba_b747-400_g-bnle_arp.jpg');") 
	or die(mysql_error());	$i++; 

	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Boeing', '".(767)."', '290', 'http://en.wikipedia.org/wiki/File:Delta_Air_Lines_B767-332_N130DL.jpg');") 
	or die(mysql_error());	$i++;

	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Boeing', '".(777)."', '314', 'http://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Malaysia_Airlines_Boeing_777-200ER_Bidini.jpg/220px-Malaysia_Airlines_Boeing_777-200ER_Bidini.jpg');") 
	or die(mysql_error());	$i++;

	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Boeing', '".(787)." Dreamliner', '381', 'http://en.wikipedia.org/wiki/File:All_Nippon_Airways_Boeing_787-8_Dreamliner_JA801A_OKJ_in_flight.jpg');") 
	or die(mysql_error());	$i++;

	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A318', '200', 'http://www.airbus.com/typo3temp/pics/a833088729.jpg');") 
	or die(mysql_error());	$i++; 

	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A319', '124', 'http://www.airbus.com/typo3temp/pics/e27112f49e.jpg');") 
	or die(mysql_error());	$i++;
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A320', '150', 'http://www.airbus.com/typo3temp/pics/0fbfee85ae.jpg ');") 
	or die(mysql_error());	$i++; 
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A321', '185', 'http://www.airbus.com/typo3temp/pics/4a1b648722.jpg');") 
	or die(mysql_error());	$i++;
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A330-200', '253', 'http://www.airbus.com/typo3temp/pics/c7a4934e31.jpg');") 
	or die(mysql_error());	$i++; 
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A330-300', '300', 'http://www.airbus.com/typo3temp/pics/908d09f9f0.jpg ');") 
	or die(mysql_error());	$i++;
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A340-300', '300', 'http://www.airbus.com/typo3temp/pics/f2d15bab2a.jpg');") 
	or die(mysql_error());	$i++;
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A340-500', '282', 'http://www.airbus.com/typo3temp/pics/39ab97580a.jpg');") 
	or die(mysql_error());	$i++;
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A340-600', '359', 'http://www.airbus.com/typo3temp/pics/9b92b2a36c.jpg');") 
	or die(mysql_error()); 	$i++; 
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A350-800', '276', 'http://www.airbus.com/typo3temp/pics/0d6b6f38c2.jpg');") 
	or die(mysql_error()); 	$i++; 
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A350-900', '315', 'http://www.airbus.com/typo3temp/pics/c53324dcef.jpg');") 
	or die(mysql_error());	$i++; 
	
	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A350-1000', '369', 'http://www.airbus.com/typo3temp/pics/1c7ee93647.jpg');") 
	or die(mysql_error()); 	$i++; 

	
	mysql_query("INSERT INTO `coms461`.`_airplane` 
	(`airplane_id`, `make`, `model`, `capacity`, `image_url`) 
	VALUES ('".$i."', 'Airbus', 'A380', '853', 'http://upload.wikimedia.org/wikipedia/commons/8/82/Airbus_A380_blue_sky.jpg');") 
	or die(mysql_error());	$i++;

echo "Airplane Data Inserted<br/>";