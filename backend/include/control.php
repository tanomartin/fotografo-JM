<?php 
include ("conexion.php");
session_start ();
if ($_SESSION ['username'] == NULL)
	header ( "Location: index.php" );

?>