<?php

class AdministradorDAO{
    private $id;
    private $nombre;
    private $correo;
    private $clave;

    function AdministradorDAO($id="", $nombre="", $correo="", $clave=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }

    function autenticar(){
        return "select idadministrador from administrador
                where mail = '" . $this -> correo . "' and pass = md5('" . $this -> clave . "')";
    }

    function consultar(){
        return "select idadministrador, nombre, mail from administrador
                where idadministrador = '" . $this -> id . "'";
    }

}

?>