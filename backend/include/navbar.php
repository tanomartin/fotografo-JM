<div class="navbar-header">
	<a class="navbar-brand" href="album.php">Fotografo JM</a>
</div>

<ul class="nav navbar-nav navbar-left navbar-top-links">
	<li><a href="../index.php" target="_blank"><i class="fa fa-home fa-fw"></i> Website</a></li>
	<li><a href="album.php"><i class="fa fa-picture-o fa-fw"></i> Albumes</a></li>
	<li><a href="slider.php"><i class="fa fa-exchange fa-fw"></i>Fotos Home</a></li>
</ul>

<ul class="nav navbar-right navbar-top-links">
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
        	<i class="fa fa-user fa-fw"></i><?php echo $_SESSION['name']?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu dropdown-user">
        	<li><a href="perfil.php"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a></li>
            <li class="divider"></li>
            <li><a href="clave.php"><i class="fa fa-key fa-fw"></i> Cambio de Contrasena</a></li>
            <li class="divider"></li>
            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
        </ul>
	</li>
</ul>