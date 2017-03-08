<?php include_once ("include/control.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nueva Entrada - Fotografo JM</title>

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
                    <h1 class="page-header">Nueva Entrada</h1>
                </div>
            </div>
            <form id="blog-form" action="blog.nuevo.guardar.php" method="post" role="form" enctype="multipart/form-data">
            	<div class="form-group">
					<label>Titulo</label><input type="text" name="titulo" id="titulo" tabindex="1" class="form-control input-lg" required="required"  maxlength="50" placeholder="Titulo">
				</div>
				<div class="form-group">
					<label>Texto</label><textarea style="resize: none" class="form-control" id="texto" name="texto" rows="5" required="required"></textarea>
				</div>      

                <div class="alert alert-danger" id="file-error" style="display: none"></div>
                <label>Fotografia</label><input type="file" id="file" name="file" class="form-control" />
				
           		<div class="form-group" style="margin-top: 15px">
					<input type="submit" name="blog-submit" id="album-submit" tabindex="4" class="btn btn-primary" value="Guardar">
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
    	$('#file-error').hide();
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
            } 
    	}
	});
});
</script>

</body>
</html>
