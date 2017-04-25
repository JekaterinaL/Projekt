<?php
require_once("head.html");
?>
<div id="wrap">
	<?php
	$files = scandir('pildid/');

	if(!empty($_POST) && in_array($files[intval($_POST['pilt'])+1], $files)){
		echo "<h3>Valiku tulemus</h3>";
		echo '<img src="pildid/nameless'.$_POST['pilt'].'.jpg" alt="nimetu '.$_POST['pilt'].'" />';
		//echo $files[intval($_GET['pilt'])+1];
	} else {
		echo "<p>Te ei valinud midagi, palun tehke oma valik!</p>";
	}
	?>
</div>
<?php
require_once("foot.html");
?>