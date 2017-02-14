<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Recuepero Contraseña - Fotografo JM</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="css/login.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Administrador - Fotografo JM</a>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-login">
						<div class="panel-heading">
							<div class="row">
								<h3>Recupero Contraseña</h3>
							</div>
							<hr>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form id="recover-form" action="#" method="post" role="form" style="display: block;">
										<div class="alert alert-danger" id="recover-error" style="display: none"></div>
										<div class="alert alert-success" id="recover-ok" style="display: none"></div>
										<div class="form-group">
											<input type="text" name="username" id="username" tabindex="1" class="form-control" required="required" placeholder="Usuario" value="">
										</div>
										<div class="form-group">
											<input type="email" name="email" id="email" required="required" tabindex="2" class="form-control" placeholder="Email">
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<input type="submit" name="recover-submit" id="recover-submit" tabindex="4" class="form-control btn btn-login" value="Recuperar">
												</div>
											</div>
										</div>
									</form>
								</div>
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
		$("#recover-form").submit(
				function(event) {
					$("body").css("cursor", "progress");
					$("#recover-submit").prop('disabled', true);
					$('#recover-error').hide();
					$('#recover-ok').hide();
					var username = $('#username').val();
					var email = $('#email').val();
					$.post("recover.verifica.php", {
						username : username,
						email : email
					}, function(data) {
						$("body").css("cursor", "default");
						if (data == 1) {
							$('#recover-ok').html("Se ha recuperado la contraseña correctamente. Revise su correo electróncio");
							$('#recover-ok').show();
						} else {
							$('#recover-error').html("Error en usuario y/o email. No se ha podido enviar la contraseña");
							$('#recover-error').show();
						}
						$("#recover-submit").prop('disabled', false);
					});
					return false;
				});
	</script>

</body>
</html>
