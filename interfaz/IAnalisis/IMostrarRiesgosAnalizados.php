<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<!DOCTYPE html>


<?php 
	$cedula=$_SESSION['idUsuario'];
	include("../../controladora/ctrListaDepartamento.php");
	$controlDepartamentos=new ctrListaDepartamento;
	$listaDepartamentos=$controlDepartamentos->obtenerListaDepartamentosUsuario($cedula);
	if($listaDepartamentos==null){
		echo "<h4>Usted no pertenece a ning&uacuten departamento.</h4>";
	}else{

?>

<div class="row">
	
	<div class="col l12 m12 s12">
		<h4>Mostrar An&aacutelisis</h4>
	</div>

	<div class="col l6 m6 s12">
		<label for="departamentos" class="white-text">Departamento:</label>
		<select id="departamentos" name="departamentos" onchange="cargarGUIMostrarRiesgosAnalizados()">
			<option value="0" disabled="true" selected>Seleccione un departamento</option>
			<?php
				foreach ($listaDepartamentos as $departamento) {
					echo "<option value=".$departamento->getIdDepartamento().">".$departamento->getNombreDepartamento()."</option>";
				}
			?>
		</select>
	</div>
	<div class="col s6 m6 l6">
		<a id="boton" href="#" onclick="cargarPagina('IAnalisis/IMostrarRiesgosAnalisis.php')" data-tooltip="Realizar un nuevo análisis" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip"><i class="material-icons">add</i></a>
	</div>
</div>
<div id="mostrarRiesgosAnalizados"></div>

	<div class="row">
		<div class="col s4 m4 l4">
			<a href="../controladora/ctrReportes.php?opcion=2" class="btn">Crear Reporte Excel</a>
		</div>
		<div class="col s4 m4 l4">
			<a href="../controladora/ctrReportes.php?opcion=7" class="btn">Crear Reporte Word</a>
		</div>
	</div>

<?php } ?>

<script>
	window.onload=ocultarBarra();
	$( document ).ready(function(){
	$('select').material_select();});
	$('.tooltipped').tooltip({delay: 10});
</script>
