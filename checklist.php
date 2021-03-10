<?php

$admin = '[
        {
            "desc": "Autenticar",
            "val": "0.0",
            "ste": "1"
        }, {
            "desc": "Crear estudiante. Use los atributos que considere necesarios ",
            "val": "0.0",
            "ste": "0"
        }, {
            "desc": "Crear Profesor. Use los atributos que considere necesarios",
            "val": "0.0",
            "ste": "1"
        }, {
            "desc": "Consultar estudiante. ",
            "val": "0.0",
            "ste": "1"
        }, {
            "desc": "Consultar proyecto. Después de consultar estudiante, el administrador podrá consultar los proyectos de un estudiante. ",
            "val": "0.5",
            "ste": "1"
        }, {
            "desc": "Asignar tutor. Después de consultar proyecto, el administrador podrá asignar un profesor tutor ",
            "val": "0.5",
            "ste": "1"
        }, {
            "desc": "Asignar jurado. Después de consultar proyecto, el administrador podrá asignar un profesor jurado",
            "val": "0.5",
            "ste": "1"
        }
        ]';

$stud = '[
    {
        "desc": "Autenticar",
        "val": "0.0",
        "ste": "1"
    }, {
        "desc": "Crear proyecto. Use los atributos que considere necesarios (Ej: titulo, planteamiento, objetivos, etc). El proyecto requerirá que se publique un archivo pdf con el anteproyecto. El estudiante que crea el proyecto puede agregar a otro estudiante al proyecto.",
        "val": "0.5",
        "ste": "1"
    }, {
        "desc": " Consultar proyecto. Debe mostrar un estado entre: “Creado por estudiante”, “Asignado a tutor”, “Revisado por tutor”, “Asignado a Jurado”, “Aprobado por Jurado” ",
        "val": "0.0",
        "ste": "1"
    }
    ]';
    
$prof = '[
    {
        "desc": "Autenticar",
        "val": "0.0",
        "ste": "1"
    }, {
        "desc": "Consultar proyectos asignados como tutor. Usar modal para ver todos los atributos",
        "val": "1.0",
        "ste": "1"
    }, {
        "desc": "Revisar proyecto. Después consultar proyecto asignado como tutor, podrá cambiar el estado a “Revisado por tutor” Usar Ajax",
        "val": "1.0",
        "ste": "1"
    }, {
        "desc": "Consultar proyectos asignados como jurado. Usar modal para ver todos los atributosss",
        "val": "1.0",
        "ste": "1"
    }, {
        "desc": "Aprobar proyecto. Después consultar proyecto asignado como jurado, podrá cambiar el estado a “Aprobado por Jurado” Usar Ajax",
        "val": "1.0",
        "ste": "1"
    }
    ]';
    

$nFinal=0.0;

$admins = json_decode($admin);
foreach ($admins as $a){
    if($a->ste==true){
        $nFinal+=$a->val;
    }
}

$studs = json_decode($stud);
foreach ($studs as $s){
    if($s->ste==true){
        $nFinal+=$s->val;
    }
}

$profs = json_decode($prof);
foreach ($profs as $p){
    if($p->ste==true){
        $nFinal+=$p->val;
    }
}

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
        // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
        });
    </script>   
</head>

<body>
    <div class="container">
        <h1 class="text-center">Resultado:</h1>
        <h1 class="text-center display-3"><?php echo $nFinal; ?></h1>
        <hr>
        <br/>
        <p class="h4">Funciones Administrador:</p>
        <ul class="list-group">
            <?php
                foreach ($admins as $a){
                    echo    '<li class="list-group-item d-flex justify-content-between align-items-center">
                                '.$a->desc.'
                                <span class="font-weight-bold" style=" color: '.(($a->ste==true)?'#3dac25':'#b32424').';">'.(($a->ste==true)?'+'.$a->val:'-'.$a->val).'</span>
                            </li>';
                }
            ?>
        </ul>
        <br/>
        <p class="h4">Funciones Estudiante:</p>
        <ul class="list-group">
            <?php
                foreach ($studs as $s){
                    echo    '<li class="list-group-item d-flex justify-content-between align-items-center">
                                '.$s->desc.'
                                <span class="font-weight-bold" style=" color: '.(($s->ste==true)?'#3dac25':'#b32424').';">'.(($s->ste==true)?'+'.$s->val:'-'.$s->val).'</span>
                            </li>';
                }
            ?>
        </ul>
        <br/>
        <p class="h4">Funciones Profesor:</p>
        <ul class="list-group">
            <?php
                foreach ($profs as $a){
                    echo    '<li class="list-group-item d-flex justify-content-between align-items-center">
                                '.$a->desc.'
                                <span class="font-weight-bold" style=" color: '.(($a->ste==true)?'#3dac25':'#b32424').';">'.(($a->ste==true)?'+'.$a->val:'-'.$a->val).'</span>
                            </li>';
                }
            ?>
        </ul>
        <br/>
        <hr>        
    </div>
</body>

