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

    <title>Editar Album - Fotografo JM</title>

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
	$idAlbum = $_GET['id'];
	$sqlAlbum = "select * from albumes a where a.id = $idAlbum";
	$resultado = $mysqli->query($sqlAlbum);
	$fila = $resultado->fetch_assoc();
	
	$sqlFotos = "select * from fotos a where a.idAlbum = $idAlbum order by orden";
	$resFotos = $mysqli->query($sqlFotos);
	$canFotos = $resFotos->num_rows;
	
	?>
	
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Album "<?php echo $fila['titulo']?>"</h1>
                </div>
                <form id="albumedit-form" action="album.editar.guardar.php?id=<?php echo $fila['id']?>" method="post" role="form">
                	<div class="form-group">
						<label>Titulo</label><input value="<?php echo $fila['titulo']?>" type="text" name="titulo" id="titulo" tabindex="1" class="form-control input-lg" required="required"  maxlength="15" placeholder="Titulo">
					</div>
					<div class="form-group">
						<label>Tipo</label>
						<select class="form-control" id="tipo" name="tipo">
							<?php $sqltipos = "select * from tipos";
								  $resultado = $mysqli->query($sqltipos);
		            			  while($filaTipo = $resultado->fetch_assoc()) { 
		            			  	 if($filaTipo['id'] == $fila['tipo']) {
		            			  	 	$selected = 'selected="selected"';
		            			  	 } else {
		            			  	 	$selected = '';
		            			  	 }?>
									 <option value='<?php echo $filaTipo['id'] ?>' <?php echo $selected?>><?php echo $filaTipo['descripcion']?></option>
							<?php } ?>
						</select>
					</div>			
					
					<h1 class="page-header">Fotografias</h1>
					<div class="form-group">
					   <?php if (isset($_GET['result'])) {
								if ($_GET['result'] == 0) {?>
									<div class="alert alert-success" id="file-error">Se subio correctamente la foto</div>
						<?php 	}
							 }
							 if ($canFotos < 30) { ?>
								<div class="alert alert-danger" id="file-error" style="display: none"></div>
								<div class="form-group">
									<label>Agregar Fotografia</label>
									<input type="file" id="file" name="file" class="form-control" />
								</div>
								<div class="form-group">
									<label>Titulo</label>
									<input type="text" id="tituloFoto" name="tituloFoto" class="form-control" />
								</div>
								<div class="form-group">
									<label>Descripcion</label>
									<textarea style='resize: none' id="descripFoto" name="descripFoto" class="form-control" ></textarea>
								</div>
								<div class="form-group">
									<input type="button" disabled="disabled" name="subirfoto" id="subirfoto" tabindex="4" class="btn btn-primary" value="Agregar">
								</div>
						<?php } else { ?>
								<div class="alert alert-warning">No se puede agregar mas fotos a este Album</div>
						<?php }?>
					</div>
					<label style="margin-top: 15px">Fotografias del Album [<?php echo $canFotos?>]</label>
					
					<div class="form-group">
						<table class="table" id="fotografias" style="margin-bottom: 15px">
							<thead>
								<th></th>
								<th>Orden</th>
								<th>Foto</th>
								<th>Portada</th>
								<th>Titulo</th>
								<th>Descripcion</th>
							</thead>
							<tbody>
						<?php while($foto = $resFotos->fetch_assoc()) { 
								if ($foto['id'] == $fila['idPortada']) {
									$checked = "checked='checked'";
									$disabled = "style='display: none'";
								} else {
									$checked = "";
									$disabled = "";
								}?>
							    <tr>
							    	<td style="vertical-align: inherit; font-size: 25px">
							    		<a href="#" <?php echo $disabled ?> data-toggle="modal" data-href="album.editar.deletefoto.php?id=<?php echo $foto['id']?>&path=<?php echo $foto['path']?>&idAlbum=<?php echo $fila['id']?>&orden=<?php echo $foto['orden']?>" data-target="#confirm-delete" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
							    	</td>
							    	<td style="vertical-align: inherit; font-size: 20px">
							    		<input name='orden' value="<?php echo $foto['orden']?>" type='text' size='1' style="display: none">
							    		<?php 		    			
							    			if ($canFotos > 1) {
							    				$fechaUp = "<a href='album.editar.upfoto.php?id=".$foto['id']."&idAlbum=".$fila['id']."&orden=".$foto['orden']."'><span class='glyphicon glyphicon-arrow-up'></span></a>";
							    				$fechaDown = "<a href='album.editar.downfoto.php?id=".$foto['id']."&idAlbum=".$fila['id']."&orden=".$foto['orden']."'><span class='glyphicon glyphicon-arrow-down'></span></a>";
							    				$flechas = $fechaUp.$fechaDown;
								    			if ($foto['orden'] == 1) {
								    				$flechas = $fechaDown;
								    			}
								    			if ($foto['orden'] == $canFotos) {
								    				$flechas = $fechaUp;
								    			}
								    			echo $flechas;
							    			}
							    		?>
							    	</td>
							    	<td><img class='img-thumbnail'  src="<?php echo "../".$foto['path']?>" width='150' height='150'></td>
							    	<td><input name='portada' value="<?php echo $foto['id']?>" type='radio' <?php echo $checked ?>></td>
							    	<td><input value="<?php echo $foto['titulo'] ?>" class='form-control' type='text' id='titulo-<?php echo $foto['id']?>' name='titulo-<?php echo $foto['id']?>'  maxlength='15' size='10'/></td>
							    	<td width="45%"><textarea style='resize: none' class='form-control' id='descripcion-<?php echo $foto['id']?>' name='descripcion-<?php echo $foto['id']?>' rows='5'/><?php echo $foto['bajada']?></textarea>
							    </tr>
						<?php }?>
							</tbody>
						</table>
					</div>
					<div class="form-group">
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
	$(document).ready(function () {
	    $("#albumedit-form").submit(function () {
	        $("#albumedit-submit").attr("disabled", true);
	        return true;
	    });
	});

	
	$('#confirm-delete').on('show.bs.modal', function(e) {
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});

	
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

    $("#subirfoto").click(function(){
    	$("#subirfoto").prop('disabled', true);
    	var inputFileImage = document.getElementById("file");
    	var foto = inputFileImage.files[0];
    	var data = new FormData();
    	data.append('foto',foto);
    	data.append('desc',$("#descripFoto").val());
    	data.append('titu',$("#tituloFoto").val());
		$.ajax({
			url: "album.editar.addfoto.php?id=<?php echo $idAlbum ?>&canfotos=<?php echo $canFotos?>",
			type: "POST",
			contentType:false,
			data:data,
			processData:false,
			cache:false
		}).done(function(respuesta){
			if (respuesta != 0) {
				$('#file-error').html("No se pueden subir la foto. Intente mas tarde");
    			$('#file-error').show();
    			$("#file").val("");
			} else {
				var redire =  "album.editar.php?id=<?php echo $idAlbum ?>&result="+respuesta;
				window.location.href = redire;
			}
		});
	});

	
});

		

</script>

</body>
</html>
