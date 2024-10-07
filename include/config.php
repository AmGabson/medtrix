<?php

//error_reporting(0);
define('DB_SERVER', 'portal.blankipanel.com');
define('DB_USERNAME', 'medtrix');
define('DB_PASSWORD', 'Medtrix@2939');
define('DB_DATABASE', 'medtrix');


	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	
	try{
		
	$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$pdo->exec("set names utf8mb4");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		die("Error: Can Not Connect" . $e->getMessage());
	}


	//set default time zone
	//date_default_timezone_set("Africa/Lagos");
	