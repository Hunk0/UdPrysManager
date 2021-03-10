<?php

class ProyectoDAO{
    private $id;
    private $titulo;
    private $descripccion;
    private $pdf;
    private $estado;
    private $tutor_idtutor;
    private $jurado_idjurado;

    function ProyectoDAO($id="", $titulo="", $descripccion="", $pdf="", $estado="", $tutor_idtutor="", $jurado_idjurado=""){
        $this -> id = $id;
        $this -> titulo = $titulo;
        $this -> descripccion = $descripccion;
        $this -> pdf = $pdf;
        $this -> estado = $estado;
        $this -> tutor_idtutor = $tutor_idtutor;
        $this -> jurado_idjurado = $jurado_idjurado;
    }


    function consultar(){
        return "select idproyecto, titulo, descripccion, pdf, estado, tutor_idtutor, jurado_idjurado from proyecto
                where idproyecto = '" . $this -> id . "'";
    }

    function actualizar(){
            $idtutor=$this->tutor_idtutor;
            ($idtutor=="")?$idtutor="NULL":"";
            $idjurado=$this->jurado_idjurado;
            ($idjurado=="")?$idjurado="NULL":"";
        return "UPDATE proyecto 
                SET estado="."'".$this->estado."'".",tutor_idtutor=".$idtutor.",jurado_idjurado=".$idjurado." 
                WHERE idproyecto=".$this->id;
    }

    function actualizarEstado(){
       /* return "UPDATE proyecto 
                SET estado="."'".$this->estado."'"."
                WHERE idproyecto=".$this->id;*/
          return "UPDATE `proyecto` 
                  SET `estado` = '".$this->estado."' 
                  WHERE `proyecto`.`idproyecto` = ".$this->id.";";
                  
}

    function maxid(){
        return "SELECT MAX(idproyecto) AS idproyecto FROM proyecto";
    }

    function consultarTutor(){ 
        return "SELECT tutor.idtutor, profesor.nombre , tutor.profesor_idprofesor
        FROM tutor
        INNER JOIN profesor
        ON (profesor.idprofesor=tutor.profesor_idprofesor && tutor.idtutor="."'".$this -> tutor_idtutor."'".")";        
    }

    function consultarJurado(){ 
        return "SELECT jurado.idjurado, profesor.nombre , jurado.profesor_idprofesor
        FROM jurado
        INNER JOIN profesor
        ON (profesor.idprofesor=jurado.profesor_idprofesor && jurado.idjurado="."'".$this -> jurado_idjurado."'".")";        
    }

    function consultarEstudiantes(){
        return "SELECT estudiante_has_proyecto.estudiante_idestudiante, estudiante.nombre
                FROM estudiante_has_proyecto
                INNER JOIN estudiante
                ON (estudiante.idestudiante = estudiante_has_proyecto.estudiante_idestudiante && estudiante_has_proyecto.proyecto_idproyecto =".$this->id.")";
    }

    function registrar(){
        return "INSERT INTO proyecto (titulo, descripccion, pdf, estado, tutor_idtutor, jurado_idjurado) 
        VALUES ('". $this -> titulo ."', '". $this -> descripccion ."', '". $this -> pdf ."', '". $this -> estado ."', NULL, NULL)";
    }

    function asignar($estudianteid){
        return "INSERT INTO estudiante_has_proyecto (estudiante_idestudiante, proyecto_idproyecto)
        VALUES ('".$estudianteid."', '".$this->id."')";
    }
}

?>