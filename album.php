<?php 
	include('includes/templateEngine.inc.php');
	include('backend/include/conexion.php');
	include('includes/consultasNavbar.php');
	
	$idAlbum = $_GET['id'];
	$sqlAlbum = "select * from albumes a where a.id = $idAlbum";
	$resAlbum = $mysqli->query($sqlAlbum);
	$album = $resAlbum->fetch_assoc();
	
	$sqlFotos = "select * from fotos a where a.idAlbum = $idAlbum order by orden";
	$resFotos = $mysqli->query($sqlFotos);
	$fotos = array();
	$f=0;
	while($foto = $resFotos->fetch_assoc()) {
		$fotos[$f] = $foto;
		$f++;
	}
	
	if ($album['tipo'] == 1) {
		$twig->display('mosaico.html', array("album" => $album, "fotos" => $fotos, "albumes" => $arrayAlbum, "activeBlog" => $activBlog));
	}
	if ($album['tipo'] == 2) {
		$twig->display('pinterest.html', array("album" => $album, "fotos" => $fotos, "albumes" => $arrayAlbum, "activeBlog" => $activBlog));
	}
	if ($album['tipo'] == 3) {
		$twig->display('sabana.html', array("album" => $album, "fotos" => $fotos, "albumes" => $arrayAlbum, "activeBlog" => $activBlog));
	}
	if ($album['tipo'] == 4) {
		$twig->display('slide.html', array("album" => $album, "fotos" => $fotos, "albumes" => $arrayAlbum, "activeBlog" => $activBlog));
	}
?>