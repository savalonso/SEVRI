<!DOCTYPE html>
	<?php
		include("../../controladora/ctrListaDepartamento.php");
		$control=new ctrListaDepartamento;
		$lista=$control->mostrarDepartamentos();
		$fechaActual=date("Y-m-d");
	?>
	<script>	
		window.onload=ocultarBarra();
		$( document ).ready(function(){
	   	$('select').material_select();
	   	});
	</script>

		<div class="row">
			<?php  
				if($lista!=null){
			?>

			<h2>Lista de Departamentos</h2>
			<div class="col s12 m12 l12 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Nombre</th>
								<th>Fecha de creac&iacuteon</th>
								<th>Modificar</th>
								<th>Eliminar</th>
								<th>Agregar Usuarios</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							
								foreach ($lista as $departamento){
									
									echo "<tr>
											<td>".$departamento->getCodigoDepartamento()."</td>
											<td>".$departamento->getNombreDepartamento()."</td>
											<td>".$departamento->getFechaCreacion()."</td>";
											
											if($departamento->getEsModificable() == true){
											echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"invocarDivModificarDepartamento(this,'".$departamento->getIdDepartamento()."')\"/></td>
											<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarEliminarDepartamento('".$departamento->getIdDepartamento()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#MeliminarDepartamento\">Eliminar</a> </button>  </td>
											<td><input class=\"btn btn-default\" type=\"button\" value=\"Agregar Usuarios\" disabled=\"true\"/></td>
											</tr>";
											} else {
											echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Modificar\" /></td>
											<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>
											<td><input class=\"btn btn-default\" type=\"button\" value=\"Agregar Usuarios\" onclick=\"cargarPagina('../interfaz/IDepartamento/IAgregarUsuarioDepartamento.php?idDepartamento=".$departamento->getIdDepartamento()."')\"/></td>
											</tr>";
											}
								}
							?>
						</tbody>
					</table>
				</div>
					<?php  
						}else{
							echo "<br><h3>A&uacuten no se ha creado ning&uacuten departamento</h3>";
						}
					?>
			</div>
		</div>



	<div id="MeliminarDepartamento" class="modal  blue darken-3 z-depth-5 white-text">
		<div class="modal-content">
			<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
		</div>
		<div class="modal-footer blue darken-3 z-depth-5">
			<input type="hidden" id="idDepartamento" name="idDepartamento">
		 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarDepartamento()" />
		</div>
	</div>





<div class="row " id="divModificarDepartamentos" style="display:none">

		<form id="modificarDepartamento" method="Post" role="form" class="responsive">
			
			<div class="inputs blue darken-3 col s8 m6 16 z-depth-5">

				<div>
					<label class="white-text" for="codigo">Codigo:</label>
					<input type="text" name="codigoDepartamento" id="codigoDepartamento">
				</div>

				<div>
					<label class="white-text" for="nombre">Nombre:</label>
					<input type="text" name="nombreDepartamento" id="nombreDepartamento">
				</div>

				<div>
				 	<label class="white-text" for="fecha">Fecha Creaci&oacuten</label>
					<input class="" type="date" name="fechaDepartamento" id="fechaDepartamento" class="validate" value="<?php echo $fechaActual ?>" min="<?php echo $fechaActual; ?>" max="<?php echo date("Y")."-12-"."31"; ?>">
				</div>

				<div>
					<input type="hidden" name="idDepartamento" id="idDepartamento">
					<button type="button" class="btnEliminar"><a class="waves-effect waves-light btn modal-trigger" href="#MmodificarDepartamento">Modificar</a></button>
					<input type="button" value="Cancelar" class="btn btn-default" onclick="ocultarDivModificar()"><br>
				</div>
			</div><br>
			<div id="MmodificarDepartamento" class="modal  blue darken-3 z-depth-5 white-text">
				<div class="modal-content">
					<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				</div>
				<div class="modal-footer blue darken-3 z-depth-5">
				 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				 	<input type="submit" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				</div>
			</div>
		</form>
	</div>

	<!-- Validacion para el formulario -->

<script>
	$(document).ready(function() {

	    $("#modificarDepartamento").validate({
	        rules: {
	            codigoDepartamento: { required: true, minlength: 5, maxlength: 45},
	            nombreDepartamento:{required:true,minlength:5,maxlength:100},
	            fechaDepartamento: { required: true}
	        },
	        messages: {
	        	codigoDepartamento: "Debe introducir el codigo del departamento",
	            nombreDepartamento: "Debe introducir el nombre del departamento.",
	            fechaDepartamento: "Debe introducir una fecha."
	        },
	        submitHandler: function(form){
	           modificarDepartamento();
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
	 
	 $( document ).ready(function(){
	   	$('.modal-trigger').leanModal();
	   	$('ul.tabs').tabs();
	});
  </script>	
				