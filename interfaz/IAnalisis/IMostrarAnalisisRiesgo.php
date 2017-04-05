	<?php
		include_once ("../../controladora/ctrListaAnalisis.php");
		include_once ("../../Controladora/ctrDatosSevri.php");
		$controlDatos = new ctrDatosSevri;
		$controlAnalisis = new ctrListaAnalisis();
		$listaAnalisis = $controlAnalisis->obtenerListaAnalisis();
		$listaNiveles = $controlDatos->obtenerNivelesSevriActivo();
		$cantidadDivisiones = count($listaNiveles);
		$valorFormula = $controlDatos->obtenerValorFormula();
	?>
	<script>
		window.onload=ocultarBarra();
	</script>
	<div class="row">
		<h2>Lista de An&aacute;lisis de Riesgo</h2>
		<div class="col s12 m12 l12 blue darken-3 z-depth-5">
			<div id="div1">
			<?php  
				if($listaAnalisis!=null){
			?>
			<table class="responsive-table centered bordered">
				<thead>
					<tr>
						<th>Riesgo</th>
						<th>Probabilidad</th>
						<th>Impacto</th>
						<th>Nivel Riesgo</th>
						<th>Medida Control</th>
						<th>Calificaci&oacuten Medida</th>
						<th>Modificar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($listaAnalisis==null){
						echo "NO HAY REGISTROS A&Uacute;N";
					}else{
						foreach ($listaAnalisis as $analisis){
						echo "<tr>
								<td>
									".$analisis->getIdRiesgo()."
								</td>
								<td>
									".$analisis->getProbabilidad()->getDescriptorParametro()."
								</td>
								<td>
									".$analisis->getImpacto()->getDescriptorParametro()."
								</td>";
								$limiteInicial = 0;
								$contador = 1;
								$resultadoOperacion = round(($analisis->getImpacto()->getValorParametro()*$analisis->getProbabilidad()->getValorParametro())/1*$valorFormula);
								foreach ($listaNiveles as $nivel) {
									if(($resultadoOperacion >= $limiteInicial && $resultadoOperacion <= $nivel->getLimite() && $contador < $cantidadDivisiones) || ($contador == $cantidadDivisiones && $resultadoOperacion >= $limiteInicial)){
										echo "<td style=\"background-color:".$nivel->getColor()."\">
												".$resultadoOperacion.": ".$nivel->getDescriptor()."
											</td>";
									}
									$contador++;
									$limiteInicial = $nivel->getLimite();
								}
								echo "
								<td>
									".$analisis->getMedidaControl()."
								</td>
								<td>
									".$analisis->getCalificacionMedida()."
								</td>

								<td>
									<input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\" cargarPagina('../interfaz/IAnalisis/IModificarAnalisis.php?idAnalisis=".$analisis->getId()."')\"/></td>
								</td>
								<td>
									<a class=\"waves-effect waves-light btn modal-trigger\" onclick=\" asignarID(".$analisis->getId().")\" href=\"#Meliminar\">Eliminar</a>
								</td>
							</tr>";
						}	
					}
					?>
				</tbody>
			</table>
			<?php  
				}else{
					echo "<h3>A&uacute;n no hay riesgos analizados</h3>";
				}
			?>	
		</div>
			<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
				<div class="modal-content">
					<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				</div>
				<div class="modal-footer blue darken-3 z-depth-5">
					<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
					<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="confirmarEliminar()"/>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	var idJs;
	function asignarID(id)
    {
        idJs = id;
    }
    function confirmarEliminar(){
        eliminarAnalisis(idJs);
    }
    $(document).ready(function(){
		$('.modal-trigger').leanModal();
	});
	</script>
