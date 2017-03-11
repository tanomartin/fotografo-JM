<?php 
	include('includes/templateEngine.inc.php');
	include('backend/include/conexion.php');
	include('includes/consultasNavbar.php');
	
	$arrayEntradas = array();
	$sqlBlog = "select b.*, DATE_FORMAT(b.fecha,'%m-%d-%Y') as fecha from blog b where b.activo = 1 order by fecha DESC, id DESC";
	$resBlog = $mysqli->query($sqlBlog);
	$rows = $resBlog->num_rows;
	if ($rows > 0) {
		$e=0;
		while($entradas = $resBlog->fetch_assoc()) {
			$arrayEntradas[$e] = $entradas;
			$e++;
		}
	}
	
	$twig->display('blog.html', array("entradas"=>$arrayEntradas, "albumes" => $arrayAlbum, "activeBlog" => $activBlog));
?>