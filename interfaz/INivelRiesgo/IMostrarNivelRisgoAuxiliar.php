<!DOCTYPE html>
<?php
		session_start();
	    $tipo="";
	    if(isset($_SESSION['tipo'])){
	        $tipo=$_SESSION['tipo'];
	    }else{
	        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	    }
	    if($tipo!='Administrador'){
	        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	    }
		include ("../../Controladora/ctrListaNivelRiesgo.php");

		$ctrNivel = new ctrListaNivelRiesgo();
		$DivicionNiveles = $ctrNivel->ObtenerDivicionNivel();
	 ?>
	 <script>
		  window.onload=ocultarBarra();
		  $( document ).ready(function(){
		  $('select').material_select();});
	</script>
		<div class="contendorselect">
			<label>Seleccione el nivel de Riesgo</label>
			<select id="nRiesgo" name="nRiesgo" onchange="cargarGuiMostrarNivelRiesgo(this.value)">
				<option value="0" disabled="true" selected >Seleccione una opci&oacuten</option>
				<?php foreach ($DivicionNiveles as $nivel): ?>
					<option value="<?php echo $nivel->getIdDivisiones();?>"><?php echo $nivel->getNombreDiviciones();?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div id="mostrarDatos2">
			
		</div>

		