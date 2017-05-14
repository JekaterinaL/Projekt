<?php

function baasi_uhendus(){
	global $link;
	$user = "test";
	$pass = "t3st3r123";
	$db = "test";
	$host = "localhost";

	$link = mysqli_connect($host, $user, $pass, $db) or die("ei saanud ühendatud - ");
	mysqli_query($link, "SET CHARACTER SET UTF8") or die( $sql. " - ". mysqli_error($link) );
}

function kuva_analuusid(){
	global $link;
	//Valdkonna kuvamiseks
	$valdkonnad = array();
	$sql_vk = "SELECT DISTINCT vk FROM 10163487_analuusid";
	$result_vk = mysqli_query($link, $sql_vk) or die( $sql_vk. " - ". mysqli_error($link) );
	while($rida_vk = mysqli_fetch_assoc($result_vk)){
		//Analüüside kuvamiseks
		//http://stackoverflow.com/questions/23712858/how-to-insert-a-double-quotes-in-a-variable-in-php
		$sql = "SELECT * FROM 10163487_analuusid WHERE vk = '{$rida_vk['vk']}'";
		$result = mysqli_query($link, $sql) or die ( $sql. " - ". mysqli_error($link) );
		while($analuusid = mysqli_fetch_assoc($result)){
			$valdkonnad[$rida_vk['vk']][] = $analuusid;
		}
	}
	include_once("views/analuusid.html");
}

function kuva_vaakumkatsutid(){
	global $link;
	$vaakumkatsutid = array();
	$sql = "SELECT * FROM 10163487_proovinou";
	$result = mysqli_query($link, $sql);
	while($rida = mysqli_fetch_assoc($result)){
		$vaakumkatsutid[] = $rida;
	}
	include_once("views/vaakumkatsutid.html");
}
?>