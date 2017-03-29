<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	
	$sqlOrden = "SELECT count(*) as cantidad FROM albumes";
	$resOrden = $mysqli->query($sqlOrden);
	$rowOrden = $resOrden->fetch_assoc();
	$orden = $rowOrden['cantidad'] + 1;
	
	$sqlInsertAlbum = "INSERT INTO albumes VALUES(DEFAULT, '".$_POST['titulo']."','".$_POST['subtitulo']."',$orden,0,0,".$_POST['tipo'].")";
	mysqli_query($mysqli, $sqlInsertAlbum);
	$idAlbum = $mysqli->insert_id;
	
	if (isset($_FILES["file"])) {	
		$carpeta = "../fotos/album/".$idAlbum."/";
		if (!file_exists ( $carpeta )) {
			if(!mkdir($carpeta, 0777, true)) {
	    		die('Fallo al crear las carpetas...');
			} 
		}
		
		for($x=0; $x<count($_FILES["file"]["name"]); $x++) {
			$file = $_FILES["file"];
			
			$nombre = $file["name"][$x];
			$nombreTit = "titulo".$x;
			$titulo = $_POST[$nombreTit];
			$nombreDes = "descrip".$x;
			$descrip = $_POST[$nombreDes];
			$orden = $x+1;
			$sqlInsertFoto = "INSERT INTO fotos VALUES(DEFAULT, $idAlbum, $orden, '$titulo', '$descrip','')";
			mysqli_query($mysqli,$sqlInsertFoto);
			$idFoto = $mysqli->insert_id;
			
			if ($x == $_POST['portada']) {
				$sqlUpdatePortada = "UPDATE albumes set idPortada = $idFoto where id = $idAlbum";
				mysqli_query($mysqli,$sqlUpdatePortada);
			}
				
			$destino = "fotos/album/".$idAlbum."/".$idFoto."-".$nombre;
			$sqlUpdateDestino = "UPDATE fotos SET path = '$destino' WHERE id = $idFoto";
			mysqli_query($mysqli,$sqlUpdateDestino);
			
			$ruta_provisional = $file["tmp_name"][$x];
			$src = $carpeta.$idFoto."-".$nombre;
			move_uploaded_file($ruta_provisional, $src);
		}
		mysqli_commit($mysqli);
		mysqli_close($mysqli);
	}
	header('Location: album.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>