

<?php 
	include ("../../Controladora/ctrListaNivelRiesgo.php");
	$ctrNivel = new ctrListaNivelRiesgo();
	$NivelRiesgo = $ctrNivel->ObtenerNivelRiesgo();
	$NivelRiesgoVinculado = $ctrNivel->ObtenerNivelRiesgoViculado();
	$idDivicion = $_GET['idDivicion']; 
 ?>
 
<div class="row">
	<div class="col s12 m8 l8">
		<div id="div1">
			 <table class="responsive-table responsive striped">
			 	<thead>
			 		<tr>
						<th>Limite</th>
						<th>Descriptor</th>
						<th>Descripci&oacuten</th>
						<th>Color</th>
					</tr>	
			 	</thead>
			 	<tbody>
			 		<?php 
						
						foreach ($NivelRiesgo as $nivel) {
								if($nivel->getIdDivisiones() == $idDivicion){
								echo "<tr>";
									echo "<td>".$nivel->getLimite()."%"."</td>";
									echo "<td>".$nivel->getDescriptor()."</td>";
									echo "<td>".$nivel->getDescripcion()."</td>";
									echo "<td>"."<div id=\"divColor\" style=\"background-color:".$nivel->getColor().";\"class=\"paletaColores\"></div>"."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<?php if($NivelRiesgoVinculado){ ?>
							<td><input type="button" id="btnAgregarNivel" class="btn" value="Agregar" disabled="true"></td>
						<?php }else{ ?>
							<td><input type="button" id="btnAgregarNivel" class="btn" value="Agregar" onclick="AgregarNivelRiesgo(<?php echo "$idDivicion"; ?>)"></td>
						<?php }?>	
					</tr>
					
			 	</tbody>

			 </table>
		</div>

	</div>

</div>
<script>
	window.onload=ocultarBarra();
</script>
 
