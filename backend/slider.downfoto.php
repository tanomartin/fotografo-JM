<?php include_once ("include/control.php");


try {
	mysqli_autocommit($mysqli, FALSE);
	
	$orden = $_GET['orden'];
	$ordenPosterior = $orden + 1;
	
	$sqlDownFirst = "UPDATE slider SET orden = -1 WHERE orden = $ordenPosterior";
	echo $sqlDownFirst."<br>";
	mysqli_query($mysqli, $sqlDownFirst);
	$sqlUpFoto = "UPDATE slider SET orden = $ordenPosterior WHERE orden = $orden";
	echo $sqlUpFoto."<br>";
	mysqli_query($mysqli, $sqlUpFoto);
	$sqlDownLast = "UPDATE slider SET orden = $orden WHERE orden = -1";
	echo $sqlDownLast."<br>";
	mysqli_query($mysqli, $sqlDownLast);

	mysqli_commit($mysqli);
	mysqli_close($mysqli);

	header("Location: slider.php");
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>