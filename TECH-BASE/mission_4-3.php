<?php
//mission_4-1
	$dsn = 'mysql:dbname=tb210303db;host=localhost';
	$user = 'tb-210303';
	$password = 'XNcnWp2zZV';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	//mission_4-3
	$sql ='SHOW TABLES';
	$result = $pdo -> query($sql);
		foreach ($result as $row){
			echo $row[0];
			echo '<br>';
		}
	echo "<hr>";
	?>