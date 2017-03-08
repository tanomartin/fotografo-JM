<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	$idBlog = $_GET['id'];
	$sqlBlog = "select path from blog WHERE id = $idBlog";
	$resBlog = $mysqli->query($sqlBlog);
	$fila = $resBlog->fetch_assoc();
	
	$sqlDeleteBlog = "DELETE FROM blog WHERE id = $idBlog";
	mysqli_query($mysqli, $sqlDeleteBlog);
	$foto = "../".$fila['path'];
	unlink($foto);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header('Location: blog.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>