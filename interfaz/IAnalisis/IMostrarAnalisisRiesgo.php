<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
	<script>
		window.onload=ocultarBarra();
	</script>

	<?php
		include_once ("../../controladora/ctrListaAnalisis.php");
		include_once ("../../Controladora/ctrDatosSevri.php");

		$idDepartamento=$_GET['id'];

		$controlDatos = new ctrDatosSevri;
		$controlAnalisis = new ctrListaAnalisis();
		$listaAnalisis = $controlAnalisis->obtenerListaAnalisis($idDepartamento);
	?>
	<div class="row">
		<?php  
		if($listaAnalisis==null){
			echo "<h4>A&uacuten no se ha realizado nungún análisis</h4>";
		}else{
			$listaNiveles = $controlDatos->obtenerNivelesSevriActivo();
			$cantidadDivisiones = count($listaNiveles);
			$valorFormula = $controlDatos->obtenerValorFormula();
		?>
			<h4>Lista de An&aacute;lisis</h4>
			<div class="input-field buscar1 col s12 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="datosAnalisis" type="text" >
	    	</div>
			<div class="col s12 m12 l12" id="scrollH">
					<table class="responsive-table responsive centered bordered">
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
						<tbody id="datosA">
							<?php
								foreach ($listaAnalisis as $analisis){
								echo "<tr>
										<td>
											".$analisis->getIdRiesgo()."
										</td>
										<td style=\"background-color:".$analisis->getProbabilidad()->getColorParametro()."\">
											".$analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro()."
										</td>
										<td style=\"background-color:".$analisis->getImpacto()->getColorParametro()."\">
											".$analisis->getImpacto()->getValorParametro().": ".$analisis->getImpacto()->getDescriptorParametro()."
										</td>";
										$limiteInicial = 0;
										$contador = 1;
										$resultadoOperacion = round(($analisis->getImpacto()->getValorParametro()*$analisis->getProbabilidad()->getValorParametro())/1*$valorFormula);
										foreach ($listaNiveles as $nivel) {
											if(($resultadoOperacion >= $limiteInicial && $resultadoOperacion <= $nivel->getLimite() && $contador < $cantidadDivisiones) || ($contador == $cantidadDivisiones && $resultadoOperacion >= $limiteInicial)){
												echo "<td style=\"background-color:".$nivel->getColor()."\">
														".$resultadoOperacion."%: ".$nivel->getDescriptor()."
													</td>";
											}
											$contador++;
											$limiteInicial = $nivel->getLimite();
										}
										echo "
										<td>
											".$analisis->getMedidaControl()."
										</td>
										<td style=\"background-color:".$analisis->getCalificacionMedida()->getColorParametro()."\">
											".$analisis->getCalificacionMedida()->getValorParametro().": ".$analisis->getCalificacionMedida()->getDescriptorParametro()."
										</td>

										<td>
											<input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\" cargarPagina('../interfaz/IAnalisis/IModificarAnalisis.php?idAnalisis=".$analisis->getId()."')\"/></td>
										</td>
										<td>
											<a class=\"waves-effect waves-light btn modal-trigger\" onclick=\" asignarID(".$analisis->getId().")\" href=\"#Meliminar\">Eliminar</a>
										</td>
									</tr>";
								}	
							?>
						</tbody>
					</table>
			</div>
		<?php  
		}
		?>
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
<script type="text/javascript" src="../js/jsAnalisis.js"></script>