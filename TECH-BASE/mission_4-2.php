<?php
//mission_4-1
	$dsn = 'mysql:dbname=tb210303db;host=localhost';
	$user = 'tb-210303';
	$password = 'XNcnWp2zZV';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	//mission_4-2
 	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
 	." ("
 	. "id INT AUTO_INCREMENT PRIMARY KEY,"
 	. "name char(32),"
 	. "comment TEXT"
 	.");";
 	$stmt = $pdo->query($sql);
 	
 	?>