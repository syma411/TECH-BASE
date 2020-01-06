

	<?php

	$filename = "mission_2-4.txt";
	$array;
	for($count = count( file( $filename));  $count > 0; $count = $count - 1){
		$array = file( $filename );
	}
	foreach($array as $a){
		echo $a."<br>";	
	}
	
	

?>