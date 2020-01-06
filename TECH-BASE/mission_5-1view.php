<?php
		$dsn = 'mysql:dbname=tb210303db;host=localhost';
		$user = 'tb-210303';
		$password = 'XNcnWp2zZV';
		$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		
		$sql = 'SELECT * FROM mission5';
		$stmt = $pdo -> query($sql);
		$results = $stmt -> fetchAll();
		foreach($results as $row){
			echo $row['no'].'<>';
			echo $row['name'],'<>';
			echo $row['comment'].'<>';
			echo $row['date'].'<>';
			echo $row['pass'].'<br>';
			echo"<hr>";
		}
		
?>