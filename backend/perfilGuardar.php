<?php session_save_path("session");
session_start();
include ("include/conexion.php");
$sqlUpdate = "update usuarios set username = '".$_POST['username']."', nombre = '".$_POST['nombre']."', email = '".$_POST['email']."' where id = ".$_SESSION['id'];
if ($mysqli->query($sqlUpdate) === TRUE) {
	$_SESSION['name'] = $_POST['nombre'];
	echo 1;
} else {
	echo 0;
}

?>