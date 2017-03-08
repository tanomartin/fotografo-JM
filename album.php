<?php 
	include('includes/templateEngine.inc.php');
	include('backend/include/conexion.php');
	
	$idAlbum = $_GET['id'];
	$sqlAlbum = "select * from albumes a where a.id = $idAlbum";
	$resAlbum = $mysqli->query($sqlAlbum);
	$album = $resAlbum->fetch_assoc();
	
	$sqlFotos = "select * from fotos a where a.idEntidad = $idAlbum order by orden";
	$resFotos = $mysqli->query($sqlFotos);
	$fotos = array();
	$f=0;
	while($foto = $resFotos->fetch_assoc()) {
		$fotos[$f] = $foto;
		$f++;
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
	
	if ($album['tipo'] == 1) {
		$twig->display('mosaico.html', array("album" => $album, "fotos" => $fotos, "albumes" => $arrayAlbum));
	}
	if ($album['tipo'] == 2) {
		$twig->display('pinterest.html', array("album" => $album, "fotos" => $fotos, "albumes" => $arrayAlbum));
	}
	if ($album['tipo'] == 3) {
		$twig->display('sabana.html', array("album" => $album, "fotos" => $fotos, "albumes" => $arrayAlbum));
	}
	if ($album['tipo'] == 4) {
		$twig->display('slide.html', array("album" => $album, "fotos" => $fotos, "albumes" => $arrayAlbum));
	}
?>