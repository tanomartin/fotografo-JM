<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	$idBlog = $_GET['id'];
	var_dump($_FILES);
	if ($_FILES['file']['tmp_name'] != "") {	
		$sqlBlog = "select path from blog WHERE id = $idBlog";
		$resBlog = $mysqli->query($sqlBlog);
		$fila = $resBlog->fetch_assoc();
		if ($fila['path'] != null) {
			$foto = "../".$fila['path'];
			unlink($foto);
		}
		
		$file = $_FILES["file"];		
		$nombre = $idBlog."-".$file["name"];	
		$destino = "fotos/blog/".$nombre;
		$sqlUpdateBlog = "UPDATE blog SET titulo = '".$_POST['titulo']."', texto = '".$_POST['texto']."', path = '$destino' WHERE id = $idBlog";
		
		$ruta_provisional = $file["tmp_name"];
		$carpeta = "../fotos/blog/";
		$src = $carpeta.$nombre;
		move_uploaded_file($ruta_provisional, $src);	
	} else {
		$sqlUpdateBlog = "UPDATE blog SET titulo = '".$_POST['titulo']."', texto = '".$_POST['texto']."' WHERE id = $idBlog";
	}

	mysqli_query($mysqli, $sqlUpdateBlog);
	mysqli_commit($mysqli);
	mysqli_close($mysqli);
	header('Location: blog.php');
	
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>