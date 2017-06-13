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
	$id=$_GET['idSeguimiento'];
	$control=new ctrListaSeguimientos;
	$listaSeguimiento=$control->obtenerSeguimientoAprobador($id);

	foreach($listaSeguimiento as $seguimiento){
		$idSeguimiento=$seguimiento->getId();
		$actividad=$seguimiento->getActividadTratamiento();
		$estado=$seguimiento->getEstadoSeguimiento();
		$comentario=$seguimiento->getComentarioAprobador();
	}
	
  ?>
<h4>Modificar aprobaci&oacute;n</h4>
<div class="row">
		<form class="responsive" id="modificarSeguimiento" method="Post" role="form">
			<div class="inputs blue darken-3 col col s8 m6 16 z-depth-5">
				
				<div class="">
					
				<div>
					<label  for="estado">Estado:</label></br>
					<select id="estadoSeguimiento" name="estadoSeguimiento" onchange="cargarFormularioModificar()"> 
						<?php
							if($estado==1){
								echo"<option selected=\"true\" value=\"1\">Aprobado</option>";
								echo"<option value=\"0\">Reprobado</option>";
							}else if($estado==0){

								echo"<option selected=\"true\" value=\"0\">Reprobado</option>";
								echo"<option value=\"1\">Aprobado</option>";
							}
						?>
					
					</select>
			   </div>

			   <div id="temporalComentario" style="display:none">
					
					<div>

						<label for="comentarioAprobador">Comentario del aprobador</label>
						<input type="text" name="comentarioAprobador" id="comentarioAprobador" value="<?php echo "$comentario"; ?> ">

					</div>

					
				</div>

				<div>
					<input type="hidden" name="idSeguimiento" id="idSeguimiento" value="<?php echo "$idSeguimiento";?>">
				</div>
            	<div>
					<a class="waves-effect waves-light btn modal-trigger" href="#Mconfirmar">Modificar</a></br></br>
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
			</div>
		</form>
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
            comentario:"Se debe de ingresar un comentario con una extension minima de 20 caracteres y maxima de 1000",
         
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
