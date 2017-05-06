<?php 
	$fechaActual = date("Y-m-d");
	$añoActual = date("Y");
 ?>
<script>
	window.onload=ocultarBarra();
</script>		
	<div class="row ">
		<form id="IcrearSevri" method="Post" role="form" class="responsive">
			<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
				<div>
					<label class="white-text" for="nombre">Nombre Sevri</label>
					<input type="text" name="nombre" id="nombre" value="SEVRI" title="El nombre puede ser SEVRI-año-un numero como identificador Ejemplo: SEVRI-2016-01" requerid>
				</div>
				 <div>
				 	<label class="white-text" for="fecha">Fecha Creaci&oacuten</label>
					<input class="" type="date" name="fecha" id="fecha" class="validate" value="<?php echo $fechaActual ?>" min="<?php echo $fechaActual; ?>" max="<?php echo date("Y")."-12-"."31"; ?>">
				</div>
				 
				 	<input type="submit" value="Crear" class="btn btn-default"><br><br>
				
			</div>
		</form>
	</div>
		
	
	<script>
	$(document).ready(function() {
	    $("#IcrearSevri").validate({
	        rules: {
	            nombre: { required: true, minlength: 5, maxlength: 100},
	            fecha: { required: true}
	        },
	        messages: {
	            nombre: "Debe introducir el nombre del SEVRI.",
	            fecha: "Debe introducir una fecha."
	        },
	        submitHandler: function(form){
	           insertarSevri();
	        }
	    });
	});
	 $(document).ready(function() {
	   	 Materialize.updateTextFields();
 	 });
 	 $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
 	 });
 	 $(function(){
		  $('#nombre').mask('SEVRI- <?= $añoActual ?>-99');
		});
  </script>
