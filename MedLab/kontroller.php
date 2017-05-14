<?php
require_once("func.php");
session_start();
baasi_uhendus();

require_once("views/head.html");

if(!empty($_GET)){
    $leht = $_GET['page'];
} else {
    $leht = "pealeht";
}

switch($leht){
	case "pealeht":
	require_once("views/pealeht.html");
	break;
	
	case "analuusid":
		kuva_analuusid();
	break;
	
	case "vaakumkatsutid":
		kuva_vaakumkatsutid();
	break;
	
	case "sisestamine":
	require_once("views/sisestamine.html");
	break;
		
	case "login":
	require_once("views/login.html");
	break;
}

require_once("views/foot.html");
?>