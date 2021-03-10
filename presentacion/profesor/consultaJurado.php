<?php    
    include 'presentacion/profesor/mnuProfesor.php';

    $jurado = new Jurado("",$profesor->getId(),"");
    $proyectos=$jurado->getProyectos();     
?>

<div class="container">
    <br/><br/><br/>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Id.</th>
        <th scope="col">Titulo</th>
        <th scope="col">Estado</th>
        <th scope="col">Servicios</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($proyectos as $p){
                echo "<tr>";
                echo '<th scope="row">'. $p->getId() .'</th>';
                echo '<td>'. $p->getTitulo() .'</td>';
                echo '<td id="tablestatus'.$p->getId().'" >'. $p->getEstado() .'</td>';
                echo "<td>
                         <a href='modalProyecto.php?idDoc=" . $p->getId() . "&usuario=2' data-toggle='modal' data-target='#modal'>
                            <span class='fas fa-eye' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Ver Detalles'></span> 
                         </a>";

                        if($p->getEstadoId()==4){
                          echo "<a href='#' id='cambiarEstado" . $p->getId() . "'>
                                    <span class='fas fa-check-circle' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Rechazar'></span> 
                                </a>";
                        }else if($p->getEstadoId()==3){
                          echo "<a href='#' id='cambiarEstado" . $p->getId() . "'>
                                    <span class='fas fa-check-circle' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Aprobar' style='color: #7e848a;'></span> 
                                </a>";
                        }

                echo "</td>";
                echo "</tr>";
            }            
        ?>
    </tbody>
    </table>
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


<script type="text/javascript">
  
  $(document).ready(function(){
    <?php foreach ($proyectos as $p) { ?>
      var estado=<?php echo $p->getEstadoId()?>;
      $("#cambiarEstado<?php echo $p -> getId(); ?>").click(function(){
        var ctr=1;
        var status;
        if(estado==3 & ctr==1){
          estado=estado+1;
          status = "<span class='fas fa-check-circle' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Rechazar'></span>";
          ctr++;          
        }
        if(estado==4 & ctr==1){
          estado=estado-1;
          status = "<span class='fas fa-check-circle' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Aprobar' style='color: #7e848a;'></span>";
          ctr++;
        }
        console.log(status);
        <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/EditorAjax.php") . "&idDoc=" . $p -> getId() . "&estado=\"+estado ;\n"; ?>
        $('.tooltip').not(this).hide();
        $(<?php echo '"#cambiarEstado'.$p -> getId().'"'?>).html(status);
        $(<?php echo '"#tablestatus'.$p -> getId().'"'?>).load(ruta);
        
        ctr=1;
      });
    <?php } ?>
  });
</script>