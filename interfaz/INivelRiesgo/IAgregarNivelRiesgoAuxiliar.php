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
					 <table class="responsive-table striped" id="tbNivelRiesgoAgregado">
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