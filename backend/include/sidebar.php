<?php 
$sqlAlbumes = "select * from albumes a, portadas p where a.id=p.id";
$resultado = $mysqli->query($sqlAlbumes);
?>
<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">    
                    <li>
                        <a href="#" class="active"><i class="fa fa-picture-o fa-fw"></i> Albumes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php while($fila = $resultado->fetch_assoc()) { ?>
                            <li>
                                <a href="#"><?php echo $fila['nombre']?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>