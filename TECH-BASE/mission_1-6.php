<?php

	for($year = 2000; $year <= 2019; $year = $year +4){
		echo $year."<br><br>";
	}
	
	$shiritori = array("しりとり","りんご","ごりら","らっぱ","ぱんだ");
	var_dump($shiritori);
	echo "<br>";
	echo $shiritori[2]."<br><br>";
	
	$anki = "";
	foreach($shiritori as $word){
		$anki = $anki.$word;
		echo $anki."<br>";
	}
?>