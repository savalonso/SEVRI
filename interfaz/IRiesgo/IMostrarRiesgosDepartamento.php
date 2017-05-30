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
		echo "<br><h4>No se puede realizar este proceso porque usted no ha sido agregado a un departamento.</h4>";
	}else{

?>

<script>
	window.onload=ocultarBarra();
	$( document ).ready(function(){
	$('select').material_select();});
</script>
<div class="row">
	<div class="col l6 m6 s6">
	
		<select id="departamentos" name="departamentos" onchange="cargarGUIMostrarRiesgos()">
			<option value="0" disabled="true" selected>Seleccione un departamento</option>
			<?php
				foreach ($listaDepartamentos as $departamento) {
					echo "<option value=".$departamento->getIdDepartamento().">".$departamento->getNombreDepartamento()."</option>";
				}
			?>
		</select>
	</div>
</div>

<div id="mostrarRiesgos"></div>

	<div class="row">
		<div class="col s4 m4 l4">
			<a href="../controladora/ctrReportes.php?opcion=1" class="btn">Crear Reporte Excel</a>
		</div>
		<div class="col s4 m4 l4">
			<a href="../controladora/ctrReportes.php?opcion=6" class="btn">Crear Reporte Word</a>
		</div>
	</div>



<?php
	}
  ?>

  	<script>
	window.onload=ocultarBarra();
	$( document ).ready(function(){
	$('select').material_select();});
</script>