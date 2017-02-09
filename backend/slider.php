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

    <title>Slider - Fotografo JM</title>

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
                    <h1 class="page-header">Slider</h1>
                </div>
            </div>
			<?php
            	$sqlSlider = "SELECT s.*, f.path, a.titulo, a.activo FROM slider s, fotos f, albumes a WHERE s.idFoto = f.id and f.idAlbum = a.id order by s.orden";
				$resSlider = $mysqli->query($sqlSlider);
				$numSlider = $resSlider->num_rows;
				if ($numSlider == 0) { ?>
					<div class="alert alert-warning">En la actulidad no hay ninguna foto seleccionada para el slider de la home. Se mostraran las fotos por defecto</div>
		  <?php } else { ?>
		  			<label style="margin-top: 15px">Fotografias del Slider [<?php echo $numSlider?>]</label>
			  			<table class="table">
			  				<thead>
			  					<th></th>
			  					<th>Orden</th>
			            		<th>Foto</th>
			            		<th>Album</th>  
			            		<th>Estado</th>
			            	</thead>
			            	<tbody>
			  <?php 	$arraySlider = array();
			  			while($slider = $resSlider->fetch_assoc()) {
			  				$arraySlider[$slider['idFoto']] = $slider['idFoto']; ?>
			  					<tr>
			  						<td style="vertical-align: inherit; font-size: 25px">
							    		<a href="#" data-toggle="modal" data-href="slider.deletefoto.php?id=<?php echo $slider['idFoto']?>&orden=<?php echo $slider['orden']?>" data-target="#confirm-delete" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
							    	</td>
			  						<td style="vertical-align: inherit; font-size: 20px">
							    		<input name='orden' value="<?php echo $slider['orden']?>" type='text' size='1' style="display: none">
							    		<?php 		    			
							    			if ($numSlider > 1) {
							    				$fechaUp = "<a href='slider.upfoto.php?orden=".$slider['orden']."'><span class='glyphicon glyphicon-arrow-up'></span></a>";
							    				$fechaDown = "<a href='slider.downfoto.php?orden=".$slider['orden']."'><span class='glyphicon glyphicon-arrow-down'></span></a>";
							    				$flechas = $fechaUp.$fechaDown;
								    			if ($slider['orden'] == 1) {
								    				$flechas = $fechaDown;
								    			}
								    			if ($slider['orden'] == $numSlider) {
								    				$flechas = $fechaUp;
								    			}
								    			echo $flechas;
							    			}
							    		?>
							    	</td>
			  						<td><img src="../<?php echo $slider['path']?>" class="img-responsive" alt="Cinque Terre" style="width: 100px"/></td>
			  						<td><?php echo $slider['titulo']?></td>
			  						<td><?php if ($slider['activo'] == 1) { ?>
	                       	  				<span class="glyphicon glyphicon-ok" title="Activo" style="color: green; font-size: larger"></span>
	                       	  	 	 <?php } else { ?>
	                       	  	  			<span class="glyphicon glyphicon-remove" title="Inactivo" style="color: red; font-size: larger"></span>
	                       	  	  	<?php } ?>
	                       	  		</td>
			  					</tr>
			  <?php		} ?>
			  				</tbody>
			  			</table>
		 <?php  }
		  		$sqlFotos = "SELECT f.*, a.titulo, a.activo, t.descripcion FROM fotos f, albumes a, tipos t WHERE f.idAlbum = a.id and a.tipo = t.id order by a.id";
		  		$resFotos = $mysqli->query($sqlFotos);
		  		$numSlider = $resFotos->num_rows;
		  		if ($numSlider > 0) { ?>
		  		<div class="row">
	                <div class="col-lg-12">
	                    <h1 class="page-header">Fotografias</h1>
	                </div>
           		</div>
		  		<form id="slider-form" action="slider.guardar.php" method="post" role="form">
					  <table class="table">
		            	<thead>
		            		<th>Foto</th>
		            		<th>Album</th>  
		            		<th>Estado</th>
		            		<th>Tipo</th>
		            		<th></th>
		            	</thead>
		            	<tbody>
	             <?php while($foto = $resFotos->fetch_assoc()) { ?>
	                      <tr>
	                          <td><img src="../<?php echo $foto['path']?>" class="img-responsive" alt="Cinque Terre" style="width: 100px"/></td>
	                       	  <td><?php echo $foto['titulo']?></td>	
	                       	  <td><?php if ($foto['activo'] == 1) { ?>
	                       	  				<span class="glyphicon glyphicon-ok" title="Activo" style="color: green; font-size: larger"></span>
	                       	  	  <?php } else { ?>
	                       	  	  			<span class="glyphicon glyphicon-remove" title="Inactivo" style="color: red; font-size: larger"></span>
	                       	  	  <?php } ?>
	                       	  </td>
	                       	  <td><?php echo $foto['descripcion']?></td>
	                       	  <td>
	                       	  	  <?php if (in_array($foto['id'],$arraySlider)) {
	                       	  	  			$checked = "checked = 'checked'";
		  						  		} else {
		  						  			$checked = "";
		  						  		}
		  						  ?>	
	                       	  	  <input type="checkbox" name="foto-<?php echo $foto['id']?>" value="<?php echo $foto['id']?>" <?php echo $checked?>/>
	                       	  </td>
	                       </tr>
                  <?php } ?>
            			</tbody>
            		</table>
            		<div class="form-group">
						<input type="submit" name="slider-submit" id="slider-submit" tabindex="4" class="btn btn-primary" value="Guardar">
					</div>
           		</form>
            <?php } else { ?>
          			<div class="alert alert-warning">En la actulidad no hay ninguna fotos cargadas para seleccionar</div>
            <?php } ?>
        </div>
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
			   		<div class="modal-header">
			         	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			           	<h4 class="modal-title" id="myModalLabel">Confirmacion de Eliminacion de la Fotografia del Slider</h4>
			         </div>
			    	<div class="modal-body">
			        	<p>Esta seguro que desea eliminar la Fotografia del Slider</p>
			            <p>Para continuar presione el boton Elminar, si desea cancelar lo puede hacer presionando Cancelar</p>
			        </div>
			        <div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			            <a class="btn btn-danger btn-ok">Eliminar</a>
			        </div>
			     </div>
			</div>
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
	$(document).ready(function () {
	    $("#slider-form").submit(function () {
	        $("#slider-submit").attr("disabled", true);
	        return true;
	    });
	});

	$('#confirm-delete').on('show.bs.modal', function(e) {
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	
</script>

</body>
</html>
