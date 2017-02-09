<?php 
include ("include/conexion.php");
session_save_path ("session");
session_start ();
if ($_SESSION ['username'] == NULL)
	header ( "Location: index.html" );


try {
	mysqli_autocommit($mysqli, FALSE);
	
	$id= $_GET['id'];
	$orden = $_GET['orden'];
	$ordenPosterior = $orden + 1;
	$idAlbum = $_GET['idAlbum'];
	
	$sqlDownFirst = "UPDATE fotos SET orden = -1 WHERE idAlbum = $idAlbum and orden = $ordenPosterior";
	echo $sqlDownFirst."<br>";
	mysqli_query($mysqli, $sqlDownFirst);
	$sqlUpFoto = "UPDATE fotos SET orden = $ordenPosterior WHERE idAlbum = $idAlbum and orden = $orden";
	echo $sqlUpFoto."<br>";
	mysqli_query($mysqli, $sqlUpFoto);
	$sqlDownLast = "UPDATE fotos SET orden = $orden WHERE idAlbum = $idAlbum and orden = -1";
	echo $sqlDownLast."<br>";
	mysqli_query($mysqli, $sqlDownLast);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header("Location: album.editar.php?id=".$idAlbum);
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>