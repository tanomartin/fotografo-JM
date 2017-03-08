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