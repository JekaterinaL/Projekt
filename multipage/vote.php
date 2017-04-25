<?php
require_once("head.html");
?>
<div id="wrap">
	<h3>Vali oma lemmik :)</h3>
	<form action="tulemus.php" method="GET">
		<?php
		$files = scandir('pildid/');
		$gallery = 'pildid/';
		$p = 1;
		if ($files !== false) {
        foreach($files as $file) {
            if ($file == '..' || $file == '.') continue;
			echo ("<p>\n<label for='p".$p."'><img src='".$gallery.$file."' alt='nimetu ".$p."' height='100' /></label>\n<input type='radio' value='".$p."' id='p".$p."' name='pilt'/>\n</p>\n");
			$p++;
			}
		}
		?>
		<br/>
		<input type="submit" value="Valin!"/>
	</form>
</div>
<?php
require_once("foot.html");
?>