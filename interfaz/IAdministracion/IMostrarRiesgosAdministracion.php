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

<?php

	if ($listaDepartamentos != null) {

 ?>

	<div class="row">
	<h4>Administrar Riesgos</h4>
		<div class="contendorselect col s12 m12 l6">
			<label class="white-text" for="departamentos">Departamento:</label>
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

<?php 

	}else{

?>
	<div class="row">
		<div class="col s12 m10 l10">
			<h4>Para poder participar de este proceso debes cumplir los siguientes requisitos:</h4>
			<ul>
				<li><h5>Estar registrado en un departamento.</h5></li>
				<li><h5>El departamento debe estar vinculado a la versión del sistema activa.</h5></li>
			</ul>
		</div>
	</div>

<?php 
	} 
?>

<div class="row">
	<div class="col s4 m4 l4">
		<a href="../controladora/ctrReportes.php?opcion=3" class="btn">Crear Reporte Excel</a>
	</div>
	<div class="col s4 m4 l4">
		<a href="../controladora/ctrReportes.php?opcion=8" class="btn">Crear Reporte Word</a>
	</div>
</div>
