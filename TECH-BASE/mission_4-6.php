<?php
//mission_4-1
	$dsn = 'mysql:dbname=tb210303db;host=localhost';
	$user = 'tb-210303';
	$password = 'XNcnWp2zZV';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	//mission_4-6
	
	$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo -> query($sql);
	$results = $stmt -> fetchAll();
	foreach($results as $row){
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
		echo "<hr>";
	}
?>