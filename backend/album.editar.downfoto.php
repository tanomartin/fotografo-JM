<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	
	$id= $_GET['id'];
	$orden = $_GET['orden'];
	$ordenPosterior = $orden + 1;
	$idAlbum = $_GET['idAlbum'];
	
	$sqlDownFirst = "UPDATE fotos SET orden = -1 WHERE idAlbum = $idAlbum and orden = $ordenPosterior";
	mysqli_query($mysqli, $sqlDownFirst);
	$sqlUpFoto = "UPDATE fotos SET orden = $ordenPosterior WHERE idAlbum = $idAlbum and orden = $orden";
	mysqli_query($mysqli, $sqlUpFoto);
	$sqlDownLast = "UPDATE fotos SET orden = $orden WHERE idAlbum = $idAlbum and orden = -1";
	mysqli_query($mysqli, $sqlDownLast);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header("Location: album.editar.php?id=".$idAlbum);
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>