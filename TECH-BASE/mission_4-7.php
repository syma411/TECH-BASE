<?php
//mission_4-1
	$dsn = 'mysql:dbname=tb210303db;host=localhost';
	$user = 'tb-210303';
	$password = 'XNcnWp2zZV';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	//mission_4-7
	
	$id = 1;
	$name = "おじいちゃんNEX";
	$comment = "会心の一撃！";
	$sql = 'update tbtest set name=:name,comment=:comment where id=:id';
	$stmt = $pdo -> prepare($sql);
	$stmt -> bindParam(':name',$name,PDO::PARAM_STR);
	$stmt -> bindParam(':comment',$comment,PDO::PARAM_STR);
	$stmt -> bindParam(':id',$id,PDO::PARAM_INT);
	$stmt -> execute();

?>