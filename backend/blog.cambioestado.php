<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	$idBlog = $_GET['id'];
	$estado = $_GET['estado'];
	$sqlActivarBlog = "UPDATE blog SET activo = $estado WHERE id = $idBlog";
	mysqli_query($mysqli, $sqlActivarBlog);
	mysqli_commit($mysqli);
	mysqli_close($mysqli);
	header('Location: blog.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>