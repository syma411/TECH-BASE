<?php
	//3-2-1
	$filename = "mission_3-1.txt";
	$array = file( $filename );
	//3-2-2
	$count = count(file( $filename ));
	for($I = 0; $count > $I; $I++){
		//3-2-3
		$a = explode("<>", $array[$I]);
		
		//3-2-4
		echo $a[0]."<br>";
		echo $a[1]."<br>";
		echo $a[2]."<br>";
		echo $a[3]."<br>";		
		echo "<br>";
	}
	

	
	?>