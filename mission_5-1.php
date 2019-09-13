	<?php
	session_start();
		//データベースに接続
		$dsn = 'mysql:dbname=*****;host=localhost';
		$user = '*****';
		$password = '*****';
		$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		//pdoをグローバルにしないと関数で使えないっぽい？
		global $pdo;
		
		//フォームの初期値
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
					//送信ボタンを押されたときの処理
					Add();	
					$_SESSION["flag"] = 0;
				}
			}else{
				//削除フォームから値が送信されたときの処理
				Delete();	
			}
		}else{
			//編集フォームから値が送信されたときの処理
			$_SESSION["flag"] = 1;
			updata();
		}
	
	
		//追加、書き換え関数
		function Add(){
			//フラグ判定
			if($_SESSION["flag"] == 1){
				//フラグが１なら書き換え
				echo "書き換えもーど";
				//フォームから送られてきた値を変数に代入
				$name = $_POST["name"];
				$comment = $_POST["comment"];
				$no = $_SESSION["No"];
				global $pdo;
				//更新するためのSQL文
				$sql = 'UPDATE mission5 set name=:name,comment=:comment where no=:no';
				$stmt = $pdo -> prepare($sql);
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
				$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
				$stmt->bindParam(':no', $no, PDO::PARAM_INT);
				$stmt->execute();	//実行
			}else{
				//フラグが０なら追加
				echo "追加モード";
			if(empty($_POST["name"])){
				//名前が空ならなにもしない
				}else{
					//フォームから送られてきた値を変数に代入
					global $pdo;
					$name = $_POST["name"];
					$comment = $_POST["comment"];
					$date = date( "Y/m/d H:i:s" );
					$pass = $_POST["pass"];
					
					//行を挿入するためのSQL
					$sql = $pdo -> prepare("INSERT INTO mission5(name,comment,date,pass)VALUES(:name,:comment,:date,:pass)");
					$sql -> bindParam(':name', $name, PDO::PARAM_STR);
					$sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
					$sql -> bindParam(':date',$date,PDO::PARAM_STR);
					$sql -> bindParam(':pass',$pass,PDO::PARAM_STR);		
					$sql -> execute();//実行
				}
			}
		}		
		//削除関数
		function Delete(){
			echo "削除もーど";
			global $pdo;
			//削除番号を取得
			$no = $_POST["gyou"];
			//対象番号のパスワードと一致するか確認するための変数
			$pass = $_POST["pass"];
			
			//行を削除するSQL
			$sql = 'delete from mission5 where no=:no and pass=:pass';
			$stmt = $pdo -> prepare($sql);
			$stmt -> bindParam(':no',$no,PDO::PARAM_INT);
			$stmt -> bindParam(':pass',$pass,PDO::PARAM_STR);
			$stmt->execute();//パスワードが一致していたら実行
		}
		//更新関数
		function updata(){
			global $name;
			global $comment;
			global $pdo;
			if(empty($_POST["f5"]))	{
				//送られてきた値が空ならなにもしない
			}else{
				echo "編集表示もーど<br>";
				//フォームに自動入力させる			
				$no = $_POST["f5"];
				$sql='SELECT * FROM mission5';
				$no = $_POST["f5"];
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				foreach($results as $row){
					//where句でエラー吐いてしまうのでif文で代用。WHERE no=:no
					if($no == $row[0]){
					//ここで変数に代入することでHTMLに反映される
					$comment = $row['comment'];
					$name = $row['name'];
					//更新する番号の保持
					$_SESSION["No"] = $no;
					}
					
				}
				//なんのために作ったか忘れた
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
