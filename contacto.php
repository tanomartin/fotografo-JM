<?php 
	include('includes/templateEngine.inc.php');
	include('backend/include/conexion.php');

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
	
	$twig->display('contacto.html', array("albumes" => $arrayAlbum));
?>