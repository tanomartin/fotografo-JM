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
	$path = $_GET['path'];
	$idAlbum = $_GET['idAlbum'];

	$sqlReordenamiento = "SELECT * FROM fotos WHERE idAlbum = $idAlbum and orden > $orden order by orden";
	$resReordenamiento = $mysqli->query($sqlReordenamiento);
	while ($foto = $resReordenamiento->fetch_assoc()) {
		$nuevoOrden = $foto['orden'] - 1;
		$sqlUpdateOrden = "UPDATE fotos SET orden = $nuevoOrden where id = ".$foto['id'];
		mysqli_query($mysqli, $sqlUpdateOrden);
	}
	
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