<?php
require_once("func.php");
session_start();
baasi_uhendus();

require_once("views/head.html");

if( isset($_GET['page']) && !empty($_GET['page']) ){
    $leht = htmlspecialchars( $_GET['page'] );
} else {
    $leht = "pealeht";
}

switch($leht){
	
	case "analuusid":
		kuva_analuusid();
	break;
	
	case "vaakumkatsutid":
		kuva_vaakumkatsutid();
	break;
	
	case "sisestamine":
		sisesta();
	break;
		
	case "login":
		logi();
	break;
	
	case "logout":
		logout();
	break;
	
	default:
		include_once('views/pealeht.html');
	break;
}

require_once("views/foot.html");
?>