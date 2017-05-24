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
	<div class="contendorselect col s12 m12 l6">
		<h4>Administraci&oacuten del Riesgo</h4>
		<select id="departamentos" name="departamentos" onchange="cargarGUIMostrarRiesgosAdministracion()">
	
			<option value="0" disabled="true" selected>Seleccione un Departamento</option>
			<?php
				foreach ($listaDepartamentos as $departamento) {
					echo "<option value=".$departamento->getIdDepartamento().">".$departamento->getNombreDepartamento()."</option>";
				}
			?>
	
		</select>
	
	
	</div>
</div>

<div id="mostrarRiesgosAdministracion"></div>
