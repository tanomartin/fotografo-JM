<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	$date = date("Y-m-d");
	
	$sqlInsertBlog = "INSERT INTO blog VALUES(DEFAULT, '".$_POST['titulo']."','".$_POST['texto']."',NULL,'$date',0)";
	mysqli_query($mysqli, $sqlInsertBlog);
	$idBlog = $mysqli->insert_id;

	if ($_FILES['file']['tmp_name'] != "") {	
		$file = $_FILES["file"];		
		$nombre = $idBlog."-".$file["name"];	
		$destino = "fotos/blog/".$nombre;
		$sqlUpdateDestino = "UPDATE blog SET path = '$destino' WHERE id = $idBlog";
		mysqli_query($mysqli,$sqlUpdateDestino);
		$ruta_provisional = $file["tmp_name"];
		
		$carpeta = "../fotos/blog/";
		$src = $carpeta.$nombre;
		move_uploaded_file($ruta_provisional, $src);	
	} 
	mysqli_commit($mysqli);
	mysqli_close($mysqli);
	header('Location: blog.php');
	
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>