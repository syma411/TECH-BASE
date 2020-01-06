<!DOCTYPE html>
<html lang = "ja">
	<head>
	<meta charset = "utf-8">
	</head>
	<body>
		<form action = "mission_2-3.php" method = "post">
		<input type = "text" name = "text" value = "コメント">
		<input type = "submit" value = "送信">
		</form>
	</body>
</html>

	<?php
	if(empty($_POST["text"])){		
	}else{
		$hensu = $_POST["text"]."\n";
	$filename = "mission_2-3.txt";
	$fp = fopen($filename,"a");
	fwrite($fp,$hensu);
	fgets($fp);
	fclose($fp);	
	}
?>