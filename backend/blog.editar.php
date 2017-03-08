<?php include_once ("include/control.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editar Blog - Fotografo JM</title>

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
	
	<?php 
	$idBlog = $_GET['id'];
	$sqlBlog = "select * from blog a where a.id = $idBlog";
	$resBlog = $mysqli->query($sqlBlog);
	$fila = $resBlog->fetch_assoc();
	?>
	
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Entrada "<?php echo $fila['titulo']?>"</h1>
                </div>
                <form id="blogedit-form" action="blog.editar.guardar.php?id=<?php echo $fila['id']?>" method="post" role="form" enctype="multipart/form-data">
                	<div class="form-group">
						<label>Titulo</label><input value="<?php echo $fila['titulo']?>" type="text" name="titulo" id="titulo" tabindex="1" class="form-control input-lg" required="required"  maxlength="15" placeholder="Titulo">
					</div>
					
					<div class="form-group">
						<label>Texto</label><textarea style="resize: none" class="form-control" id="texto" name="texto" rows="5" required="required"><?php echo $fila['texto'] ?></textarea>
					</div>	
								
					<div class="form-group">	
	                	<label>Fotografia</label>
	                	<div class="alert alert-danger" id="file-error" style="display: none"></div>
	                	<?php if ( $fila['path'] != NULL) { ?>
		                      <div style="font-size: 25px">
		                      	<a href="#" data-toggle="modal" data-href="blog.editar.deletefoto.php?id=<?php echo $fila['id']?>&path=<?php echo $fila['path']?>" data-target="#confirm-delete" title="Eliminar"><span class="glyphicon glyphicon-trash pull-left" style="margin-right: 10px"></span></a>
		                      	<img src="../<?php echo $fila['path']?>" class="img-responsive" alt="Cinque Terre" style="width: 100px"/>
		                      </div>
		                <?php } else { ?>
		                      <img src="../fotos/default/sinfoto.jpg" class="img-responsive" alt="Cinque Terre" style="width: 100px"/>
		                <?php } ?>
                		<input type="file" id="file" name="file" class="form-control" style="margin-top: 15px"/>
		            </div>
					<div class="form-group" style="margin-top: 15px">
						<input type="submit" name="albumedit-submit" id="albumedit-submit" tabindex="4" class="btn btn-primary" value="Guardar">
					</div>
                </form>
            </div>
            
             <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			 	<div class="modal-dialog">
			    	<div class="modal-content">
			        	<div class="modal-header">
			            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <h4 class="modal-title" id="myModalLabel">Confirmacion de Eliminacion de la Fotografia</h4>
			            </div>
			        	<div class="modal-body">
			            	<p>Esta seguro que desea eliminar la Fotografia</p>
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
$(function(){  
    $("#file").on("change", function(){
    	$('#file-error').hide();
    	$("#subirfoto").prop('disabled', true);
    	if ($("#file").val() != '') {
    		var inputFileImage = document.getElementById("file");
    		var foto = inputFileImage.files[0];
    		var size = foto.size;
    		var type = foto.type;
    		if (size > 512*1024) {
    			$('#file-error').html("No se pueden subir fotos de mas de 500 KB");
    			$('#file-error').show();
    			$("#file").val("");
	        } else if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png' && type != 'image/gif') {
	        	$('#file-error').html("El archivo es de un tipo no soportado por el sistema");
				$('#file-error').show();
				$("#file").val("");
            } else {
    			$("#subirfoto").prop('disabled', false);
	        }
    	}
	});


    $('#confirm-delete').on('show.bs.modal', function(e) {
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	
});
</script>

</body>
</html>
