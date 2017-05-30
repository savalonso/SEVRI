<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<!DOCTYPE html>


<?php 

	session_start();
	$cedula=$_SESSION['idUsuario'];
	include("../../controladora/ctrListaDepartamento.php");
	$controlDepartamentos=new ctrListaDepartamento;
	$listaDepartamentos=$controlDepartamentos->obtenerListaDepartamentosUsuario($cedula);
	if($listaDepartamentos==null){
		echo "<h3>Usted no pertenece a ning&uacuten departamento.</h3>";
	}else{

?>

<div class="row">
	<div class="col l6 m6 s12">
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
		<a id="boton" href="#" onclick="cargarPagina('IAnalisis/IMostrarRiesgosAnalisis.php')" data-tooltip="Realizar un nuevo análisis" class="btn-floating tooltipped btn-large waves-effect waves-light blue "><i class="material-icons">add</i></a>
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
