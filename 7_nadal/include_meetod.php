<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>include_meetod</title>
<style>
		p {
			display: inline-block; width:29%;
			border: solid #c0c0c0 2px;
			border-radius: 5px;
			padding: 10px;
			margin: 1%;			
		}
	</style>
</head>
<body>
	<?php
	$analyses = array (
					array('analysis' => 'Glükoos', 'method' => 'fotomeetria', 'material' => 'paastuplasma', 'volume' => '1', 'TAT' => '1'),
					array('analysis' => 'LDL-kolesterool', 'method' => 'fotomeetria', 'material' => 'paastuseerum', 'volume' => '1', 'TAT' => '2'),
					array('analysis' => 'Reniin', 'method' => 'kemoluminestsents', 'material' => 'EDTA plasma', 'volume' => '2', 'TAT' => '3'),
					array('analysis' => 'Mycoplasma  hominis DNA', 'method' => 'PCR', 'material' => 'esmasjoauriin', 'volume' => '5', 'TAT' => '7')
	);
?>

<?php
	foreach ($analyses as $voti => $vaartus) include("lause.html");
?>
</body>
</html>