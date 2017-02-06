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

    <title>Perfil - Fotografo JM</title>

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
         $sqlPerfil = "select * from usuarios where id = '".$_SESSION ['id']."'";
		 $resultado = $mysqli->query($sqlPerfil);
		 $fila = $resultado->fetch_assoc();
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pefil de Usuario</h1>
                </div>
            </div>
            <div class="alert alert-danger" id="perfil-error" style="display: none"></div>
			<div class="alert alert-success" id="perfil-ok" style="display: none"></div>
            <form id="perfil-form" method="post" role="form" style="display: block;">
            	<div class="form-group">
					<label>Usuario</label><input type="text" name="username" id="username" tabindex="1" class="form-control" required="required" placeholder="Usuario" value="<?php echo $fila['username'] ?>">
				</div>
				<div class="form-group">
					<label>Nombre</label><input type="text" name="nombre" id="nombre" tabindex="1" class="form-control" required="required" placeholder="Nombre" value="<?php echo  $fila['nombre'] ?>">
				</div>
            	<div class="form-group">
					<label>Email</label><input type="email" name="email" id="email" tabindex="1" class="form-control" required="required" placeholder="Email" value="<?php echo $fila['email'] ?>">
				</div>
				<div class="form-group">
					<input type="submit" name="perfil-submit" id="perfil-submit" tabindex="4" class="btn btn-primary" value="Guardar">
				</div>
            </form>
			
			<div class="row">
				<div class="col-lg-12">
                    <h1 class="page-header">Cambio de Contraseña</h1>
                </div>
            </div>
			<div class="alert alert-danger" id="change-error" style="display: none"></div>
			<div class="alert alert-success" id="change-ok" style="display: none"></div>
			<form id="change-form" method="post" role="form" style="display: block;">
            	<div class="form-group">
					<label>Contraseña Actual</label><input type="password" name="passold" id="passold" tabindex="1" class="form-control" required="required" placeholder="Contraseña Actual">
				</div>
				<div class="form-group">
					<label>Nueva Contraseña</label><input type="password" name="newpass" id="newpass" tabindex="1" class="form-control" required="required" placeholder="Nueva Contraseña">
				</div>
            	<div class="form-group">
					<label>Repita Nueva Contraseña</label><input type="password" name="repetnewpass" id="repetnewpass" tabindex="1" class="form-control" required="required" placeholder="Repita Nueva Contraseña">
				</div>
				<div class="form-group">
					<input type="submit" name="change-submit" id="change-submit" tabindex="4" class="btn btn-primary" value="Cambiar Contraseña">
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

<script type="text/javascript">
		$("#perfil-form").submit(
				function(event) {
					$("body").css("cursor", "progress");
					$("#perfil-submit").prop('disabled', true);
					$('#perfil-error').hide();
					$('#perfil-ok').hide();
					var username = $('#username').val();
					var nombre = $('#nombre').val();
					var email = $('#email').val();
					$.post("perfilGuardar.php", {
						username : username,
						nombre : nombre,
						email : email
					}, function(data) {
						$("body").css("cursor", "default");
						if (data == 1) {
							$('#perfil-ok').html("Se ha actualizado la información del perfil correctamente,");
							$('#perfil-ok').show();
						} else {
							$('#perfil-error').html("No se ha podido acutalizar la información del perfil. Por favor intentelo mas tarde.");
							$('#perfil-error').show();
						}
						$("#perfil-submit").prop('disabled', false);
					});
					return false;
				});

		$("#change-form").submit(
				function(event) {
					$('#change-error').hide();
					$('#change-ok').hide();
					var passold = $('#passold').val();
					var newpass = $('#newpass').val();
					var repetnewpass = $('#repetnewpass').val();
					if (newpass != repetnewpass) {
						$('#change-error').html("No se ha podido cambiar la contraseña. Las contraseñas no coinciden.");
						$('#change-error').show();
					} else {
						$("body").css("cursor", "progress");
						$("#change-submit").prop('disabled', true);
						$.post("perfilChange.php", {
							passold : passold,
							newpass : newpass,
							repetnewpass : repetnewpass
						}, function(data) {
							$("body").css("cursor", "default");
							if (data == 1) {
								$('#change-ok').html("Se ha cambiado la contraseña correctamente.");
								$('#change-ok').show();
							} else {
								$('#change-error').html("No se ha podido cambiar la contraseña. La contraseña no es correcta.");
								$('#change-error').show();
							}
							$("#change-submit").prop('disabled', false);
						});
					}
					$('#passold').val("");
					$('#newpass').val("");
					$('#repetnewpass').val("");
					return false;
				});
</script>

</body>
</html>
