<?php 
	include('includes/templateEngine.inc.php');
	include('backend/include/conexion.php');
	
	$arraySlider = array();
	$sqlSlider = "SELECT s.*, f.path, a.titulo, a.activo FROM slider s, fotos f, albumes a WHERE s.idFoto = f.id and f.idAlbum = a.id order by s.orden";
	$resSlider = $mysqli->query($sqlSlider);
	$numSlider = $resSlider->num_rows;
	if ($numSlider > 0) {
		$i=0;
		while($slider = $resSlider->fetch_assoc()) {
			$arraySlider[$i] = $slider;
			$i++;
		}
		$claves_aleatorias = array_rand($arraySlider, 1);
	} else {
		$arraySlider[0] = array('path' => "standard/default-img.jpg");
		$claves_aleatorias = 0;
 	}
 	
 	$arrayAlbum = array();
 	$sqlAlbumes = "select * from albumes a where activo = 1";
 	$resAlbumes = $mysqli->query($sqlAlbumes);
 	$rows = $resAlbumes->num_rows;
 	if ($rows > 0) { 
 		$i=0;
 		while($albumMenu = $resAlbumes->fetch_assoc()) {
 			$arrayAlbum[$i] = $albumMenu;
 			$i++;
 		}
 	}
	
	$twig->display('index.html', array("foto" => $arraySlider[$claves_aleatorias], "albumes" => $arrayAlbum));
?>