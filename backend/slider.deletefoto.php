<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);
	
	$id= $_GET['id'];
	$orden = $_GET['orden'];

	$sqlReordenamiento = "SELECT * FROM slider WHERE orden > $orden order by orden";
	$resReordenamiento = $mysqli->query($sqlReordenamiento);
	while ($slider = $resReordenamiento->fetch_assoc()) {
		$nuevoOrden = $slider['orden'] - 1;
		$sqlUpdateOrden = "UPDATE slider SET orden = $nuevoOrden where idFoto = ".$slider['idFoto'];
		mysqli_query($mysqli, $sqlUpdateOrden);
	}
	
	$sqlDeleteFoto = "DELETE FROM slider WHERE idFoto = $id";
	mysqli_query($mysqli, $sqlDeleteFoto);
	
	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header("Location: slider.php");
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>