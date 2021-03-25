<?php
//Start session
session_start();

//Create constant to store non repeating Values

define('SITEURL','http://localhost/lequilibrerestauration/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'cruder');
define('DB_PASSWORD', 'jecrud');
define('DB_NAME', 'food_order');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die (mysqli_error());//database connexion
$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//selecting database

?>