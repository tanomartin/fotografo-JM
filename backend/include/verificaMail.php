<?php
include ("conexion.php");
$mail = $_POST ['email'];
$username = $_POST ['username'];
$sql = "select * from usuarios where username = '$username' and email = '$mail'";
$resultado = $mysqli->query($sql);
$cant =  $resultado->num_rows;
if ($cant > 0) {
	$fila = $resultado->fetch_assoc();
	$asunto = "Recordatorio de Contraseña de Administrador";
	$mensaje = $fila['nombre'].": " . "\r\n";
	$mensaje .= "La contraseña requerida del usuario ".$username." es ".$fila['password']." .";
	$cabeceras = "MIME-Version: 1.0" . "\r\n";
	$cabeceras .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$cabeceras .= "From: BackEnd Pagina WEB <no-replay>" . "\r\n";
	mail($mail, $asunto, $mensaje, $cabeceras);
} 
echo $cant;
?>


