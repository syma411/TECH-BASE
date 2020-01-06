<?php
	$dsn = 'mysql:dbname=tb210303db;host=localhost';
	$user = 'tb-210303';
	$password = 'XNcnWp2zZV';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		
		$sql = "CREATE TABLE IF NOT EXISTS mission5"
		." ("
		."no INT AUTO_INCREMENT PRIMARY KEY,"
		."name char(32),"
		."comment TEXT,"
		."date char(32),"
		."pass char(32)"
		.");";
		$stmt = $pdo->query($sql);
?>