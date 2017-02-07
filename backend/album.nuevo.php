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

    <title>Nuevo Album - Fotografo JM</title>

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
                    <h1 class="page-header">Nuevo Album</h1>
                </div>
            </div>
            <form id="album-form" action="album.nuevo.guardar.php" method="post" role="form" enctype="multipart/form-data">
            	<div class="form-group">
					<label>Titulo</label><input type="text" name="titulo" id="titulo" tabindex="1" class="form-control input-lg" required="required"  maxlength="15" placeholder="Titulo">
				</div>
				
				<div class="form-group">
					<label>Tipo</label>
					<select class="form-control" id="tipo" name="tipo">
					<?php $sqltipos = "select * from tipos";
						  $resultado = $mysqli->query($sqltipos);
            			  while($fila = $resultado->fetch_assoc()) { ?>
							 <option value='<?php echo $fila['id'] ?>' selected="selected"><?php echo $fila['descripcion']?></option>
					<?php } ?>
					</select>
				</div>
	            
                <h1 class="page-header">Fotografias</h1>
                <div class="alert alert-danger" id="file-error" style="display: none"></div>
                <input type="file" id="file" name="file[]" class="form-control" required="required"  multiple />
                
                <h3 id="titlePrevia" style="display: none">Vista Previa</h3>
                <table class="table" id="vista-previa" style="margin-bottom: 15px"></table>
                
                <h3 id="titleProblemas" style="display: none">Archivo con problemas</h3>
                <table class="table" id="problemas"></table>
                
           		<div class="form-group">
					<input type="submit" name="album-submit" id="album-submit" tabindex="4" class="btn btn-primary" value="Guardar">
				</div>
            </form>
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

<script>
$(function(){  
    $("#file").on("change", function(){
    	/* Limpiar vista previa */
        $("#vista-previa").html('');
        $("#problemas").html('');
        $("#titlePrevia").hide();
        $('#file-error').hide();
        $("#titleProblemas").hide();
        var archivos = document.getElementById('file').files;
        var navegador = window.URL || window.webkitURL;
		var limite = 30;
       	 
		if (archivos.length > limite) {
			$('#file-error').html("No se pueden subir mas de 30 fotos por album");
			$('#file-error').show();
			$("#file").val("");
		} else {    
	        /* Recorrer los archivos */
	        var nrofoto = 0;
	        for(x=0; x<archivos.length; x++) {
	            /* Validar tama�o y tipo de archivo */
	            var size = archivos[x].size;
	            var type = archivos[x].type;
	            var name = archivos[x].name
	            if (size > 512*1024) {
	             	$("#titleProblemas").show();
	              	$("#problemas").append("<tr><td>El archivo "+name+" supera el maximo permitido 500KB</tr></td>");
	              	nroprob++;
	            }
	          	else if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png' && type != 'image/gif') {
	          		$("#titleProblemas").show();
	            	$("#problemas").append("<tr><td>El archivo "+name+" no es del tipo de imagen permitida.</tr></td>");
	            	nroprob++;
	            }
	            else {
	            	$("#titlePrevia").show();
	            	
	              	var objeto_url = navegador.createObjectURL(archivos[x]);
	              	var linea = "<tr><td><img class='img-thumbnail'  src="+objeto_url+" width='150' height='150'>";
	             	if (nrofoto == 0) {
						var cabecera = "<thead><th>Foto</th><th>Portada</th><th>Descripcion</th></thead><tbody>"
						$('#vista-previa').append(cabecera);
						linea += "<td><input name='portada' value="+nrofoto+" type='radio' checked='checked'></td>";
	             	} else {
	             		linea += "<td><input name='portada' value="+nrofoto+" type='radio'></td>";
	             	}
	             	linea += "<td width='75%'><input class='form-control input-lg' type='text' id='descrip"+nrofoto+"' name='descrip"+nrofoto+"'  maxlength='30'/></td></tr>";
	             	$('#vista-previa').append(linea);	
	             	nrofoto++;
	            }
	        }
	        var fin = "</tbody>";
	        $('#vista-previa').append(fin);
		}
    });
});



</script>

</body>
</html>
