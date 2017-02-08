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
                    <h1 class="page-header">
                    	Álbumes
                    	<button onclick="location.href = 'album.nuevo.php'" type="button" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Nuevo Album</button>
                    </h1>
                </div>
            </div>
			<?php
            	$sqlAlbumes = "select a.*, p.path, t.descripcion as tipo from albumes a, fotos p, tipos t where a.idPortada = p.id and a.tipo = t.id";
				$resultado = $mysqli->query($sqlAlbumes);
				$rows = $resultado->num_rows;
				if ($rows > 0) { ?>
		            <table class="table">
		            	<thead>
		            		<th>Id</th>
		            		<th>Titulo</th>
		            		<th>Portada</th>
		            		<th>Estado</th>
		            		<th>Tipo</th>
		            		<th>Acciones</th>
		            	</thead>
		            	<tbody>
	             <?php while($fila = $resultado->fetch_assoc()) { ?>
	                      <tr>
	                          <td><?php echo $fila['id']?></td>
	                          <td><?php echo $fila['titulo']?></td>
	                          <td><img src="../<?php echo $fila['path']?>" class="img-responsive" alt="Cinque Terre" style="width: 100px"/></td>
	                       	  <td><?php if ($fila['activo'] == 1) { ?>
	                       	  				<span class="glyphicon glyphicon-ok" title="Activo" style="color: green; font-size: larger"></span>
	                       	  	  <?php } else { ?>
	                       	  	  			<span class="glyphicon glyphicon-remove" title="Inactivo" style="color: red; font-size: larger"></span>
	                       	  	  <?php } ?>
	                       	  </td>
	                       	   <td><?php echo $fila['tipo']?></td>	
	                       	  <td>
	                       	  	<a href="album.editar.php?id=<?php echo $fila['id']?>" title="Editar"><span class="glyphicon glyphicon-pencil" style="font-size: larger"></span></a>
	                       	  	<a href="#" data-toggle="modal" data-href="album.delete.php?id=<?php echo $fila['id']?>" data-target="#confirm-delete" title="Eliminar"><span class="glyphicon glyphicon-trash" style="font-size: larger"></span></a>
	                       	  	<a href="#" title="Vista Previa"><span class="glyphicon glyphicon-eye-open" style="font-size: larger"></span></a>
	                       	  	<?php if ($fila['activo'] == 1) { ?>
	                       	  				<a href="#" data-toggle="modal" data-href="album.cambioestado.php?id=<?php echo $fila['id']?>&estado=0" data-target="#confirm-desactivar" title="desactivar"><span class="glyphicon glyphicon-arrow-down" title="Desactivar" style="color: red; font-size: larger"></span></a>
	                       	  	<?php } else { ?>
	                       	  		 		<a href="#" data-toggle="modal" data-href="album.cambioestado.php?id=<?php echo $fila['id']?>&estado=1" data-target="#confirm-activar" title="Activar"><span class="glyphicon glyphicon-arrow-up" style="color: green; font-size: larger"></span></a>
	                       	  	   <?php } ?>
	                       	  </td>
	                       </tr>
                  <?php } ?>
            	</tbody>
            </table>
            <?php } else { ?>
          		<div class="alert alert-info">No hay albumes cargados hasta el momento</div>
            <?php } ?>
			
			<!-- MODALS -->
			
				<div class="modal fade" id="confirm-activar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			        <div class="modal-dialog">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    <h4 class="modal-title" id="myModalLabel">Confirmación de Activación de Album</h4>
			                </div>
			                <div class="modal-body">
			                    <p>Esta seguro que desea activar el Album</p>
			                    <p>Para continuar presione el boton Activar, si desea cancelar lo puede hacer presionando Cancelar</p>
			                </div>
			                <div class="modal-footer">
			                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			                    <a class="btn btn-success btn-ok">Activar</a>
			                </div>
			            </div>
			        </div>
			    </div>
			    
			    <div class="modal fade" id="confirm-desactivar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			        <div class="modal-dialog">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    <h4 class="modal-title" id="myModalLabel">Confirmación la Desactivación de Album</h4>
			                </div>
			                <div class="modal-body">
			                    <p>Esta seguro que desea desactivar el Album</p>
			                    <p>Para continuar presione el boton Desactivar, si desea cancelar lo puede hacer presionando Cancelar</p>
			                </div>
			                <div class="modal-footer">
			                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			                    <a class="btn btn-warning btn-ok">Desactivar</a>
			                </div>
			            </div>
			        </div>
			    </div>
			    
			    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			        <div class="modal-dialog">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                    <h4 class="modal-title" id="myModalLabel">Confirmación de Eliminación</h4>
			                </div>
			                <div class="modal-body">
			                    <p>Esta seguro que desea eliminar el Album</p>
			                    <p>Para continuar presione el boton Elminar, si desea cancelar lo puede hacer presionando Cancelar</p>
			                </div>
			                <div class="modal-footer">
			                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			                    <a class="btn btn-danger btn-ok">Eliminar</a>
			                </div>
			            </div>
			        </div>
			    </div>		    
		    
		    <!-- FIN MODALS -->
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

<script type="text/javascript">

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

$('#confirm-activar').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

$('#confirm-desactivar').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

</script>

</body>
</html>
