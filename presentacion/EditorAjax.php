<?php
if(isset($_GET["idDoc"])){
    $id=$_GET["idDoc"]; 
    $titulo=""; 
    $descripccion=""; 
    $pdf=""; 
    $estado=""; 
    $estadocod="";
    $tutor_idtutor=""; 
    $jurado_idjurado="";
    if(isset($_GET["estado"])){
        $estadocod=$_GET["estado"];
        $proyecto= new Proyecto($id, "", "", "", $estadocod, "", "");
        $proyecto->actualizarEstado();
        $proyecto->consultar();
        $estado=$proyecto->getEstado();

        echo $estado;
    }
}
?>