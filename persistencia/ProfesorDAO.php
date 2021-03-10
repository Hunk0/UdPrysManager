<?php

class ProfesorDAO{
    private $id;
    private $nombre;
    private $correo;
    private $clave;

    function ProfesorDAO($id="", $nombre="", $correo="", $clave=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }

    function registrar(){
        return "insert into profesor 
                (nombre, mail,	pass)
                values ('" . $this->nombre . "', '" . $this->correo . "',  md5('" . $this->clave . "'))";
    }

    function maxid(){
        return "SELECT MAX(idprofesor) AS idprofesor FROM profesor";
    }

    function autenticar(){
        return "select idprofesor from profesor
                where mail = '" . $this -> correo . "' and pass = md5('" . $this -> clave . "')";
    }

    function consultar(){
        return "select idprofesor, nombre, mail from profesor
                where idprofesor = '" . $this -> id . "'";
    }

    function consultarTodos(){
        return "select idprofesor, nombre,  mail
                from profesor";
    }

    function existeCorreoOLD(){
        return "select idprofesor from profesor
                where mail = '" . $this->correo . "'";
    }

    function existeCorreo(){
        return "SELECT estudiante.idestudiante, profesor.idprofesor, administrador.idadministrador 
                FROM estudiante
                INNER JOIN profesor, administrador
                WHERE (estudiante.mail = '" . $this->correo . "' OR profesor.mail = '" . $this->correo . "' OR administrador.mail = '" . $this->correo . "')";
    }

}

?>