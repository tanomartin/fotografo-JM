 <div class="navbar-header">
            <a class="navbar-brand" href="menu.php">Administrador - Fotografo JM</a>
        </div>
 
 <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="../index.html" target="_blank"><i class="fa fa-home fa-fw"></i> Website</a></li>
            <li><a href="menu.php"><i class="fa fa-picture-o fa-fw"></i> Albumes</a></li>
        </ul>
 
 <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['name']?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="perfil.php"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                    </li>
                </ul>
            </li>
        </ul>