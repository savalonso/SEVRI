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

	if(empty($listaDepartamentos)){
		echo "<h4>No se puede realizar este proceso porque usted no ha sido agregado a un departamento.</h4>";
	}else{

?>

<script>
	window.onload=ocultarBarra();
	$( document ).ready(function(){
	$('select').material_select();});
</script>


<div class="row">

	<div class="col l12 m12 s12">
		<h4>Mostrar Riesgos</h4>
	</div>

	<div class="col l6 m6 s12">
		<label for="departamentos" class="white-text">Departamento:</label>
		<select id="departamentos" name="departamentos" onchange="cargarGUIMostrarRiesgos()">
			<option value="0" disabled="true" selected>Seleccione un departamento</option>
			<?php
				foreach ($listaDepartamentos as $departamento) {
					echo "<option value=".$departamento->getIdDepartamento().">".$departamento->getNombreDepartamento()."</option>";
				}
			?>
		</select>
	</div>
	<div class="col s6 m6 l6">
		<a id="boton" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip" 
		data-tooltip="Agregar riesgos de versiones antiguas." ><i class="material-icons" 
		onclick="cargarPagina('../interfaz/IRiesgo/IAnadirRiesgos.php')">add</i></a>
	</div>

</div>


<div id="mostrarRiesgos"></div>


<?php
	}
  ?>
	<div class="row">
		<div class="col s4 m4 l4">
			<a href="../controladora/ctrReportes.php?opcion=1" class="btn">Crear Reporte Excel</a>
		</div>
		<div class="col s4 m4 l4">
			<a href="../controladora/ctrReportes.php?opcion=6" class="btn">Crear Reporte Word</a>
		</div>
	</div>
  	<script>
	window.onload=ocultarBarra();
	$( document ).ready(function(){
		$('.modal-trigger').leanModal();
  		$('.tooltipped').tooltip({delay: 50});
	});
</script>