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
	$arrayUpdate = array();
	foreach ($_POST as $key => $titulo) {
		if (strpos($key, 'titulo-') !== false) {
			$arrayKey = explode ('-',$key);
			$nombreDescrip = 'descripcion-'.$arrayKey[1];
			$descrip = $_POST[$nombreDescrip];
			$sqlUpdateDescripFoto = "UPDATE fotos SET bajada = '$descrip', titulo = '$titulo' WHERE id = ".$arrayKey[1];
			mysqli_query($mysqli, $sqlUpdateDescripFoto);
		}
	}
	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header('Location: album.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>