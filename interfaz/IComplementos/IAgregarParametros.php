<?php 
    include ("../../controladora/ctrDatosSevri.php") ;
    $ctrDatos = new ctrDatosSevri;
    $listaParametros = $ctrDatos->obtenerParametros();
    $listaParametrosActivos = $ctrDatos->obtenerParametrosSevriNuevo();
	foreach ($listaParametros as $parametro) {
		$arr[] = array(
		'_id' => $parametro->getIdParametro(),
		'descriptor' => $parametro->getDescriptorParametro(),
		'tipo' => $parametro->getNombreParametro(),
		'valor' => $parametro->getValorParametro(),
		'descripcion' => $parametro->getDescripcionParametro(),
		'color' => $parametro->getColorParametro()
		); 	
	}
	$ArrayJson = json_encode($arr);
?>
<script>
	window.onload=ocultarBarra();
</script>

<h3>Agregar par&aacutemetros al SEVRI</h3>
<div id="contenedorGeneralParametros">
	<div id="divParametros">
		<form id="agregarParametrosSevri" role="form" class="responsive">
			<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
				<p>
					<input class="with-gap" name="group1" type="radio" id="radioProbabilidad" onclick="mostarTabla('contenedorTablaProbabilidad')" checked />
					<label for="radioProbabilidad" class="white-text">Par&aacutemetros Probabilidad</label>
				</p>
				<p>
					<input class="with-gap" name="group1" type="radio" id="radioImpacto" onclick="mostarTabla('contenedorTablaImpacto')" />
					<label for="radioImpacto" class="white-text">Par&aacutemetros Impacto</label>				
				</p>
				<p>
					<input class="with-gap" name="group1" type="radio" id="radioCalificacion" onclick="mostarTabla('contenedorTablaCalificacion')" />
					<label for="radioCalificacion" class="white-text">Calificaci&oacuten Medida</label>
				</p>
			</div>
		</form>
		<div class="col s12 m3 l3">
			<input type="button" value="Crear Parametro" class="btn">
		</div>
	</div>

<div id="contenedorTablaProbabilidad" class="row" >
<h3>Valores de probabilidad para agregar</h3>
	<div class="col s12 m8 l8">
		<div id="div1">
			<table class="responsive-table responsive striped centered" id="tbParametros">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Valor</th>
						<th>Opci&oacuten 1</th>
						<th>Opci&oacuten 2</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$encontrado = false;
					foreach ($listaParametros as $parametro) {
						if(strcmp ($parametro->getNombreParametro() , "Probabilidad")==0){
							if($listaParametrosActivos){
								foreach ($listaParametrosActivos as $paramActivo) {
									if(($encontrado == false) && ($paramActivo->getIdParametro() == $parametro->getIdParametro())){
										$encontrado = true;	
									}
								}
							}
							if($encontrado == true){
								echo "<tr id=\"".$parametro->getIdParametro()."\" style=\"display:none\">";
								$encontrado = false;
							}else{
								echo "<tr id=\"".$parametro->getIdParametro()."\" >";
							}
								echo "<td>".$parametro->getDescriptorParametro()."</td>";
								echo "<td>".$parametro->getValorParametro()."</td>";
								echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
								echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Probabilidad')\"></td>";
								echo "<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$parametro->getIdParametro()."),  mostrarDatosModal()\" href=\"#Mmostrar\">Ver detalles</a></td></tr>";
						}
					}
						?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="contenedorTablaImpacto" style="display:none">
<h3>Valores de impacto para agregar</h3>
	<div class="col s12 m8 l8">
		<div id="div1">
			<table class="responsive-table responsive ParametrosImpacto striped centered" id="tbParametros">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Valor</th>
						<th>Opci&oacuten 1</th>
						<th>Opci&oacuten 2</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$encontrado = false;
					foreach ($listaParametros as $parametro) {
						if(strcmp ($parametro->getNombreParametro() , "Impacto")==0){
							if($listaParametrosActivos){
								foreach ($listaParametrosActivos as $paramActivo) {
									if(($encontrado == false) && ($paramActivo->getIdParametro() == $parametro->getIdParametro())){
										$encontrado = true;	
									}
								}
							}
							if($encontrado == true){
								echo "<tr id=\"".$parametro->getIdParametro()."\" style=\"display:none\">";
								$encontrado = false;
							}else{
								echo "<tr id=\"".$parametro->getIdParametro()."\" >";
							}
								echo "<td>".$parametro->getDescriptorParametro()."</td>";
								echo "<td>".$parametro->getValorParametro()."</td>";
								echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
								echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Impacto')\"></td>";
								echo "<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$parametro->getIdParametro()."),  mostrarDatosModal()\" href=\"#Mmostrar\">Ver detalles</a></td></tr>";
						}
					}
						?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="contenedorTablaCalificacion" style="display:none">
