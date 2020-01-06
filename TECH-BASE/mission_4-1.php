<?php
//mission_4-1
	$dsn = 'mysql:dbname=tb210303db;host=localhost';
	$user = 'tb-210303';
	$password = 'XNcnWp2zZV';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
?>