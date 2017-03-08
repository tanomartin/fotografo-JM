<?php 
	include('includes/templateEngine.inc.php');
	include('backend/include/conexion.php');
	include('includes/consultasNavbar.php');
	
	$twig->display('sobremi.html', array("albumes" => $arrayAlbum, "activeBlog" => $activBlog));
?>