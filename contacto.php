<?php 
	include_once('includes/templateEngine.inc.php');
	include_once('backend/include/conexion.php');
	include_once('includes/consultasNavbar.php');
	
	$twig->display('contacto.html', array("albumes" => $arrayAlbum, "activeBlog" => $activBlog));
?>