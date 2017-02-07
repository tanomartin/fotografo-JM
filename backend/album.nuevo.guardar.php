<?php 
include ("include/conexion.php");
session_save_path ("session");
session_start ();
var_dump($_POST);echo "<br>";
if ($_SESSION ['username'] == NULL)
	header ( "Location: index.html" );

try {
	mysqli_autocommit($mysqli, FALSE);
	$sqlInsertAlbum = "INSERT INTO albumes VALUES(DEFAULT, '".$_POST['titulo']."',0,0)";
	mysqli_query($mysqli, $sqlInsertAlbum);
	$idAlbum = $mysqli->insert_id;
	
	if (isset($_FILES["file"])) {	
		$carpeta = "../fotos/".$idAlbum."/";
		if (!file_exists ( $carpeta )) {
			if(!mkdir($carpeta, 0777, true)) {
	    		die('Fallo al crear las carpetas...');
			} 
		}
		
		for($x=0; $x<count($_FILES["file"]["name"]); $x++) {
			$file = $_FILES["file"];
			$nombre = $file["name"][$x];
			$ruta_provisional = $file["tmp_name"][$x];
			$src = $carpeta.$nombre;
			move_uploaded_file($ruta_provisional, $src);
			$nombreDes = "descrip".$x;
			$descrip = $_POST[$nombreDes];
			$destino = "fotos/".$idAlbum."/".$nombre;
			$sqlInsertFoto = "INSERT INTO fotos VALUES(DEFAULT, $idAlbum, '$descrip','$destino')";
			mysqli_query($mysqli,$sqlInsertFoto);
			if ($x == $_POST['portada']) {
				$idPortada = $mysqli->insert_id;
				$sqlUpdatePortada = "UPDATE albumes set idPortada = $idPortada where id = $idAlbum";
				mysqli_query($mysqli,$sqlUpdatePortada);
			}

		}
		mysqli_commit($mysqli);
		mysqli_close($mysqli);
	}
	header('Location: menu.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>