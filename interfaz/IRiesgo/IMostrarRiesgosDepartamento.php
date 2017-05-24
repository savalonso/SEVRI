<!DOCTYPE html>


<?php
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
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
<div class="row">
	<div class="col l6 m6 s6">
		<label>Seleccione un departamento</label>
		<select id="departamentos" name="departamentos" onchange="cargarGUIMostrarRiesgos()">
			<option value="0" disabled="true" selected>Seleccione una opci&oacuten</option>
			<?php
				foreach ($listaDepartamentos as $departamento) {
					echo "<option value=".$departamento->getIdDepartamento().">".$departamento->getNombreDepartamento()."</option>";
				}
			?>
		</select>
	<div>
</div>
</div>
<div id="mostrarRiesgos"></div>

