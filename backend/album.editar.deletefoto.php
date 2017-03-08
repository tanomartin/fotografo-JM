<?php include_once ("include/control.php");

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
	
	
	$sqlSelectSlider = "SELECT * FROM slider WHERE idFoto = $id";
	$resSelectSlider = $mysqli->query($sqlSelectSlider);
	$rows = $resSelectSlider->num_rows;
	if ($rows > 0) {
		$sqlDeleteSlide = "DELETE FROM slider WHERE idFoto = $id";
		mysqli_query($mysqli, $sqlDeleteSlide);
		
		$sqlSelectOrdenSlider = "SELECT * FROM slider order by orden";
		$resSelectOrdenSlider = $mysqli->query($sqlSelectOrdenSlider);
		$rowsUpdate = $resSelectOrdenSlider->num_rows;
		if ($rowsUpdate > 0) {
			$orden = 1;
			while($fila = $resSelectOrdenSlider->fetch_assoc()) { 
				$sqlUpdateOrdenSlide = "UPDATE slider SET orden = $orden WHERE idFoto = ".$fila['idFoto'];
				mysqli_query($mysqli, $sqlUpdateOrdenSlide);
				$orden++;	
			}
		}
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