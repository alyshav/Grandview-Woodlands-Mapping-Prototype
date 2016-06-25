<?php

$reportType = htmlspecialchars(trim($_POST['reportType']));
$incidentType = htmlspecialchars(trim($_POST['incidentType']));
$reportDate = htmlspecialchars(trim($_POST['reportDate']));
$incidentDescription = htmlspecialchars(trim($_POST['incidentDescription']));
$latitude = htmlspecialchars(trim($_POST['latitude']));
$longitude = htmlspecialchars(trim($_POST['longitude']));

$dsn = 'mysql:host=localhost;dbname=mapdata';
$username = 'root';
$password = 'hazel123';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

$db = new PDO($dsn, $username, $password, $options);

$db->exec("INSERT INTO observations (latitude, longitude, reportType, reportDate, incidentType, incidentDescription) VALUES ('$latitude', '$longitude', '$reportType', '$reportDate', '$incidentType', '$incidentDescription');");
$db = NULL; 

?>


