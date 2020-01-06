<?php
//mission_4-1
	$dsn = 'mysql:dbname=tb210303db;host=localhost';
	$user = 'tb-210303';
	$password = 'XNcnWp2zZV';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	//mission_4-5
	$sql = $pdo -> prepare("INSERT INTO tbtest(name,comment)VALUES(:name,:comment)");
	$sql -> bindParam(':name',$name, PDO::PARAM_STR);
	$sql -> bindParam(':comment',$comment, PDO::PARAM_STR);
	$name = 'おじいちゃん';
	$comment = 'こんにちは';
	$sql -> execute();
	
	
?>