<?php
	session_start();
    $tipo="";
    if(isset($_SESSION['tipo'])){
        $tipo=$_SESSION['tipo'];
    }else{
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
    if($tipo!='Administrador'){
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Insertar Departamento</title>
	<meta charset="utf-8">
</head>
<body>

	<?php

		$fechaActual=date("Y-m-d");

	 ?>

	 <script>
	 	window.onload=ocultarBarra();
	 </script>

	<h4>Registrar Departamento</h4>

	<div class="row">
		<form id="ingresarDepartamento" method="Post" role="form" class="responsive">

			<div class="inputs blue darken-3 col s8 m6 16 z-depth-5">

				

				<div>
					<label class="white-text" for="codigo">C&oacutedigo:</label>
					<input type="text" name="codigo" id="codigo">
				</div>

				<div>
					<label class="white-text" for="nombre">Nombre:</label>
					<input type="text" name="nombre" id="nombre">
				</div>

				<div>
				 	<label class="white-text" for="fecha">Fecha Creaci&oacuten</label>
					<input class="validate" type="date" name="fecha" id="fecha" value="<?php echo $fechaActual ?>" min="<?php echo $fechaActual; ?>" max="<?php echo date("Y")."-12-"."31"; ?>">
				</div>
				
				<div>
					<input type="submit" id="btnCrearDepartamento" value="Insertar" class="btn btn-default"><br>
				</div>
<br>
			</div>
			

		</form>
		

	</div>


</body>

<script>
	$(document).ready(function() {
	    $("#ingresarDepartamento").validate({
	        rules: {
	            codigo: { required: true, minlength: 5, maxlength: 45},
	            nombre:{required:true,minlength:5,maxlength:100},
	            fecha: { required: true}
	        },
	        messages: {
	        	codigo: "Se debe ingresar un codigo con un minimo de 5 caracteres y maximo de 45.",
	            nombre: "Se debe ingresar un nombre con un minimo de 5 caracteres y maximo de 100.",
	            fecha: "Debe introducir una fecha."
	        },
	        submitHandler: function(form){
	           insertarDepartamento();
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


</script>
</html>