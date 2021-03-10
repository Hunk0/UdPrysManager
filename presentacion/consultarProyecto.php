<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();


$titulo;
$descripccion;
$pdf;
$estado;
$tutor;
$jurado;
if(isset($_GET["idDoc"])){
    $proyecto = new Proyecto($_GET["idDoc"]);
    $proyecto -> consultar();
    $titulo=$proyecto->getTitulo();
    $descripccion=$proyecto->getDescripccion();
    $pdf=$proyecto->getPdf();
    $estado=$proyecto->getEstado();
    $estadocod=$proyecto->getEstadoId();

    $tutor=new Tutor($proyecto->getTutorId());
    $tutor->consultar();
    $tutores = $tutor->consultarTodos();

    $jurado=new Jurado($proyecto->getJuradoId());
    $jurado->consultar();
    $jurados = $jurado->consultarTodos();    
}
if(isset($_POST["registrar"])){
    $idtutor=$_POST["tutor"];
    $idjurado=$_POST["jurado"];
    if($estadocod<2){

        if($idjurado!=""){
            echo '<div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
                    El proyecto no ha sido revisado por un tutor, no puedes hacer eso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
              </div>'; 
        }        

        if($idtutor!=$proyecto->getTutorId()){
            if($estadocod>=2 && $idtutor!=""){
                echo   '<div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
                            Este proyecto ya ha sido revisado por otro tutor, no puedes hacer eso!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'; 
            }else{
                $estadocod=1;
                $proyecto = new Proyecto($_GET["idDoc"],"","","",$estadocod,$idtutor,"");
                $proyecto ->actualizar();
                echo '<div id="alert" class="fixed-top alert alert-success alert-dismissible fade show" role ="alert" style=" position: absolute;">
                        Tutor designado con exito
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                  </div>'; 
            }
        }
        
    }else{
        if($idtutor!=$tutor->getId()){
            echo '<div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
                    Ya existe un tutor a cargo de este proyecto
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>'; 
        }

        if($idjurado!=""){
            if($estadocod==4){
                if($idjurado!=$jurado->getId()){
                    echo '<div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
                            Otro jurado ya ha aprovado este proyecto.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'; 
                }                
            }else{
                $estadocod=3;
                $proyecto = new Proyecto($_GET["idDoc"],"","","",$estadocod,$tutor->getId(),$idjurado);
                $proyecto ->actualizar();
                echo '<div id="alert" class="fixed-top alert alert-success alert-dismissible fade show" role ="alert" style=" position: absolute;">
                        Jurado designado con exito
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>'; 
            }            
        }        
    }
    //REVISAR!
    //$estadocod;
    //($estadocod<=1)?$estadocod=1:"";
    //($idjurado!=$jurado->getId())?$estadocod=3:"";
    //$proyecto = new Proyecto($_GET["idDoc"],"","","",$estadocod,$idtutor,$idjurado);
    //$proyecto ->actualizar();
}

include 'presentacion/mnuAdministrador.php';
?>

<script>
    function abrir() {
        window.open(<?php echo "'documentos/".$proyecto->getPdf()."'"?>, '_blank');
    }
</script>


<br/>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col col-lg-4">  
        <br/><br/><br/><br/><br/><br/>  
        <label data-toggle='tooltip' onclick="abrir()" data-placement='bottom' title='Descargar Documento' style="cursor: pointer;">
            <img class="foto" src="https://store-images.s-microsoft.com/image/apps.34961.13510798887621962.47b62c4c-a0c6-4e3c-87bb-509317d9c364.a6354b48-c68a-47fa-b69e-4cb592d42ffc?mode=scale&q=90&h=300&w=300"  style="width: 200px "/>
        </label>  
    </div>

    <div class="col col-lg-8">
        <br/>
        <div class="modal-header">
            <h1 class="display-4"><?php echo $titulo?></h1>
        </div> 

        <div class="row">
            <br/>
            <div class="col">
            <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/consultarProyecto.php") . "&idDoc=" . $_GET["idDoc"] ?> method="post">
                <small class="text-muted"><br/></small>
                <h3><small class="text-muted">Por: <?php echo $proyecto->getEstudiantes()?></small></h3>
                <small class="text-muted"><?php echo $estado?><br/><br/></small>                
                <p class="card-text"><h5 class="card-title">Descripccion:</h5><?php echo $descripccion?></p>
                <div class="row">
                    <div class="col">
                        <p class="card-text">
                            <h5 class="card-title">Tutor:</h5>
                            <select class="custom-select form-control" name="tutor">
                                <?php                          
                                        if($tutor->getId()!=""){
                                            foreach ($tutores as $t){
                                                if($t->getId() == $tutor->getId()){
                                                    echo "<option value='".$t->getId()."' selected>".$t->getNombre()."</option>";
                                                }else{
                                                    echo "<option value='".$t->getId()."'>".$t->getNombre()."</option>";
                                                }  
                                            }   
                                        }else{
                                            echo "<option value='' selected>Sin seleccionar</option>";
                                            foreach ($tutores as $t){
                                                echo "<option value='".$t->getId()."'>".$t->getNombre()."</option>"; 
                                            }
                                        }   
                                ?>
                            </select>
                        </p>
                    </div>
                    <div class="col">
                        <p class="card-text">
                            <h5 class="card-title">Jurado:    <i class="fas fa-question-circle" data-toggle='tooltip' data-placement='top' title='Solo se podra elegir jurado en cuanto el proyecto este revisado por un tutor' ></i></h5>
                            <select <?php echo ($estadocod<2)? "disabled=true":""; ?> class="custom-select form-control" name="jurado">
                                <?php     
                                    if($jurado->getId()!=""){
                                        foreach ($jurados as $j){
                                            if($j->getId() == $jurado->getId()){
                                                echo "<option value='".$j->getId()."' selected>".$j->getNombre()."</option>";
                                            }else{
                                                echo "<option value='".$j->getId()."'>".$j->getNombre()."</option>";
                                            }                                        
                                        } 
                                    }else{
                                        echo "<option value='' selected>Sin seleccionar</option>";
                                        foreach ($jurados as $j){
                                            echo "<option value='".$j->getId()."'>".$j->getNombre()."</option>"; 
                                        }
                                    }    

                                    
                                ?>
                            </select>
                        </p>
                    </div>
                </div>
                <br/>
                <button type="submit" name="registrar" class="btn btn-info">Guardar Cambios</button>
                <a class="btn btn-secondary" href="index.php?pid=<?php echo base64_encode("presentacion/estudiante/consultarEstudiante.php")?>" role="button">Atras</a>
                </form>
            </div> 
        </div>  

    </div>
</div>
