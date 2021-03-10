<?php
require_once 'logica/Persona.php';
require_once 'logica/Proyecto.php';
require_once 'logica/Tutor.php';
require_once 'logica/Jurado.php';


$titulo;
$descripccion;
$pdf;
$estado;
$estadocod;
$tutor;
$jurado;
if(isset($_GET["idDoc"])){
    $proyecto = new Proyecto($_GET["idDoc"]);
    $proyecto -> consultar();
    $titulo=$proyecto->getTitulo();
    $descripccion=$proyecto->getDescripccion();
    $pdf;
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
    //REVISAR!
    $estadocod;
    ($idtutor!=$tutor->getId() & $jurado->getId()=="" )?$estadocod=1:"";
    ($idjurado!=$jurado->getId())?$estadocod=3:"";
    $proyecto = new Proyecto($_GET["idDoc"],"","","",$estadocod,$idtutor,$idjurado);
    $proyecto ->actualizar();
}

?>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>


<div class="container">
  <div class="row justify-content-md-end">
    <div class="col col-lg-4">  
        <br/><br/><br/>
        <label data-toggle='tooltip' onclick="abrir()" data-placement='top' title='Visualizar Documento' style="cursor: pointer;">
            <img class="foto" src="https://store-images.s-microsoft.com/image/apps.34961.13510798887621962.47b62c4c-a0c6-4e3c-87bb-509317d9c364.a6354b48-c68a-47fa-b69e-4cb592d42ffc?mode=scale&q=90&h=300&w=300"  style="width: 300px "/>
        </label>  
    </div>

    <div class="col col-lg-8">
        <h1 class="display-4"><?php echo $titulo?></h1>
        <hr>

        <div class="row">
            <div class="col">      
                <small class="text-muted"><br/></small>
                <h3><small class="text-muted">Por: <?php echo $proyecto->getEstudiantes()?></small></h3>
                <small id="modalstatus" class="text-muted"><?php echo $estado?></small><br/><br/>                
                <p class="card-text"><h5 class="card-title">Descripccion:</h5><?php echo $descripccion?></p>
                <br/><hr>
                <?php
                    if(isset($_GET["usuario"])){
                        //administrador
                        if($_GET["usuario"]==0){
                                                        
                        }
                        //tutor
                        if($_GET["usuario"]==1){
                            if($estadocod>=2){
                                if($estadocod==2){
                                  echo '<div class="custom-control custom-switch">
                                                <input type="checkbox" checked class="custom-control-input" id="estadoTutor">
                                                <label class="custom-control-label" id="estado" for="estadoTutor" >Revisado</label>
                                        </div>';
                                }else{
                                  echo '<div class="custom-control custom-switch">
                                                <input type="checkbox" checked class="custom-control-input" id="estadoTutor" disabled>
                                                <label class="custom-control-label" id="estado" for="estadoTutor" >Revisado</label>
                                        </div>';
                                }
                              }else{
                                  echo '<div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="estadoTutor">
                                            <label class="custom-control-label" id="estado" for="estadoTutor" >Sin revisar</label>
                                        </div>';
                            }
                            
                        }
                        //jurado
                        if($_GET["usuario"]==2){
                            if ($estadocod==3){
                                echo '<div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="estadoJurado">
                                        <label class="custom-control-label" id="estado" for="estadoJurado" >Sin aprobar</label>
                                      </div>';
                            }else if($estadocod==4){
                                echo '<div class="custom-control custom-switch">
                                        <input type="checkbox" checked class="custom-control-input" id="estadoJurado">
                                        <label class="custom-control-label" id="estado" for="estadoJurado" >Aprobado</label>
                                      </div>';
                            }                            
                        }
                        //estudiante
                        if($_GET["usuario"]==3){
                        
                        }
                    }
                ?>
                <br/> 
            </div> 
        </div>  

    </div>
</div>

<script type="text/javascript">
     var estado=<?php echo $proyecto->getEstadoId()?>;
     
     $('#estadoTutor').on('change.bootstrapSwitch', function (e, state) {
        //console.log(e.target.checked);
        //alert(<?php echo $_GET["idDoc"] ?>);        

        if (e.target.checked == true) {
            document.getElementById("estado").innerHTML = "Revisado";
            estado=estado+1;
            status = "<span class='fas fa-check-circle' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Rechazar'></span>";
            <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idDoc=" . $_GET["idDoc"] . "&estado=\"+estado ;\n"; ?>
		    $("#modalstatus").load(ruta);
            $(<?php echo '"#cambiarEstado'.$_GET["idDoc"].'"'?>).html(status);
            $(<?php echo '"#tablestatus'.$_GET["idDoc"].'"'?>).load(ruta);
        } else {            
            document.getElementById("estado").innerHTML = "Sin revisar";
            estado=estado-1;
            status = "<span class='fas fa-check-circle' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Aprobar' style='color: #7e848a;'></span>";
            <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idDoc=" . $_GET["idDoc"] . "&estado=\"+estado ;\n"; ?>
		    $("#modalstatus").load(ruta);
            $(<?php echo '"#cambiarEstado'.$_GET["idDoc"].'"'?>).html(status);
            $(<?php echo '"#tablestatus'.$_GET["idDoc"].'"'?>).load(ruta);
        }
    });
</script>

<script type="text/javascript">
     var estado=<?php echo $proyecto->getEstadoId()?>;
     
     $('#estadoJurado').on('change.bootstrapSwitch', function (e, state) {
        //console.log(e.target.checked);
        //alert(<?php echo $_GET["idDoc"] ?>);        

        if (e.target.checked == true) {
            document.getElementById("estado").innerHTML = "Aprobado";
            estado=estado+1;
            status = "<span class='fas fa-check-circle' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Rechazar'></span>";
            <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idDoc=" . $_GET["idDoc"] . "&estado=\"+estado ;\n"; ?>
		    $("#modalstatus").load(ruta);
            $(<?php echo '"#cambiarEstado'.$_GET["idDoc"].'"'?>).html(status);
            $(<?php echo '"#tablestatus'.$_GET["idDoc"].'"'?>).load(ruta);
        } else {            
            document.getElementById("estado").innerHTML = "Sin aprobar";
            estado=estado-1;
            status = "<span class='fas fa-check-circle' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Aprobar' style='color: #7e848a;'></span>";
            <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idDoc=" . $_GET["idDoc"] . "&estado=\"+estado ;\n"; ?>
		    $("#modalstatus").load(ruta);
            $(<?php echo '"#cambiarEstado'.$_GET["idDoc"].'"'?>).html(status);
            $(<?php echo '"#tablestatus'.$_GET["idDoc"].'"'?>).load(ruta);
        }
    });
</script>

<script>
    function abrir() {
        window.open(<?php echo "'documentos/".$proyecto->getPdf()."'"?>, '_blank');
    }
</script>

