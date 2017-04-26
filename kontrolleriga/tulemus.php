<?php
require_once("head.html");
?>
<div id="wrap">
	<?php
	$files = scandir("pildid/");

if (empty($_SESSION["esimene"])){	
	if(!empty($_POST) && in_array($files[intval($_POST["pilt"])+1], $files)){
		echo "<h3>Valiku tulemus</h3>";
		echo '<img src="pildid/nameless'.$_POST["pilt"].'.jpg" alt="nimetu '.$_POST["pilt"].'" />';
		//echo "<br/>".$files[intval($_POST['pilt'])+1];
		$_SESSION["esimene"] = $_POST["pilt"];
	} else {
		echo "<p>Te ei valinud midagi, palun tehke oma valik!</p>";
	}
} else {
	echo "<h3>Valida saab ainult üks kord</h3>";
	echo "Te valisete järmise pildi:";
	//echo $_SESSION["esimene"];
	echo '<br/><img src="pildid/nameless'.$_SESSION["esimene"].'.jpg" alt="nimetu '.$_SESSION["esimene"].'" />';
}
	?>
	<form action="sesslopp.php">
		<input type="submit" value="Sessiooni lõpetamine!">
	</form>
</div>
<?php
require_once("foot.html");
?>