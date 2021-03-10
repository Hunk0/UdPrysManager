<?php
  if($_SESSION['id']!=null){
    $estudiante = new Estudiante($_SESSION['id']);
    $estudiante->consultar();
  }else{
    header("Location: index.php");
  }
  
?>


<nav class="navbar  navbar-expand-lg navbar-dark bg-info" >
  <a class="navbar-brand"  href="index.php?pid=.<?php echo base64_encode("presentacion/estudiante/sesionEstudiante.php")?>">
    <i class="fas fa-microscope"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    </div> 

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNavAltMarkup">
        <ul class="navbar-nav ml-auto">
                <br/>
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Estudiante:<?php echo $estudiante -> getCorreo()?></a>
                <a class="nav-item nav-link" href="index.php?salir=1" >Cerrar Sesion</a>
        </ul>
    </div>      
  </div>
</nav>

