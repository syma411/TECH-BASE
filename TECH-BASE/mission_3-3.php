	<html lang = "ja">
	<head>
	<meta charset = "utf-8">
	</head>
	
	<body>
		<form action = "mission_3-3.php" method = "post">
		名前：<input type  = "text" name = "name">
		<br>
		<p>コメント</p>
		<textarea name = "comment" rows = "4" cols = "40" placeholder = コメントを記入してください。></textarea>
		<br>
		<input type = "submit" value = "送信">
		<br>
						<!-- 3-3-1 -->
			削除対象番号：<input type = "text" name = "gyou" size = "3">
			<input type = "submit" value = "削除">
		</form>
	</body>
	</html>
	
		
	
	
	<?php
	function Add(){
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
	}
	
	function Delete(){
		$filename = "mission_3-1.txt";
		$count = count( file( $filename ));
		$array = file($filename);
		$fp = fopen($filename,"w");
		for($I = 0; $count > $I; $I++){
			//3-3-4
			$a = explode("<>",$array[$I]);
			//3-3-5
			if($a[0] == $_POST["gyou"]){
			}else if($count < $_POST["gyou"]){
				echo "<br>";
				fwrite($fp,$a[0]."<>".$a[1]."<>".$a[2]."<>".$a[3]);
			}else if($a[0] != $_POST["gyou"]){	
				echo "<br>";
				fwrite($fp,$a[0]."<>".$a[1]."<>".$a[2]."<>".$a[3]);
			}
		}
		if($count < $_POST["gyou"]){
			$b = $a[0] + 1;
			$date = date( "Y/m/d H:i:s" );
			fwrite($fp,$b."<>"."名前"."<>"."コメント"."<>".$date."\n");
		}
		fclose($fp);
	}
	
	
	
		//3-3-2
		if(empty($_POST["name"])){
			if(empty($_POST["gyou"])){
			}else{
				//削除フォーム処理
				//3-3-3
				Delete();
			}
		}else{
			//送信フォーム処理
				Add();
		}
	?>
	