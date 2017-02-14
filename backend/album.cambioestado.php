<?php include_once ("include/control.php");

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