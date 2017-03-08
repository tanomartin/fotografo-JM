<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	
	$id= $_GET['id'];
	$path = $_GET['path'];
	$sqlDeleteFoto = "UPDATE blog SET path = NULL WHERE id = $id";
	mysqli_query($mysqli, $sqlDeleteFoto);
	unlink("../".$path);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header("Location: blog.editar.php?id=".$id);
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>