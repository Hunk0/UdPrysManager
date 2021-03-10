<?php    
    include 'presentacion/estudiante/mnuEstudiante.php';
    $proyectos = $estudiante->consultarProyectos();
?>


<br/><br/><br/>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="list-group">

                <?php              
                    foreach ($proyectos as $p) {
                        echo '
                            <a href="modalProyecto.php?idDoc=' . $p->getId() . '&usuario=3" data-toggle="modal" data-target="#modal" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">'. $p -> getTitulo() .'</h5>
                                <small class="text-muted" style="color: #1f790c !important;">'. $p -> getEstado().'</small>
                                </div>
                                <p class="mb-1">'. $p -> getDescripccion().'</p>
                                <div class="row">
                                    <div class="col">
                                        <small class="text-muted">Tutor: '.$p->getTutor().'</small>
                                    </div>
                                    <div class="col">
                                        <small class="text-muted">Jurado: '.$p->getJurado().'</small>
                                    </div>
                                </div>                                
                            </a>
                        ';    
                    }	
                ?>
            <br/>

            <a class="btn btn-info" href='index.php?pid=<?php echo base64_encode("presentacion/estudiante/registrarProyecto.php")?>'>Nuevo Proyecto</a>
            </div>
        </div>
        <div class="col-7">
            <div>
                <div class="card-body">    
                    <h1 class="display-2">Bienvenido(a):</h1> 
                    <h1 class="display-4"><?php echo $estudiante->getNombre()?></h1> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Detalles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-body").load(link.attr("href"));
	});
</script>