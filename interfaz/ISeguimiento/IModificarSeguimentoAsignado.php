<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<script>
	
	window.onload=ocultarBarra();
</script>

<?php
	include_once('../../controladora/ctrListaSeguimientos.php');
	$id = $_GET['idAdministracion'];
	$control = new ctrListaSeguimientos;
	$listaSeguimiento = $control->obtenerSeguimiento($id);

	foreach($listaSeguimiento as $seguimiento){
		$id = $seguimiento->getId();
		$actividad = $seguimiento->getActividadTratamiento();
        $monto = $seguimiento->getMontoSeguimiento();
        $estado = $seguimiento->getEstadoSeguimiento();
        $comentarioAprovador = $seguimiento->getComentarioAprobador();
        $comentarioAvenace = $seguimiento->getComentarioAvance();
        $porcentaje = $seguimiento->getPorcentajeAvance();
        $fecha = $seguimiento->getFechaAvance();
        $aprobador = $seguimiento->getUsuarioAprobador();
	}
?>

<div class="row">
	<form class="responsive" id="modificarSeguimiento" method="Post" role="form">
		<input type="hidden" name="idSeguimiento" id="idSeguimiento" value="<?= $id ?>">
		<div class="inputs blue darken-3 col col s8 m6 16 z-depth-5">
			<h3>Modificar aprobaci&oacute;n</h3>
			<label  for="estado">Estado:</label>
			<select id="estadoSeguimiento" name="estadoSeguimiento" onchange="cargarFormularioModificar()"> 
			
			</select>
			<a class="waves-effect waves-light btn modal-trigger" href="#Mconfirmar">Modificar</a></br></br>
		</div>
	</form>
</div>
<div id="Mconfirmar" class="modal blue darken-3 z-depth-5 white-text">
	<div class="modal-content">
		<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
	</div>
	<div class="modal-footer blue darken-3 z-depth-5">
		<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		<input type="submit" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.modal-trigger').leanModal();
	});
	$( document ).ready(function(){
   	 $('select').material_select();
	});

	$(document).ready(function() {

    	$("#modificarSeguimiento").validate({
        	rules: {
           		 comentario:{ required: true,minlength: 20, maxlength: 1000},    	
        },
        messages: {
            comentario:"Se debe de ingresar el comentario con una extension minima de 20 caracteres y una maxima de 1000 caracteres",
         
        },
        submitHandler: function(form){

        	if(document.getElementById('estadoSeguimiento').value==1 && document.getElementById('comentarioAprobador').value!=""){
		 		document.getElementById('comentarioAprobador').value="";
		 		modificarSeguimiento();
		        	
		    }else{
		        modificarSeguimiento();	
		    }

            
        }
    });
});

</script>
