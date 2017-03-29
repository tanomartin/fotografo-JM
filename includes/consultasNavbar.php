<?php
$sqlActiveBlog = "select count(*) as cant from blog where activo = 1";
$resActiveBlog = $mysqli->query($sqlActiveBlog);
$rowActiveBlog = $resActiveBlog->fetch_assoc();
$activBlog = $rowActiveBlog['cant'];

$arrayAlbum = array();
$sqlAlbumes = "select * from albumes a where activo = 1 order by orden";
$resAlbumes = $mysqli->query($sqlAlbumes);
$rows = $resAlbumes->num_rows;
if ($rows > 0) {
	$i=0;
	while($albumMenu = $resAlbumes->fetch_assoc()) {
		$arrayAlbum[$i] = $albumMenu;
		$i++;
	}
}
?>