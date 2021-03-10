<?php
$mail="";
if(isset($_POST['mail'])){
  $mail=$_POST['mail'];
}
$pass="";
if(isset($_POST['pass'])){
  $pass=$_POST['pass'];
}
$error=0;
if(isset($_POST['autenticar'])){
  $administrador = new Administrador("", "" , $mail, $pass);
  $profesor = new Profesor("", "" , $mail, $pass);
  $estudiante = new Estudiante("", "" ,"", $mail, $pass);
    if($administrador -> autenticar()){
        $_SESSION['id'] = $administrador -> getId();
        $pid= base64_encode("presentacion/sesionAdministrador.php");
        header('Location: index.php?pid=' . $pid);
    }
    else if( $profesor -> autenticar()){    
        $_SESSION['id'] = $profesor -> getId();
        $pid= base64_encode("presentacion/profesor/sesionProfesor.php");
        header('Location: index.php?pid=' . $pid);
    }
    else if($estudiante -> autenticar()){
        $_SESSION['id'] = $estudiante -> getId();
        $pid= base64_encode("presentacion/estudiante/sesionEstudiante.php");
        header('Location: index.php?pid=' . $pid);
    }else{      
        $error=1;
    }
}

if($error==1){
    echo '
          <div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
            Error: Email o Contraseña invalidos
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>        
        ';        
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand"  href="index.php">
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
                <a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Iniciar Sesion</a>
                <a class="nav-item nav-link" href="#" >Registrarse</a>
        </ul>
    </div>      
  </div>
</nav>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="index.php">
        <div class="modal-body">
                <div class="form-group">
                  <input type="email" name="mail" class="form-control" placeholder="Correo*" required="required">
                </div>
                <div class="form-group">
                  <input type="password" name="pass" class="form-control" placeholder="Clave*" required="required">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button name="autenticar" type="submit" class="btn btn-primary">Autenticar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div>
  <div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://files.stocky.ai/uploads/2019/05/image-Happy-students-working-together-in-the-computer-room-stocky-ai-10420602.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://previews.123rf.com/images/ammentorp/ammentorp1403/ammentorp140300141/27147687-diverse-group-of-students-using-computer-for-finding-information-for-their-academic-project-happy-yo.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://media.gettyimages.com/photos/happy-students-in-computer-class-picture-id170507140" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>



  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Hello, world!</h1>
      <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div>
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div>
      <div class="col-md-4">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div>
    </div>

  </div> <!-- /container -->

</div>