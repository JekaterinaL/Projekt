<?php
require_once("head.html");

$files = scandir('pildid/');

if(!empty($_GET)){
    $leht=$_GET['page'];
} else {
    $leht="pealeht";
}

switch($leht){
	case "pealeht":
	require_once("pealeht.php");
	break;
	
	case "galerii":
	require_once("galerii.php");
	break;
	
	case "vote":
	require_once("vote.php");
	break;
	
	case "tulemus":
	require_once("tulemus.php");
	break;
}

require_once("foot.html");
?>