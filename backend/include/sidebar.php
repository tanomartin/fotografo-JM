<?php 
$sqlAlbumesSlide = "select * from albumes a";
$resAlbumesSlide = $mysqli->query($sqlAlbumesSlide);
?>
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
    	<ul class="nav" id="side-menu">    
            <li><a href="slider.php"><i class="fa fa-exchange fa-fw"></i>Fotos Home</a></li>
            <li>
            	<a href="#" class="active"><i class="fa fa-file-text-o fa-fw"></i>Blog<span class="fa arrow"></span></a>
            	<ul class="nav nav-second-level">
            		<li><a href="blog.nuevo.php"><i class="fa fa-plus-circle"></i> Nueva Entrada</a></li>
            		<li><a href="blog.php"><i class="fa fa-file-text-o fa-fw"></i> Entradas</a></li>
            	</ul>
            </li>
            <li>
                <a href="#" class="active"><i class="fa fa-picture-o fa-fw"></i> Albumes<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                	<li><a href="album.nuevo.php"><i class="fa fa-plus-circle"></i> Nuevo Album</a></li>
                	<?php while($filaSlide = $resAlbumesSlide->fetch_assoc()) { ?>
                    	<li>
                            <a href="album.editar.php?id=<?php echo $filaSlide['id']?>" title="Editar"> <?php echo $filaSlide['titulo']?></a>
                        </li>
                	<?php } ?>
                </ul>
             </li>
         </ul>
    </div>
</div>