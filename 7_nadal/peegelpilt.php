<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Peegelpilt</title>
</head>
<body>
<?php
	$a = "Peegelpilt";
	echo "$a ";
	$aArray = str_split($a);
	for ($i = count($aArray); $i > 0; $i = $i - 1) {
		echo $aArray[$i-1];
	}
?>
</body>
</html>