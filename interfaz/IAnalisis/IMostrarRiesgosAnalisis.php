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
		echo "<h3>Usted no pertenece a ning&uacuten departamento.</h3>";
	}else{

?>

<div class="row">
	<div class="col l6 m6 s12">
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