<?php include_once ("include/control.php"); 

try {
	mysqli_autocommit($mysqli, FALSE);
	
	$sqlDeleteSlider = "DELETE FROM slider";
	mysqli_query($mysqli,$sqlDeleteSlider);
	
	$orden = 1;
	foreach($_POST as $key => $datos) {
		if (strpos($key, 'foto') !== false) {
			$arrayKey = explode ('-',$key);
			$idFoto = $arrayKey[1];
			$sqlInsertSlider = "INSERT INTO slider VALUES($idFoto, $orden)";
			mysqli_query($mysqli,$sqlInsertSlider);
			$orden++;
		}
		
	}
	
	mysqli_commit($mysqli);
	mysqli_close($mysqli);
	
	header('Location: slider.php');
} catch (Exception $e) { 
	$mysqli->rollback();
}

?>