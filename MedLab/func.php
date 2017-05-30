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
		$vk = mysqli_real_escape_string($link, $rida_vk['vk']);
		$sql = "SELECT * FROM 10163487_analuusid WHERE vk = '$vk' ORDER BY an";
		$result = mysqli_query($link, $sql) or die ( $sql. " - ". mysqli_error($link) );
		while($analuusid = mysqli_fetch_assoc($result)){
			$valdkonnad[$rida_vk['vk']][] = $analuusid;
		}
	}
	include_once("views/nimekiri.html");
}

function kuva_vaakumkatsutid(){
	global $link;
	$vaakumkatsutid = array();
	$sql = "SELECT * FROM 10163487_proovinou";
	$result = mysqli_query($link, $sql);
	while($rida = mysqli_fetch_assoc($result)){
		$vaakumkatsutid[] = $rida;
	}
	include_once("views/proovinoud.html");
}

function logi(){
	// INSERT INTO 10163487_kylastajad (username, passw) VALUES('Jekaterina', SHA1('katja'))

	global $link;
	if ( !empty($_SESSION['username']) ) {
		header("Location: ?page=pealeht");
	} else {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if( !empty($_POST) ){
				if ($_POST['username'] != "" && $_POST['passwd'] != "") {
					$user = mysqli_real_escape_string($link, $_POST['username']);
					$pass = mysqli_real_escape_string($link, $_POST['passwd']);
					
					$sql = "SELECT id, username FROM 10163487_kylastajad WHERE username = '$user' AND passw = SHA1('$pass')";
					$result = mysqli_query($link, $sql);
					
					if ($result && $user = mysqli_fetch_assoc($result)){
						$_SESSION['username'] = $_POST['username'];
						header("Location: ?page=pealeht");
						
					} else {
						$errors = array();
						$errors[] = "Login luhtus, kas oli õige info?";
					} 
				} else {
					if (empty($_POST['username'])){
						$errors[] = "Kasutajanimi vajalik!";
					}
					if (empty($_POST['passwd'])){
						$errors[] = "Parool vajalik!";
					}
				}
			}
		}
	}
	include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function sisesta(){
	global $link;
	
	if (empty($_SESSION['username'])) {
		header("Location: ?page=login");
	} else {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			$errors = array();
			if ($_POST['vk'] == "") {
				$errors[] = "Valdkond on valimata!";
			} elseif ($_POST['an'] == ""){
				$errors[] = "Analüüsi nimetus on sisestamata!";
			} elseif ($_POST['luhend'] == ""){
				$errors[] = "Analüüsi lühend on sisestamata!";
			} elseif ($_POST['pn'] == ""){
				$errors[] = "Proovinõu korgivärv on valimata!";
			} elseif ($_POST['pm'] == ""){
				$errors[] = "Proovimaterjal on valimata!";
			} elseif ($_POST['sailivus'] == ""){
				$errors[] = "Uuritava materjali säilitamise tingimused on sisestamata!";
			} elseif ($_POST['hk'] == ""){
				$errors[] = "Haigekassa kood on sisestamata!";
			} elseif ($_POST['aadress'] == ""){
				$errors[] = "Viide analüüsi kodulehele on sisestamata!";
			} elseif (strpos ($_POST['aadress'], "synlab") === false){
				$errors[] = "Koduleht peab olema rangelt Synlabi oma!";
			
			} else {
				$vk = mysqli_real_escape_string($link, $_POST['vk']);
				$an = mysqli_real_escape_string($link, $_POST['an']);
				$luhend = mysqli_real_escape_string($link, $_POST['luhend']);
				$pn = mysqli_real_escape_string($link, $_POST['pn']);
				$pm = mysqli_real_escape_string($link, $_POST['pm']);
				$sailivus = mysqli_real_escape_string($link, $_POST['sailivus']);
				$hk = mysqli_real_escape_string($link, $_POST['hk']);
				$aadress = mysqli_real_escape_string($link, $_POST['aadress']);
				
				$sql = "INSERT INTO 10163487_analuusid (id, vk, an, luhend, pn_i, pn_t, pm, sailivus, hk, aadress) VALUES (NULL, '$vk', '$an', '$luhend', 'img/$pn.jpg', 'thumb/$pn.jpg', '$pm', '$sailivus', '$hk', '$aadress')";
				
				if (mysqli_query($link, $sql)) {
					header("Location: ?page=analuusid");
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($link);
				}
			}
		}
	}

	include_once('views/vorm.html');
}

?>