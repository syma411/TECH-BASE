<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UTF-8">
</head>

<body>
<?php
//加算
	echo 2019 - 1996;
	echo '<br>';
	//減算
	echo 23 + 12;
	echo '<br>';
	//乗算
	echo 23 + 12 * 2;
	echo '<br>';
	//除算
	$year = 2019;
	$myYear = 1996;
	$amari = ($year - $myYear) % 4;
	 echo ($year - $myYear - $amari) / 4;
?>
</body>
</html>