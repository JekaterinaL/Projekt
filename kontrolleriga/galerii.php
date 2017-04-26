<?php
require_once("head.html");
?>
<div id="wrap">
	<h3>Fotod</h3>
	<div id="gallery">
		<?php
		$files = scandir('pildid/');
		$gallery = 'pildid/';
		$p = 1;
		if ($files !== false) {
        foreach($files as $file) {
            if ($file == '..' || $file == '.') continue;
			echo ("<img src='".$gallery.$file."' alt='nimetu ".$p."' />\n");
			$p++;
			}
		}
		?>
	</div>
</div>
<?php
require_once("foot.html");
?>