<?php

mysql_query("CREATE TABLE IF NOT EXISTS `_airplane` (
  `airplane_id` varchar(50) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `capacity` varchar(50) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  PRIMARY KEY (`airplane_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;")or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS `_airport` (
  `airport_id` varchar(3) DEFAULT NULL,
  `name` varchar(55) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;")or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS `_flight` (
  `flight_id` varchar(50) NOT NULL,
  `airplane_id` varchar(50) NOT NULL,
  `departure_date` varchar(50) NOT NULL,
  `arrival_date` varchar(50) NOT NULL,
  `seats_available` varchar(50) NOT NULL,
  `departure_airport` varchar(50) NOT NULL,
  `arrival_airport` varchar(50) NOT NULL,
  PRIMARY KEY (`flight_id`),
  KEY `departure_time` (`departure_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;")or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS `_flights` (
  `flight_id` varchar(50) NOT NULL,
  `trip_id` varchar(50) NOT NULL,
  PRIMARY KEY (`flight_id`,`trip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;")or die(mysql_error());

mysql_query("CREATE TABLE IF NOT EXISTS `_trip` (
  `trip_id` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;") 
or die(mysql_error());  

echo "Tables Created<br/>";
