<?php

	$dsn = 'mysql:dbname=tb210303db;host=localhost';
	$user = 'tb-210303';
	$password = 'XNcnWp2zZV';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	$id = 2;
	$sql = 'delete from tbtest where id = :id';
	$stmt = $pdo -> prepare($sql);
	$stmt -> bindParam(':id',$id,PDO::PARAM_INT);
	$stmt -> execute();
	
	
	?>