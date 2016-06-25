<?php
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$website = htmlspecialchars(trim($_POST['website']));
$city = htmlspecialchars(trim($_POST['city']));
$lat = htmlspecialchars(trim($_POST['lat']));
$lng = htmlspecialchars(trim($_POST['lng']));


$db = new PDO('server=localhost;database=mapdata;uid=root;pwd=******');
$db->exec("INSERT INTO users (name, email, website, city, lat, lng, token) VALUES ('$name', '$email', '$website', '$city', '$lat', '$lng', '$token');");
$db = NULL; 

?>


