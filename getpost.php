<?php 
	$bg_col="navy"; // vaikimisi sinine
	if (isset($_POST['bg_color']) && $_POST['bg_color']!="") {
		$bg_col=htmlspecialchars($_POST['bg_color']);
	}
	$tx_col="royalblue"; // vaikimisi helesinine
	if (isset($_POST['tx_color']) && $_POST['tx_color']!="") {
		$tx_col=htmlspecialchars($_POST['tx_color']);
	}
	$brd_w="10"; // vaikimisi 10px
	if (isset($_POST['brd_width']) && $_POST['brd_width']!="") {
		$brd_w=htmlspecialchars($_POST['brd_width']);
	}
	$brd_s="double"; // vaikimisi double
	if (isset($_POST['brd_style']) && $_POST['brd_style']!="") {
		$brd_s=htmlspecialchars($_POST['brd_style']);
	}
	$brd_col="green"; // vaikimisi roheline
	if (isset($_POST['brd_color']) && $_POST['brd_color']!="") {
		$brd_col=htmlspecialchars($_POST['brd_color']);
	}
	$brd_r="24"; // vaikimisi 24px
	if (isset($_POST['brd_radius']) && $_POST['brd_radius']!="") {
		$brd_r=htmlspecialchars($_POST['brd_radius']);
	}
	$n_text="see siin on näite text"; // vaikimisi "see siin on naite text"
	if (isset($_POST['naite_text']) && $_POST['naite_text']!="") {
		$n_text=htmlspecialchars($_POST['naite_text']);
	}
?>

<!DOCTYPE html>
<html>

<head>
  <title>8. kodune töö</title>
  <meta charset="utf-8">
  	<style type="text/css">
		.body {
			padding: 5px;
			padding-bottom: 100px;
			width: 350px;
			background-color: <?php echo $bg_col; ?>;
			color: <?php echo $tx_col; ?>;
			border-width: <?php echo $brd_w; ?>px;
			border-style: <?php echo $brd_s; ?>;
			border-color: <?php echo $brd_col; ?>;
			border-radius: <?php echo $brd_r; ?>px;
		}
		.commands {
			padding: 5px;
			border-style: solid black;
		}
		hr {
			display: block;
			height: 1px;
			border: 0;
			border-top: 1px solid dimgray;
			margin: 1em 0;
			padding: 0;
		}
		p {
			width: 100%; 
			text-indent: 25px; 
			border-bottom: 1px solid dimgray; 
			line-height: 0.1em;
			margin: 10px 0 20px; 
		} 
		p span { 
			background: white; 
			padding: 0 10px; 
		}
	</style>
</head>
<body>
  <div class="body">
		<?php echo $n_text; ?>
  </div>
  <hr/>
  <div class="commands">
	<form action="getpost.php" method="post">
	<textarea name="naite_text">see siin on näite tekst</textarea><br>
	<input type="color" name="bg_color"> Taustavärvus<br>
	<input type="color" name="tx_color"> Tekstivärvus<br>
	<br>
	<p><span>Piirjoon</span></p>
	<input type="number" name="brd_width" min="0" max="20"> Piirjoone laius (0-20px)<br>
		<select name="borderstyle">
			<option>dotted</option>
  			<option>dashed</option>
			<option>solid</option>
  			<option>double</option>
  			<option>groove</option>
  			<option>ridge</option>
		</select><br>
	<input type="color" name="brd_color"> Piirjoone värvus<br>
	<input type="number" name="brd_radius" min="0" max="100"> Piirjoone nurga raadius (0-100px)<br>
	<input type="submit" value="esita">
  </div>
</body>
</html>