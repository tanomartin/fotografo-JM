<?php include_once ("include/control.php");

try {
	mysqli_autocommit($mysqli, FALSE);

	$orden = $_GET['orden'];
	$ordenAnterior = $orden - 1;
	
	$sqlDownFirst = "UPDATE slider SET orden = -1 WHERE orden = $ordenAnterior";
	mysqli_query($mysqli, $sqlDownFirst);
	$sqlUpFoto = "UPDATE slider SET orden = $ordenAnterior WHERE orden = $orden";
	mysqli_query($mysqli, $sqlUpFoto);
	$sqlDownLast = "UPDATE slider SET orden = $orden WHERE orden = -1";
	mysqli_query($mysqli, $sqlDownLast);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header("Location: slider.php");
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>