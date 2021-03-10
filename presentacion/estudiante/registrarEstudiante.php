<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();
include 'presentacion/mnuAdministrador.php';

$nombre = "";
$apellido = "";
$codigo = "";
$mail = "";
$pass = "";
if (isset($_POST["registrar"])) { 
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $codigo = $_POST["codigo"];
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];

    $estudiante = new Estudiante ("", $nombre." ".$apellido, $codigo, $mail, $pass);
    if(!$estudiante -> existeCorreo()){
        $estudiante -> registrar();
        $mensaje="Estudiante registrado con exito";

        echo '<div id="alert" class="fixed-top alert alert-success alert-dismissible fade show" role ="alert" style=" position: absolute;">
                '.$mensaje.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
          </div>'; 
                  
    }else{
        $mensaje="Este correo electronico ya existe!";

        echo '<div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
                '.$mensaje.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
          </div>'; 
    }
}
$preview="https://st2.depositphotos.com/1462603/9536/v/950/depositphotos_95365896-stock-illustration-cinema-icon-vector-illustration.jpg";
?>
<br/><br/><br/><br/><h1 class="display-3">Nuevo Estudiante</h1><br/>

<div class="container">
    <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/estudiante/registrarEstudiante.php") ?> method="post">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="required" value="<?php echo $nombre; ?>">
        </div>
        <div class="form-group">
            <input type="text" name="apellido" class="form-control" placeholder="Apellido" required="required" value="<?php echo $apellido; ?>">
        </div>
        <div class="form-group">
            <input type="text" name="codigo" class="form-control" placeholder="Codigo Estudiantil" required="required" value="<?php echo $codigo; ?>">
        </div>
        <div class="form-group">
            <input type="email" name="mail" class="form-control" placeholder="Correo" required="required" value="<?php echo $mail; ?>">
        </div>
        <div class="form-group">
            <input type="password" name="pass" class="form-control" placeholder="Clave" required="required" >
        </div>        
        <button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
        <a class="btn btn-primary" href="index.php?pid=<?php echo base64_encode("presentacion/estudiante/consultarEstudiante.php")?>" role="button">Atras</a>
	</form>
</div>
