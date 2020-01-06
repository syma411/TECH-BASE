<?php
	$hensu = $_POST["text"];
	if( empty($hensu) ){
		echo "値を入力してください";
	}else{
		echo $_POST["text"]."を受け付けました<br>";
		$filename = "mission_2-2.txt";
		$fp = fopen($filename,"w");
		fwrite($fp,$_POST["text"]);
		fclose($fp);
	}
?>