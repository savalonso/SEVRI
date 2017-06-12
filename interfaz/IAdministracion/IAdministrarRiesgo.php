<?php
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<!DOCTYPE html>
<script>
	window.onload=ocultarBarra();

	 $( document ).ready(function(){
	   $('select').material_select();
	 });
</script>
	<?php 

		include ("../../Controladora/ctrListaUsuario.php");
		include ("../../Controladora/ctrListaAdministracion.php");
		$controlUsuarios = new ctrListaUsuario;
		$controlAdministracion = new ctrListaAdministracion;	
		$listaUsuarios =$controlUsuarios->obtenerNomCedUsuarios();
		$listaMedidas = $controlAdministracion->obtenerMedidas();
		$idAnalisis = $_GET['idAnalisis'];
		$fechaActual = date("Y-m-d");
	 ?>

	<div class="row ">
		<h4>Administrar Riesgo</h4>
		<form id="IAdministrarRiesgo" method="Post" role="form" class="responsive">
			<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
				<br>
				<div>
					<label class="white-text" for="medida">Medida de Administraci&oacuten:</label>
					<select name="medida" id="medida">
						<option value="0" disabled="true" selected >Seleccione una medida</option>
						<?php 
						foreach ($listaMedidas as $medida){
							echo "<option value=".$medida->getId().">".$medida->getNombreMedida()."</option>";
						}
						?>
					</select>
				</div>
				<div>
					<label class="white-text" for="actividad">Actividad de Tratamiento:</label>
					<textarea class="materialize-textarea scrollTextArea" rows="10" cels="30" id="actividad" name="actividad" ></textarea>
				</div>
				<div>
					<label class="white-text" for="indicador">Indicador:</label>
					<textarea class="materialize-textarea scrollTextArea" rows="10" cels="30" id="indicador" name="indicador" ></textarea>
				</div>
				<div>
					<label class="white-text" for="valor">Monto econ&oacutemico asociado a la actividad:</label>
					<input type="text" name="valor" id="valor" onkeyup="mascaraDinero(this)">
				</div>
				<div>
				 	<label class="white-text" for="plazo">Plazo de la Actividad:</label>
					<input type="date" name="plazo" id="plazo" value="<?php echo $fechaActual ?>" min="<?php echo $fechaActual; ?>" max="<?php echo date("Y")."-12-"."31"; ?>">
				</div>
				<div>
				  	<label class="white-text" for="encargado">Encargado de la Actividad:</label>
					<select name="encargado" id="encargado">
						<option value="0" disabled="true" selected>Seleccione un encargado</option>
						<?php 
						foreach ($listaUsuarios as $usuario){
							echo "<option value=".$usuario->getCedula().">".$usuario->getNombre()."</option>";
						}
						?>
					</select>
				</div>
				<div>
					<?php 
						echo "<input type=\"hidden\" id=\"analisis\" name=\"analisis\"  value=\"".$idAnalisis."\"/>";
					 ?>
					<input type="submit" id="btnGuardar" value="Insertar" class="btn btn-default"><br>
				</div>
				<br>
			</div>
		</form>
	</div>

<script>
	$(document).ready(function() {
	    $("#IAdministrarRiesgo").validate({
	        rules: {
	            medida: { required: true },
	            actividad: {  required: true, minlength: 20 , maxlength: 500 },
	            indicador: {  required: true, minlength: 5 , maxlength: 500 },
	           	plazo: {required: true,},
	           	encargado: { required: true }
	        },
	        messages: {
	            medida: "Debe seleccionar una medida de administraci&oacuten.",
	            actividad: "Debe introducir una actividad de tratamiento con un tamaño minimo de 20 caracteres y un maximo de 500 caracteres.",
	            indicador: "Debe introducir un descriptor con un tamaño minimo de 5 caracteres y un maximo de 500 caracteres.",
	            plazo: "Debe seleccionar una fecha limite en la que se debe realizar la actividad.",
	            encargado: "Debe seleccionar una persona que se encargue de realizar la actividad."

	        },
	        submitHandler: function(form){
	         if(document.getElementById('medida').value==0){
		        	Materialize.toast("Debe seleccionar una medida de administraci&oacuten.", 7000,'blue darken-3');
		     }else if(document.getElementById('encargado').value==0){
		        	Materialize.toast("Debe seleccionar una persona que se encargue de realizar la actividad", 7000,'blue darken-3');
		     }else{
		     	document.getElementById('btnGuardar').disabled=true;
		     	insertarAdministracion();
		     }
	           
	        }
	    });
	});
	 
  </script>