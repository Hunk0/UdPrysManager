<?php
  if($_SESSION['id']!=null){
    $profesor = new Profesor($_SESSION['id']);
    $profesor->consultar();
  }else{
    header("Location: index.php");
  }
  
?>


<nav class="navbar  navbar-expand-lg navbar-dark bg-primary" >
  <a class="navbar-brand"  href="index.php?pid=.<?php echo base64_encode("presentacion/profesor/sesionprofesor.php")?>">
    <i class="fas fa-microscope"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="nav-item dropdown">
        <div class="navbar-nav">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Proyectos asignados
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="index.php?pid=.<?php echo base64_encode("presentacion/profesor/consultaTutor.php")?>">Como Tutor</a>
                <a class="dropdown-item" href="index.php?pid=.<?php echo base64_encode("presentacion/profesor/consultaJurado.php")?>">Como Jurado</a>
            </div>
        </div>        
    </div>


    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNavAltMarkup">
        <ul class="navbar-nav ml-auto">
                <br/>
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Docente:<?php echo $profesor -> getCorreo()?></a>
                <a class="nav-item nav-link" href="index.php?salir=1" >Cerrar Sesion</a>
        </ul>
    </div>      
  </div>
</nav>
