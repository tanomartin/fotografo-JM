<?php include_once ("include/control.php");


try {
	mysqli_autocommit($mysqli, FALSE);
	
	$orden = $_GET['orden'];
	$ordenPosterior = $orden + 1;
	
	$sqlDownFirst = "UPDATE albumes SET orden = -1 WHERE orden = $ordenPosterior";
	mysqli_query($mysqli, $sqlDownFirst);
	$sqlUp = "UPDATE albumes SET orden = $ordenPosterior WHERE orden = $orden";
	mysqli_query($mysqli, $sqlUp);
	$sqlDownLast = "UPDATE albumes SET orden = $orden WHERE orden = -1";
	mysqli_query($mysqli, $sqlDownLast);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header("Location: album.php");
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>