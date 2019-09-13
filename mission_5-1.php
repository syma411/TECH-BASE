	<?php
	session_start();

		$dsn = 'mysql:dbname=*********;host=localhost';
		$user = '*******';
		$password = '*******';
		$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		global $pdo;
		
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
				$name = $_POST["name"];
				$comment = $_POST["comment"];
				$no = $_SESSION["No"];
				global $pdo;
				$sql = 'UPDATE mission5 set name=:name,comment=:comment where no=:no';
				$stmt = $pdo -> prepare($sql);
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
				$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
				$stmt->bindParam(':no', $no, PDO::PARAM_INT);
				$stmt->execute();	
			}else{
				echo "追加モード";
			if(empty($_POST["name"])){
				}else{
					global $pdo;
					$name = $_POST["name"];
					$comment = $_POST["comment"];
					$date = date( "Y/m/d H:i:s" );
					$pass = $_POST["pass"];
					
					
					$sql = $pdo -> prepare("INSERT INTO mission5(name,comment,date,pass)VALUES(:name,:comment,:date,:pass)");
					$sql -> bindParam(':name', $name, PDO::PARAM_STR);
					$sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
					$sql -> bindParam(':date',$date,PDO::PARAM_STR);
					$sql -> bindParam(':pass',$pass,PDO::PARAM_STR);		
					$sql -> execute();
				}
			}
		}		
		
		function Delete(){
			echo "削除もーど";
			global $pdo;
			//削除番号を取得
			$no = $_POST["gyou"];
			//対象番号のパスワードと一致するか確認するための変数
			$pass = $_POST["pass"];
			
			$sql = 'delete from mission5 where no=:no and pass=:pass';
			$stmt = $pdo -> prepare($sql);
			$stmt -> bindParam(':no',$no,PDO::PARAM_INT);
			$stmt -> bindParam(':pass',$pass,PDO::PARAM_STR);
			$stmt->execute();
		}

		function updata(){
			global $name;
			global $comment;
			global $pdo;
			if(empty($_POST["f5"]))	{
			}else{
				echo "編集表示もーど<br>";
				//フォームに自動入力させる			
				$no = $_POST["f5"];
				$sql='SELECT * FROM mission5';
				$no = $_POST["f5"];
				$stmt = $pdo->query($sql);
				//$stmt->bindParam(':no',$no);
				$results = $stmt->fetchAll();
				foreach($results as $row){
					if($no == $row[0]){
					$comment = $row['comment'];
					$name = $row['name'];
					$_SESSION["No"] = $no;
					}
				}
				$_SESSION["hantei"] = 1;
				}
				if($_SESSION["hantei"] == 1){
				}else{
					$_SESSION["flag"] = 0;
				}
		}
	?>
	
	
	<html lang = "ja">
	<head>
	<meta equiv = "Content-Type" content = "text/html; charset = utf-8">
	</head>
	
	<body>
		<form action = "mission_5-1.php" method = "post">
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
