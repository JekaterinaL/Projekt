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

	global $connection;
	if (!empty($_SESSION['user'])) {
		header("Location: ?page=loomad");
	} else {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(!empty($_POST)){
				if ($_POST['user'] != "" && $_POST['pass'] != "") {
					$user = mysqli_real_escape_string($connection, $_POST['user']);
					$pass = mysqli_real_escape_string($connection, $_POST['pass']);
					
					$sql = "SELECT id, username, role FROM 10163487_kylastajad WHERE username = '$user' AND passw = SHA1('$pass')";
					$result = mysqli_query($connection, $sql);
					
					if ($result && $user = mysqli_fetch_assoc($result)){
						$_SESSION['user'] = $_POST['user'];
						$_SESSION['id'] = $user['id'];
						// muuta funktsiooni login() nii, et sisselogimise õnnestumisel salvestuks sessiooni ka kasutaja roll
						$_SESSION['role'] = $user['role'];
						// echo $_SESSION['role'];
						header("Location: ?page=loomad");
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
	
	global $connection;
	
	if (empty($_SESSION['user'])) {
		header("Location: ?page=login");
	// Piirata linkide kuvamine lehe päises (head.html) nii, et ainult admin näeb loomade lisamise linki
	} elseif ($_SESSION['role'] != 'admin') {
		header("Location: ?page=loomad");
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

// lisada funkstioon hangi_loom($id), mis tagastab konkreetse looma info massiivi kujul (id väärtus sisendparameetris)
function hangi_loom($id) {
	global $connection;
	$id = mysqli_real_escape_string($connection, $id);
	$sql = "SELECT * FROM 10163487_loomaaed WHERE id=$id";
	$result = mysqli_query($connection, $sql) or die("Viga - ".mysqli_error($connection));
	if (mysqli_num_rows($result)) {
		return mysqli_fetch_assoc($result);
	} else {
		header("Location: ?page=loomad");
	}
}

// lisada funktsioon muuda(), mis on ülesehituselt väga sarnane funktsiooniga lisa() (võib teha koopia ja seda kohandada)
function muuda(){
	// siia on vaja funktsionaalsust (13. nädalal)
	global  $connection;
	if (empty($_SESSION['user'])) {
		header("Location: ?page=login");
	} elseif ($_SESSION["role"] != "admin") {
		header("Location: ?page=loomad");
	} else {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if ($_POST['nimi'] == "") {
				$errors = array();
				$errors[] = "Nimi vajalik!";
			} elseif ($_POST['puur'] == ""){
				$errors[] = "Puur vajalik!";
			} elseif ($_POST['id'] == ""){
				header("Location: ?page=loomad");
			} else {
				$id = mysqli_real_escape_string($connection, $_POST['id']);
				$loom = hangi_loom($id);
				$nimi = mysqli_real_escape_string($connection, $_POST['nimi']);
				$puur = mysqli_real_escape_string($connection, $_POST['puur']);
				if (upload("liik")) {
					$liik = mysqli_real_escape_string($connection, upload('liik'));
				} else {
					$liik = $loom['liik'];
				}
				$sql = "UPDATE 10163487_loomaaed SET nimi = '$nimi', puur = '$puur', liik = '$liik' WHERE id = '$id'";
				$result = mysqli_query($connection, $sql);
				header("Location: ?page=loomad");
			}
		} elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
			$id = mysqli_real_escape_string($connection, $_GET['id']);
			if ($id == "") {
				header("Location: ?page=loomad");
			} else {
				$loom = hangi_loom($id);
			}
		}
	}
	include_once('views/editvorm.html');
}

?>