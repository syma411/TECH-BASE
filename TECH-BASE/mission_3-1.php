	<html lang = "ja">
	<head>
	<meta charset = "utf-8">
	</head>
	
	<body>
		<form action = "mission_3-1.php" method = "post">
		名前：<input type  = "text" name = "name">
		<br>
		<p>コメント</p>
		<textarea name = "comment" rows = "4" cols = "40" placeholder = コメントを記入してください。></textarea>
		<br>
		<input type = "submit" value = "送信">
		</form>
	</body>
	</html>

	
	<?php
			if(empty($_POST["name"])){
			}else{
				$name = $_POST["name"];
				$comment = $_POST["comment"];
				$date = date( "Y/m/d H:i:s" );
				
				$filename = "mission_3-1.txt";
				$fp = fopen($filename,"a");
				$No = count( file( $filename)) + 1;
				fwrite($fp,$No."<>".$name."<>".$comment."<>".$date."\n");	
				fclose($fp);
				
			}
	?>