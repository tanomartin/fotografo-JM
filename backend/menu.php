<?php 
include ("include/conexion.php");
session_save_path ("session");
session_start ();
if ($_SESSION ['username'] == NULL)
	header ( "Location: index.html" );

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador - Fotografo JM</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Top Navigation -->
        <?php include("include/navbar.php")?>

        <!-- Sidebar -->
        <?php include("include/sidebar.php")?>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Álbumes</h1>
                </div>
            </div>
	
            <table class="table">
            	<thead>
            		<th>Id</th>
            		<th>Nombre</th>
            		<th>Portada</th>
            		<th>Activo</th>
            		<th>Acciones</th>
            	</thead>
            	<tbody>
            		<?php
            			$sqlAlbumes = "select * from albumes a, photos p where a.idPortada = p.id";
						$resultado = $mysqli->query($sqlAlbumes);
            			while($fila = $resultado->fetch_assoc()) { ?>
	                      <tr>
	                          <td><?php echo $fila['id']?></td>
	                          <td><?php echo $fila['nombre']?></td>
	                          <td><img src="../<?php echo $fila['path']?>" class="img-responsive" alt="Cinque Terre" style="width: 100px"/></td>
	                       	  <td><?php if ($fila['activo'] == 1) { ?>
	                       	  				<span class="glyphicon glyphicon-ok" style="color: green; font-size: larger"></span>
	                       	  	  <?php } else { ?>
	                       	  	  			<span class="glyphicon glyphicon-remove" style="color: red; font-size: larger"></span>
	                       	  	  <?php } ?>
	                       	  </td>	
	                       	  <td>
	                       	  	<a href="#" title="Editar"><span class="glyphicon glyphicon-pencil" style="font-size: larger"></span></a>
	                       	  	<a href="#" title="Eliminar"><span class="glyphicon glyphicon-trash" style="font-size: larger"></span></a>
	                       	  	<a href="#" title="Editar Fotos"><span class="glyphicon glyphicon-picture" style="font-size: larger"></span></a>
	                       	  </td>
	                       </tr>
                  <?php } ?>
            	</tbody>
            </table>

        </div>
    </div>

</div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>

</body>
</html>
