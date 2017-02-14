<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	
	$idAlbum = $_GET['id'];
	$orden = $_GET['canfotos']+1;
	$file = $_FILES['foto'];
	
	$carpeta = "../fotos/".$idAlbum."/";
	$nombre = $file["name"];
	$sqlAddFoto = "INSERT INTO fotos VALUES('DEFAUL', $idAlbum, $orden, '".$_POST['titu']."','".$_POST['desc']."', '')";
	mysqli_query($mysqli, $sqlAddFoto);
	$idFoto = $mysqli->insert_id;
	
	$destino = "fotos/".$idAlbum."/".$idFoto."-".$nombre;
	$sqlUpdateDestino = "UPDATE fotos SET path = '$destino' WHERE id = $idFoto";
	mysqli_query($mysqli, $sqlUpdateDestino);
	
	$ruta_provisional = $file["tmp_name"];
	$src = $carpeta.$idFoto."-".$nombre;
	move_uploaded_file($ruta_provisional, $src);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);
	echo 0;
	
} catch (Exception $e) { 
	echo -1;
	$mysqli->rollback();
}

?>