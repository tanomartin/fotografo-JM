<?php 
include ("include/conexion.php");
session_save_path ("session");
session_start ();
if ($_SESSION ['username'] == NULL)
	header ( "Location: index.html" );


try {
	mysqli_autocommit($mysqli, FALSE);
	
	$id= $_GET['id'];
	$path = $_GET['path'];
	$idAlbum = $_GET['idAlbum'];
	
	echo $path;

	$sqlDeleteFoto = "DELETE FROM fotos WHERE id = $id";
	mysqli_query($mysqli, $sqlDeleteFoto);
	
	unlink("../".$path);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header("Location: album.editar.php?id=".$idAlbum);
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>