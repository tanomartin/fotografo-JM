<?php

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];

$to = "contacto@josemoroni.com.ar";
$subject = "Mensaje a traves del formulario de contacto";
$contenido = "Nombre: $nombre\n\n";
$contenido .= "Email: $email\n\n";
$contenido .= "Telefono: $telefono\n\n";
$contenido .= "Comentario: $mensaje\n\n";
$header = "From: Formulario de contacto <no-reply@c0300434.ferozo.com>\nReply-To: $email\n";
$header .= "Mime-Version: 1.0\n";
$header .= "Content-Type: text/plain";
if(mail($to, $subject, $contenido ,$header)){
	echo 1;
} else {
	echo 0;
}
?>