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
	$idSeguimiento=$_GET['idSeguimiento'];

  ?>

 <div class="row">
		<form class="responsive" id="insertarSeguimientoAprobador" method="Post" role="form">
			<div class="inputs blue darken-3 col col s8 m6 16 z-depth-5">
				<h3>Insertar Aprobacion</h3>
				
				<div class="" >
				
					<div>
						<label class="white-text" for="estado">Estado:</label>
						<select id="estado" name="estado" onchange="cargarFormulario()"> 
							<option value="1">Aprobar</option>
							<option value="0">Reprobar</option>
						</select>
					</div>
				
				</div>

				<div id="temporalSeguimiento" style="display:none">
					<div>
						<label for="comentarioAprobador">Comentario del aprobador</label>
						<input type="text" name="comentario" id="comentario" >
					</div>

					
				</div>

				<div>
						<input type="submit" value="Insertar" class="btn btn-default">
					</div>

	 			<div>
					<input type="hidden" name="idSeguimiento" id="idSeguimiento" value="<?php echo "$idSeguimiento";?>">
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
    	$("#insertarSeguimientoAprobador").validate({
        	rules: {
           		 comentario:{ required: true,minlength: 20, maxlength: 500},
            	
        },
        messages: {
            comentario:"Se debe ingresar el comentario del aprobador con una extension minima de 20 caracteres y un maximo de 500 ",
         
        },
        submitHandler: function(form){
            insertarSeguimiento();
        }
    });
});

</script>