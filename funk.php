<?php


function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}


function kuva_puurid(){
	// siia on vaja funktsionaalsust
	global $connection;
	if (!empty($_SESSION['user'])) {
		$p = mysqli_query($connection, "select distinct(puur) as puur from 10163487_loomaaed order by puur asc");
		$puurid = array();
		while ($r = mysqli_fetch_assoc($p)){
			$l = mysqli_query($connection, "SELECT * FROM 10163487_loomaaed WHERE  puur=".mysqli_real_escape_string($connection, $r['puur']));
			while ($row = mysqli_fetch_assoc($l)) {
				$puurid[$r['puur']][] = $row;
			}
		}
		include_once('views/puurid.html');
	} else {
		include_once('views/login.html');
	}
}

function logi(){
	// INSERT INTO 10163487_kylastajad (username, passw) VALUES('Jekaterina', SHA1('katja'))
	// siia on vaja funktsionaalsust (13. nädalal)
	
	//if ($_SERVER['REQUEST_METHOD'] == 'POST'){}
	global $connection;
	if (!empty($_SESSION['user'])) {
		header("Location: ?page=loomad");
	} else {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(!empty($_POST)){
				if ($_POST['user'] != "" && $_POST['pass'] != "") {
					$user = mysqli_real_escape_string($connection, $_POST['user']);
					$pass = mysqli_real_escape_string($connection, $_POST['pass']);
					
					$sql = "SELECT id, username FROM 10163487_kylastajad WHERE username = '$user' AND passw = SHA1('$pass')";
					$result = mysqli_query($connection, $sql);
					if ($result && $user = mysqli_fetch_assoc($result)){
					// if (mysqli_num_rows($result)) { - eelmise rea asemele
						$_SESSION['user'] = $_POST['user'];
						header("Location: ?page=loomad");
						// exit(0);
					} else {
						$errors = array();
						$errors[] = "Login luhtus, kas oli õige info?";
					} 
				} else {
					if (empty($_POST['user'])){
						$errors[] = "Kasutajanimi vajalik!";
					}
					if (empty($_POST['pass'])){
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

function lisa(){
	// siia on vaja funktsionaalsust (13. nädalal)
	
	global $connection;
	
	if (empty($_SESSION['user'])) {
		header("Location: ?page=login");
	} else {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if ($_POST['nimi'] == "") {
				$errors = array();
				$errors[] = "Nimi vajalik!";
			} elseif ($_POST['puur'] == ""){
				$errors[] = "Puur vajalik!";
			} elseif (upload("liik") == ""){
				$errors[] = "Liik vajalik!";
			} else {
				upload('liik');
				$nimi = mysqli_real_escape_string($connection, $_POST['nimi']);
				$puur = mysqli_real_escape_string($connection, $_POST['puur']);
				$liik = mysqli_real_escape_string($connection, substr($_FILES['liik']['name'], 0, -4));
				$sql = "INSERT INTO 10163487_loomaaed(id, nimi, puur, liik) VALUES (NULL, '$nimi', '$puur', '$liik')";
				$result = mysqli_query($connection, $sql);
				
				if (mysqli_insert_id($connection)) {
					header("Location: ?page=loomad");
				}
			}
		}
	}

	include_once('views/loomavorm.html');
	
}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}

?>