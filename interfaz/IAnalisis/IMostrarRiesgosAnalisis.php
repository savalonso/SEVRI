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
		<h4>An&aacutelizar Riesgo</h4>
	</div>

	<div class="col l8 m8 s8">
		<label for="departamentos" class="white-text">Departamento:</label>
		<select id="departamentos" name="departamentos" onchange="cargarGUIMostrarRiesgosAnalisis()">
			<option value="0" disabled="true" selected>Seleccione un departamento</option>
			<?php
				foreach ($listaDepartamentos as $departamento) {
					echo "<option value=".$departamento->getIdDepartamento().">".$departamento->getNombreDepartamento()."</option>";
				}
			?>
		</select>
	</div>
</div>
<div id="mostrarRiesgosAnalisis"></div>
	
<?php } ?>

<script>
	window.onload=ocultarBarra();
	$( document ).ready(function(){
	$('select').material_select();});
</script>