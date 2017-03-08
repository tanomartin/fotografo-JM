<?php include_once ("include/control.php");

function deleteDirectory($folder) {
	foreach(glob($folder . "/*") as $files_folder) {
    	if (is_dir($files_folder)) {
            deleteDirectory($files_folder);
    	} else {
            unlink($files_folder);
        }
     }
     rmdir($folder);
}

try {
	mysqli_autocommit($mysqli, FALSE);
	
	$idAlbum = $_GET['id'];
	
	$sqlSelectSlider = "SELECT s.idFoto FROM fotos f, slider s WHERE f.idAlbum = $idAlbum and f.id = s.idFoto";
	$resSelectSlider = $mysqli->query($sqlSelectSlider);
	$rows = $resSelectSlider->num_rows;
	if ($rows > 0) {
		while($fila = $resSelectSlider->fetch_assoc()) {
			$sqlDeleteSlider = "DELETE FROM slider WHERE idFoto = ".$fila['idFoto'];
			mysqli_query($mysqli, $sqlDeleteSlider);
		}
		
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
	
	$sqlDeleteAlbum = "DELETE FROM albumes WHERE id = $idAlbum";
	mysqli_query($mysqli, $sqlDeleteAlbum);
	$sqlDeleteFoto = "DELETE FROM fotos WHERE idAlbum = $idAlbum";
	mysqli_query($mysqli, $sqlDeleteFoto);
	
	$directorio = "../fotos/album/$idAlbum";
	deleteDirectory($directorio);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header('Location: album.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>