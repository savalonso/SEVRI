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

  <h4>Insertar Aprobacion</h4>

 <div class="row">
		<form class="responsive" id="insertarSeguimientoAprobador" method="Post" role="form">
			<div class="inputs blue darken-3 col col s8 m6 16 z-depth-5">
				
				
				<div class="" >
				
					<div>
						
						<select id="estado" name="estado" onchange="cargarFormulario()"> 
							<option selected disabled>Seleccione un estado...</option>
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
					</div><br>

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
           		 comentario:{ required: true,minlength: 20, maxlength: 1000},
            	
        },
        messages: {
            comentario:"Se debe de ingresar un comentario con una extension minima de 20 caracteres y maxima de 1000 ",
         
        },
        submitHandler: function(form){

        	if(document.getElementById('estado').value==1 && document.getElementById('comentario').value!=""){
		 		document.getElementById('comentario').value="";
		 		
            	insertarSeguimiento();
		        	
		    }else{
		        
            	insertarSeguimiento();
		    }
        }
    });
});

</script>