<h3>Valores de medida calificaci&oacuten para agregar</h3>
	<div class="col s12 m8 l8">
		<div id="div1">
			<table class="responsive-table striped responsive ParametrosCalificacion centered" id="tbParametros">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Valor</th>
						<th>Opci&oacuten 1</th>
						<th>Opci&oacuten 2</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$encontrado = false;
					foreach ($listaParametros as $parametro) {
						if(strcmp ($parametro->getNombreParametro() , "Calificacion")==0){
							if($listaParametrosActivos){
								foreach ($listaParametrosActivos as $paramActivo) {
									if(($encontrado == false) && ($paramActivo->getIdParametro() == $parametro->getIdParametro())){
										$encontrado = true;	
									}
								}
							}
							if($encontrado == true){
								echo "<tr id=\"".$parametro->getIdParametro()."\" style=\"display:none\">";
								$encontrado = false;
							}else{
								echo "<tr id=\"".$parametro->getIdParametro()."\" >";
							}
								echo "<td>".$parametro->getDescriptorParametro()."</td>";
								echo "<td>".$parametro->getValorParametro()."</td>";
								echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
								echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Calificación')\"></td>";
								echo "<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$parametro->getIdParametro()."),  mostrarDatosModal()\" href=\"#Mmostrar\">Ver detalles</a></td></tr>";
						}
					}
						?>
				</tbody>
			</table>
		</div>
	</div>
</div>
		
<h3>Par&aacutemetros Agregados</h3>
<div class="col s12 m8 l8 ">
	<div id="div1">
		<table class="responsive-table striped responsive centered" id="tbParametrosAgregados">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Valor</th>
					<th>Tipo Par&aacutemetro</th>
					<th>Opci&oacuten 1</th>
					<th>Opci&oacuten 2</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if($listaParametrosActivos){
					foreach ($listaParametrosActivos as $parametro) {
						echo "<tr id=\"".$parametro->getIdParametro()."\">";
							echo "<td>".$parametro->getDescriptorParametro()."</td>";
							echo "<td>".$parametro->getValorParametro()."</td>";
							echo "<td>".$parametro->getNombreParametro()."</td>";
							echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
							echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
							echo "<td> <input type=\"button\" value=\"Descartar\" class=\"btn btn-default\" onclick=\"removerParametros(this,'".$parametro->getIdParametro()."')\"></td>";
							echo "<td><a class=\"waves-effect waves-light btn modal-trigger\" onclick=\"asignarID(".$parametro->getIdParametro()."),  mostrarDatosModal()\" href=\"#Mmostrar\">Ver detalles</a></td></tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<div id="Mmostrar" class="modal  blue darken-3 z-depth-5 white-text"></div>
<script>
var idJs;
function asignarID(id)
{
	idJs = id;
}
$(document).ready(function() {
	$('select').material_select();
});
$(document).ready(function(){
	$('.modal-trigger').leanModal();
});
function mostrarDatosModal(){
	var lparametros = eval(<?php echo $ArrayJson ?>);
	for(i=0;i<lparametros.length;i++){
		if(lparametros[i]._id == idJs){
			$('#Mmostrar').html('<div class="col s12 m8 l8 blue darken-3 z-depth-5"><table class="responsive-table bordered"><tbody><tr><td><h5>Nombre:</h5></td><td><h5>' + lparametros[i].descriptor + '</h5></td></tr><tr><td><h5>Tipo de par&aacutemetro:</h5></td><td><h5>' + lparametros[i].tipo + '</h5></td></tr><tr><td><h5>Valor:</h5></td><td><h5>' + lparametros[i].valor + '</h5></td></tr><tr><td><h5>Descripci&oacuten:</h5></td><td><h5>' + lparametros[i].descripcion + '</h5></td></tr><tr><td><h5>Color:</h5></td><td><h5>' + lparametros[i].color + '</h5></td></tr></tbody></table></div>');
		}
	}
}
</script>
<script src="../js/jsParametros.js"></script>