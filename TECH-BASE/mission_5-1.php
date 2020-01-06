	<?php
	//セッションスタート
	session_start();
		//データベースに接続
		$dsn = 'mysql:dbname=tb210303db;host=localhost';
		$user = 'tb-210303';
		$password = 'XNcnWp2zZV';
		$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		//pdoをグローバルにしないと関数で使えないっぽい？
		global $pdo;
		
		//フォームの初期値
		$comment = "";
		$name = "";
		//HTMLで使う分はグローバル化
		global $name;
		global $comment;
		global $flag;
		//編集フォームからの送信か確認
		if(empty($_POST["f5"])){
			//削除フォームからの送信か確認
			if(empty($_POST["gyou"])){
				//名前の追加フォームからの送信か確認
				if(empty($_POST["name"])){
					//全部空ならなにもしない
				}else{
					//追加、書き換え関数呼び出し
					Add();
					//編集、追加後フラグを元に戻す
					$_SESSION["flag"] = 0;
				}
			}else{
				//削除関数呼び出し
				Delete();	
			}
		}else{
			//編集関数呼び出し
			//編集フラグでセッションに１を代入
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
				//SQLを実行した結果を代入？
				$stmt = $pdo -> prepare($sql);
				//列に値を入れる
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
					//列に値を入れる
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
			//番号とパスワードが一致しているか比較
			$sql = 'delete from mission5 where no=:no and pass=:pass';
			$stmt = $pdo -> prepare($sql);
			//列に値を入れる
			$stmt -> bindParam(':no',$no,PDO::PARAM_INT);
			$stmt -> bindParam(':pass',$pass,PDO::PARAM_STR);
			$stmt->execute();//パスワードが一致していたら実行
		}
		//更新関数
		function updata(){
			//フォームに名前を表示するためグローバル変数にしている
			global $name;
			global $comment;
			global $pdo;
			//フォームから送られてきた値を判定
			if(empty($_POST["f5"]))	{
				//送られてきた値が空ならなにもしない
			}else{
				echo "編集表示もーど<br>";
				//フォームに自動出力			
				$no = $_POST["f5"];
				//フォームから送られてきた番号の列をとってくるためのSQL（ここでWHERE文比較を行うとエラー）121行目prepareを使っても同様
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
