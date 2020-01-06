
<!DOCTYPE html>
<html lang = "ja">
	<head>
	<meta charset = "utf-8">
	</head>
	
	<body>
		<form action = "mission_2-1.php" method = "post" target = "_blank">
		<input type = "text" name = "text" value = "コメント">
		<input type = "submit" value = "送信">
		</form>
	</body>
	</html>
	
	<?php
	$filename = "mission_2-2.txt";
	$content = file_get_contents($filename);
	echo $content;
?>