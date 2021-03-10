<?php
$estudiante = new Estudiante($_SESSION['id']);
$estudiante->consultar();
include 'presentacion/estudiante/mnuEstudiante.php';

$titulo = "";
$descripccion = "";
$estudiantes=$estudiante->consultarTodos();
if (isset($_POST["registrar"])) { 
    $titulo = $_POST["titulo"];
    $descripccion = $_POST["descripccion"];
    $compaid = $_POST["compa"];

    $pdf = round(microtime(true) * 1000) . ".pdf";
    $targetfolder = "./documentos/" . $pdf ;
    $file_type=$_FILES['documento']['type'];

    if ($file_type=="application/pdf") {
        if(move_uploaded_file($_FILES['documento']['tmp_name'], $targetfolder)){
            $mensaje = "Nuevo proyecto subido";
            $proyecto = new Proyecto("", $titulo, $descripccion, $pdf, 0, "", "");
            $proyecto -> registrar();
            $proyecto -> maxid();
            $proyecto -> consultar();
            $proyecto -> asignar($estudiante->getId());
            $proyecto -> asignar($compaid);
            
            echo '<div id="alert" class="fixed-top alert alert-success alert-dismissible fade show" role ="alert" style=" position: absolute;">
                    '.$mensaje.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>'; 
            $mensaje="";
            $_POST["registrar"]=null;
        }else{
            $mensaje = "Ha ocurrido un problema con el archivo que intenta subir";
        }
    }else{
        $mensaje = "Tipo de archivo invalido ";
    }

    if($mensaje!=""){
        echo '<div id="alert" class="fixed-top alert alert-danger alert-dismissible fade show" role ="alert" style=" position: absolute;">
                '.$mensaje.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
          </div>'; 
    }
}
?>

<script type="application/javascript">
    $(document).on('change', '.custom-file-input', function (event) {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
    })
</script>

<br/><br/><br/><br/><h1 class="display-3">Nuevo Proyecto</h1><br/>

<div class="container">
    <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/estudiante/registrarProyecto.php") ?> method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="titulo" class="form-control" placeholder="Titulo" required="required" value="<?php echo $titulo; ?>">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="descripccion" placeholder="Descripccion" required="required"><?php echo $descripccion; ?></textarea>
        </div>
        <div class="form-group form-inline">
        <label class="mb-2 mr-sm-2" for="inlineFormCustomSelectPref">Compañero:   <i class="fas fa-question-circle" data-toggle='tooltip' data-placement='top' title='Si no encuentras a tu compañero, contacta un administrador o pidele que se registre' ></i></label>
            <select class="form-group custom-select mb-2 mr-sm-7" name="compa" style="display: flex; flex-grow: 1;">
                <?php     
                    echo "<option value='' selected> Ninguno </option>";       
                    foreach ($estudiantes as $e){
                        if($e->getId()!=$estudiante->getId()){
                            echo "<option value='".$e->getId()."'>".$e->getNombre()."</option>"; 
                        }                    
                    }                         
                ?>
            </select>            
        </div>
        <div class="form-group custom-file">
            <input name="documento" type="file" accept="application/pdf" class="custom-file-input" id="documento" required="required" lang="es" >
            <label class="custom-file-label" for="documento" data-browse="Elegir">Elegir Archivo...</label>
            <div class="invalid-feedback">Archivo invalido, asegurate de subir un documento pdf</div>
        </div>
        <br/><br/>
        <button type="submit" name="registrar" class="btn btn-info">Registrar</button>
        <a class="btn btn-secondary" href="index.php?pid=<?php echo base64_encode("presentacion/estudiante/sesionEstudiante.php")?>" role="button">Atras</a>
	</form>
</div>
