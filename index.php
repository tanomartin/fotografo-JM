<?php 
	include('includes/templateEngine.inc.php');
	include('backend/include/conexion.php');
	include('includes/consultasNavbar.php');
	
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
		$arraySlider[0] = array('path' => "fotos/default/default-img.jpg");
		$claves_aleatorias = 0;
 	}
 	
	$twig->display('index.html', array("foto" => $arraySlider[$claves_aleatorias], "albumes" => $arrayAlbum, "activeBlog" => $activBlog));
?>