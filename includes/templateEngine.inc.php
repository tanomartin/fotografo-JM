<?php

// Preparando el engine de templates
// Twig
$root = '';
// Incluimos Twig Auto Loader
require($root . 'includes/php/Twig/Autoloader.php');
Twig_Autoloader::register();

// Definimos la ruta donde estarán nuestros templates
$loader = new Twig_Loader_Filesystem($root . 'formularios');

// Inicializamos twig
$twig = new Twig_Environment($loader);

?>