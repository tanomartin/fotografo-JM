<?php session_save_path("session");
session_start();
include ("include/conexion.php");
$sql = "select * from usuarios where id = '".$_SESSION['id']."' and password = '".$_POST['passold']."'";
$resultado = $mysqli->query($sql);
$cant =  $resultado->num_rows;
if ($cant > 0) {
	$sqlUpdate = "update usuarios set password = '".$_POST['newpass']."' where id = ".$_SESSION['id'];
	if ($mysqli->query($sqlUpdate) === TRUE) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	echo 0;
}
mysqli_close($mysqli);

?>