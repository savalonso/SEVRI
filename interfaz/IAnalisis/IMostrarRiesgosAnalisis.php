<!DOCTYPE html>


<?php 

	session_start();
	$cedula=$_SESSION['idUsuario'];
	include("../../controladora/ctrListaDepartamento.php");
	$controlDepartamentos=new ctrListaDepartamento;
	$listaDepartamentos=$controlDepartamentos->obtenerListaDepartamentosUsuario($cedula);

?>

<script>
	window.onload=ocultarBarra();
	$( document ).ready(function(){
	$('select').material_select();});
</script>

<div class="contendorselect">
	
	<label>Seleccione un departamento</label>
	<select id="departamentos" name="departamentos" onchange="cargarGUIMostrarRiesgosAnalisis()">

		<option value="0" disabled="true" selected>Seleccione una opci&oacuten</option>
		<?php
			foreach ($listaDepartamentos as $departamento) {
				echo "<option value=".$departamento->getIdDepartamento().">".$departamento->getNombreDepartamento()."</option>";
			}
		?>

	</select>


</div><br/><br/></br>

<div id="mostrarRiesgosAnalisis"></div>

