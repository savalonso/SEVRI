<?php 
	session_start();
	if(!$_SESSION){
		echo "<meta http-equiv=\"refresh\" content=\"0; url=paginaPrincipal.php\">";
    }else{
 ?>
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
	<select id="departamentos" name="departamentos" onchange="cargarGUIMostrarRiesgos()">
		<?php
			if($listaDepartamentos!=null){
				echo "<option value=\"0\" disabled=\"true\" selected>Seleccione una opci&oacuten</option>";
				foreach ($listaDepartamentos as $departamento) {
					echo "<option value=".$departamento->getIdDepartamento().">".$departamento->getNombreDepartamento()."</option>";
				}
			}else{
				echo "<option value=\"0\" disabled=\"true\" selected>No hay departamentos registrados</option>";
			}
			
		?>

	</select>

<?php } ?>
</div><br/><br/></br>

<div id="mostrarRiesgos"></div>

