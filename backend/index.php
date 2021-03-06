<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Administrador - Fotografo JM</title>

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
				<a class="navbar-brand" href="#">Administrador - Fotografo JM</a>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-login">
						<div class="panel-heading">
							<div class="row">
								<h3>Ingreso</h3>
							</div>
							<hr>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form id="login-form" action="#" method="post" role="form" style="display: block;">
										<div class="alert alert-danger" id="login-error" style="display: none"></div>
										<div class="form-group">
											<input type="text" name="username" id="username" tabindex="1" class="form-control" required="required" placeholder="Usuario" value="">
										</div>
										<div class="form-group">
											<input type="password" name="password" id="password" required="required" tabindex="2" class="form-control" placeholder="Contraseña">
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Ingresar">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-lg-12">
													<div class="text-center">
														<a href="recover.php" tabindex="5" class="forgot-password">¿Olvidó su contraseña?</a>
													</div>
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

	<script type="text/javascript">
		$("#login-form").submit(
				function(event) {
					$("body").css("cursor", "progress");
					$("#login-submit").prop('disabled', true);
					$('#login-error').hide();
					var username = $('#username').val();
					var password = $('#password').val();
					$.post("index.verifica.php", {
						username : username,
						password : password
					}, function(data) {
						$("body").css("cursor", "default");
						if (data == 1) {
							window.location = "album.php";
						} else {
							$('#login-error').html("Error en usuario y/o contrase&ntilde;a");
							$('#login-error').show();
							$("#login-submit").prop('disabled', false);
						}
					});
					return false;
				});
	</script>

</body>
</html>
