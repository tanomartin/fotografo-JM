<?php 
include ("include/conexion.php");
session_save_path ("session");
session_start ();
if ($_SESSION ['username'] == NULL)
	header ( "Location: index.html" );

try {
	mysqli_autocommit($mysqli, FALSE);
	$idAlbum = $_GET['id'];
	$estado = $_GET['estado'];
	$sqlActivarAlbum = "UPDATE albumes SET activo = $estado WHERE id = $idAlbum";
	mysqli_query($mysqli, $sqlActivarAlbum);
	mysqli_commit($mysqli);
	mysqli_close($mysqli);
	header('Location: album.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>