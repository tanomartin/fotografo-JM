<?php session_save_path("../session");
session_start();
include ("conexion.php");
$sql = "select * from usuarios where username = '".$_POST['username']."' and password = '".$_POST['password']."'";
$resultado = $mysqli->query($sql);
$cant =  $resultado->num_rows;
if ($cant > 0) {
	$fila = $resultado->fetch_assoc();
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['name'] = $fila['nombre'];
	$_SESSION['id'] = $fila['id'];
}
echo $cant;
?>
