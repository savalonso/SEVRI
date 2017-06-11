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
?>
<!DOCTYPE html>
	<?php 
		include ("../../Controladora/ctrListaNivelRiesgo.php");

		$ctrNivel = new ctrListaNivelRiesgo();
		$DivicionNiveles = $ctrNivel->ObtenerDivicionNivel();
		$NivelRiesgoVinculado = $ctrNivel->ObtenerNivelRiesgoViculado();
	 ?>
	 <script>
		  window.onload=ocultarBarra();
		  $( document ).ready(function(){
		  $('select').material_select();});
	</script>
	<?php 
   		 if($DivicionNiveles != null ){
	?>
		<div class="contendorselect">
			<label>Seleccione el nivel de Riesgo</label>
			<select id="nRiesgo" name="nRiesgo" onchange="cargarGuiAgregarNivelRiesgo(this.value)">
				<option value="0" disabled="true" selected >Seleccione una opci&oacuten</option>
				<?php foreach ($DivicionNiveles as $nivel): ?>
					<option value="<?php echo $nivel->getIdDivisiones();?>"><?php echo $nivel->getNombreDiviciones();?></option>
				<?php endforeach ?>
			</select>
		</div>
	
		<div id="mostrarDatos">
			
		</div>
		<div class="row">
			<div class="col s12 m8 l8">
				<div>
					 <table class="responsive-table responsive striped" id="tbNivelRiesgoAgregado">
					 	<thead>
					 		<tr>
								<th>Nombre Nivel de Riesgo</th>
								<th>Opci&oacuten</th>
							</tr>	
					 	</thead>
					 	<tbody>
					 		<?php 
								if($NivelRiesgoVinculado){
									foreach ($NivelRiesgoVinculado as $nivel) {
											
										echo "<tr>";
											echo "<td>".$nivel->getNombreDiviciones()."</td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn\" type=\"button\" onclick=\"descartarNivelRiesgo('".$nivel->getIdDivisiones()."') \">Descartar</button></td>";
										echo "</tr>";
									}
								}
							?>
							
					 	</tbody>

					 </table>
				</div>
			</div>
		</div>
		<?php 
		    }else{ ?>
		        <h4>No se han un nivel de riesgo</h4>
		        <div class="col s12 m3 l3">
		            <input type="button" onclick="cargarPagina('../interfaz/INivelRiesgo/ICrearNiveles.php')" value="Crear Nivel de Riesgo" class="btn">
		        </div>
   		<?php } ?>