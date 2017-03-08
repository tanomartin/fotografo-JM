<?php 
	include('includes/templateEngine.inc.php');
	include('backend/include/conexion.php');
	include('includes/consultasNavbar.php');
	
	$arrayEntradas = array();
	$sqlBlog = "select * from blog where activo = 1";
	$resBlog = $mysqli->query($sqlBlog);
	$rows = $resBlog->num_rows;
	if ($rows > 0) {
		$e=0;
		while($entradas = $resBlog->fetch_assoc()) {
			$arrayEntradas[$i] = $entradas;
			$e++;
		}
	}
	
	$twig->display('blog.html', array("entradas"=>$arrayEntradas, "albumes" => $arrayAlbum, "activeBlog" => $activBlog));
?>