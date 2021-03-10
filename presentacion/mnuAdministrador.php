<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand"  href="index.php?pid=.<?php echo base64_encode("presentacion/sesionAdministrador.php")?>">
    <i class="fas fa-microscope"></i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="index.php?pid=<?php echo base64_encode("presentacion/estudiante/consultarEstudiante.php")?>">Estudiantes</a>
      <a class="nav-item nav-link" href="index.php?pid=<?php echo base64_encode("presentacion/profesor/consultarProfesor.php")?>">Docentes</a>
    </div> 

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNavAltMarkup">
        <ul class="navbar-nav ml-auto">
                <br/>
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Administrador:<?php echo $administrador -> getCorreo()?></a>
                <a class="nav-item nav-link" href="index.php?salir=1" >Cerrar Sesion</a>
        </ul>
    </div>      
  </div>
</nav>