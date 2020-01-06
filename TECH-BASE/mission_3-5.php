	
	<?php
	session_start();
		
		$comment = "";
		$name = "";
		global $name;
		global $comment;
		global $flag;
		if(empty($_POST["f5"])){
			if(empty($_POST["gyou"])){
				if(empty($_POST["name"])){
					//全部空ならなにもしない
				}else{
					Add();	
					$_SESSION["flag"] = 0;
				}
			}else{
				Delete();	
			}
		}else{
			$_SESSION["flag"] = 1;
			updata();
		}
	
	

		function Add(){
			if($_SESSION["flag"] == 1){
				echo "書き換えもーど";

				$filename = "mission_3-5.txt";
				$count = count( file( $filename ));
				$array = file($filename);
				$fp = fopen($filename, "w");
				for($I = 0; $count > $I; $I++){
						$a = explode("<>",$array[$I]);
						if($_SESSION["L"] == $a[0]){
							//コメントの書き換え
							fwrite($fp,$a[0]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$a[3]."<>".$a[4]);
						}else{
							fwrite($fp,$a[0]."<>".$a[1]."<>".$a[2]."<>".$a[3]."<>".$a[4]);	
						}
				}
					

			}else{
				echo "追加モード";
			if(empty($_POST["name"])){
				}else{
					echo "データベースに格納";
					$name = $_POST["name"];
					$comment = $_POST["comment"];
					$date = date( "Y/m/d H:i:s" );
					$filename = "mission_3-5.txt";
					$fp = fopen($filename,"a");
					$No = count( file( $filename)) + 1;
					fwrite($fp,$No."<>".$name."<>".$comment."<>".$date."<>".$_POST["pass"]."<>"."\n");	
					fclose($fp);	
				}
			}
		}		
		
		function Delete(){
			echo "削除もーど";
			$filename = "mission_3-5.txt";
			$count = count( file( $filename ));
			$array = file($filename);
			//ファイルを空にしてオープン
			$fp = fopen($filename,"w");
			for($I = 0; $count > $I; $I++){
				//区切り文字で配列に格納
				$a = explode("<>",$array[$I]);
				//入力された番号と一致した番号以外をファイルに書き込む
				$pass = $_POST["pass"];
				if($a[0] == $_POST["gyou"] && strcasecmp($a[4],$pass) != 0){
						fwrite($fp,$a[0]."<>".$a[1]."<>".$a[2]."<>".$a[3]."<>".$a[4]);
						echo "削除されない";
				}else if($count < $_POST["gyou"]){
					echo "<br>";
					fwrite($fp,$a[0]."<>".$a[1]."<>".$a[2]."<>".$a[3]."<>".$a[4]);
				}else if($a[0] != $_POST["gyou"]){	
					echo "<br>";
					fwrite($fp,$a[0]."<>".$a[1]."<>".$a[2]."<>".$a[3]."<>".$a[4]);
				}
			}
			if($count < $_POST["gyou"]){
				$b = $a[0] + 1;
				$date = date( "Y/m/d H:i:s" );
				fwrite($fp,$b."<>"."名前"."<>"."コメント"."<>".$date."\n");
			}
			fclose($fp);
		}

		function updata(){
			global $name;
			global $comment;
			global $hantei;
			echo "編集もーど<br>";
			if(empty($_POST["f5"]))	{
			}else{
				$filename = "mission_3-5.txt";
				$count = count( file( $filename ));
				$array = file($filename);
				for($I = 0; $count > $I; $I++){
					$a = explode("<>",$array[$I]);
					if($_POST["f5"] == $a[0] && $_POST["pass"] == $a[4]){
						//一致している場合
						$name = $a[1];
						$comment = $a[2];
						$_SESSION["L"] = $_POST["f5"];
						$_SESSION["hantei"] = 1;
					}else{
					}
				}
				if($_SESSION["hantei"] == 1){
				}else{
					$_SESSION["flag"] = 0;
				}
			}
		}
			?>
	
	<html lang = "ja">
	<head>
	<meta equiv = "Content-Type" content = "text/html; charset = utf-8">
	</head>
	
	<body>
		<form action = "mission_3-5.php" method = "post">
		<?php	
			echo "お名前<INPUT TYPE = 'text' NAME = 'name' SIZE = '30' value = '".$name."'><BR>";

		?>
		<p>コメント</p>
		<?php
			echo "<textarea name = 'comment' rows = '4' cols = '40' placeholder = コメントを記入してください。> ".$comment."</textarea>";	
		?>
		<br>
		<input type = "submit" value = "送信">
		<br>
		削除対象番号：<input type = "text" name = "gyou" size = "3">
		<input type = "submit" value = "削除">
		<br>	
		編集対象番号：<input type = "text" name = "f5" size = "3">
		<input type = "submit" value = "編集">
		<br>
		パスワード：<input type = "password" name = "pass">
		</form>
	</body>
	</html> 