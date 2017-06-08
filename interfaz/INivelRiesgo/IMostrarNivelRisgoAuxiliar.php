
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
	<?php if($DivicionNiveles != null){?>
		<div class="row">
			<h4 class="col s10 m10 l10">Mostrar Nivel de Riesgo</h4>
			<div class="contendorselect col s8 m8 l8">
				<select id="nRiesgo" name="nRiesgo" onchange="cargarGuiMostrarNivelRiesgo(this.value)">
					<option value="0" disabled="true" selected >Seleccione un nivel de riesgo</option>
					<?php foreach ($DivicionNiveles as $nivel): ?>
						<option value="<?php echo $nivel->getIdDivisiones();?>"><?php echo $nivel->getNombreDiviciones();?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="col l2 m2 s2">
				<a id="boton" href="#" onclick="cargarPagina('../interfaz/INivelRiesgo/ICrearNiveles.php')" data-tooltip="Crear Nivel de Riesgo" class="btn-floating tooltipped btn-large waves-effect waves-light blue" style="float: right;"><i class="material-icons">add</i></a>
			</div>
		</div>
		<div id="mostrarDatos2">
			
		</div>

	<?php  
	    }else{ ?>

			<div class="row">
				<h4 class="col s10 m10 l10">Mostrar Nivel de Riesgo</h4>
				<h4 class="col s10 m10 l10">No se han creado niveles de riesgo</h4>
				<div class="col l2 m2 s2">
					<a id="boton" href="#" onclick="cargarPagina('../interfaz/INivelRiesgo/ICrearNiveles.php')" data-tooltip="Crear Nivel de Riesgo" class="btn-floating tooltipped btn-large waves-effect waves-light blue" style="float: right;"><i class="material-icons">add</i></a>
				</div>
			</div>
		<?php }?>	

<script>
	$(document).ready(function(){
  		$('.tooltipped').tooltip({delay: 50});
   	});
</script>