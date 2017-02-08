<?php 
include ("include/conexion.php");
session_save_path ("session");
session_start ();

if ($_SESSION ['username'] == NULL)
	header ( "Location: index.html" );	

try {
	$id = $_GET['id'];
	mysqli_autocommit($mysqli, FALSE);
	$sqlUpdateAlbum = "UPDATE albumes SET titulo = '".$_POST['titulo']."', tipo = ".$_POST['tipo'].", idPortada = ".$_POST['portada']." WHERE id = $id";
	mysqli_query($mysqli, $sqlUpdateAlbum);
	foreach ($_POST as $key => $datos) {
		if (strpos($key, 'descrip') !== false) {
			$arrayKey = explode ('-',$key);
			$sqlUpdateFoto = "UPDATE fotos SET bajada = '$datos' WHERE id = ".$arrayKey[1];
			mysqli_query($mysqli, $sqlUpdateFoto);
		}
	}
	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header('Location: album.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>