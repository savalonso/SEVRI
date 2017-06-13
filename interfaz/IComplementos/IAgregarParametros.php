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
<?php 
    include ("../../controladora/ctrDatosSevri.php") ;
    $ctrDatos = new ctrDatosSevri;
    $listaParametros = $ctrDatos->obtenerParametros();
    $listaParametrosActivos = $ctrDatos->obtenerParametrosSevriNuevo();
    $TempProbabilidad = false;
	$TempImpacto=false;
	$TempCalificacion=false;

    if($listaParametros != null){
		foreach ($listaParametros as $parametro) {
			if($parametro->getNombreParametro() == "Impacto"){
				$TempImpacto=true;
			}else if($parametro->getNombreParametro() == "Probabilidad"){
				$TempProbabilidad = true;
			}else if($parametro->getNombreParametro() == "Calificacion"){
			 	$TempCalificacion=true;
			}
		}
	}

?>
<script>
	window.onload=ocultarBarra();
</script>

<div class="row">
		<h4 class="col s12 m8 l8">Agregar Par&aacutemetros al SEVRI</h4>
	</div>
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
			<input type="button" onclick="cargarPagina('../interfaz/IParametros/IcrearParametro.php')" value="Crear Parámetro" class="btn">
		</div>
	</div>

<div id="contenedorTablaProbabilidad" class="row" >
<?php 
	if($listaParametros != null && $TempProbabilidad == true){
?>
<h4>Valores de probabilidad para agregar</h4>
	<div class="col s12 m8 l8">
		<div id="div1">
			<table class="responsive-table responsive striped centered" id="tbParametros">
				<thead>
					<tr>
						<th>Valor</th>
						<th>Descriptor</th>
						<th>Descripci&oacuten</th>
						<th>Color</th>
						<th>Opci&oacuten 1</th>
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
								echo "<td>".$parametro->getValorParametro()."</td>";
								echo "<td>".$parametro->getDescriptorParametro()."</td>";
								echo "<td>".$parametro->getDescripcionParametro()."</td>";
								echo "<td><input class=\"btn btn-default\" type=\"button\" style=\"background-color:".$parametro->getColorParametro()."\"/></td>";
								echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
								echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Probabilidad')\"></td>";
								
						}
					}
						?>
				</tbody>
			</table>
		</div>
	</div>
	<?php 
		}else{
			echo "<h4>No se han creado parámetros de Probabilidad</h4>";
		}
	?>
</div>


<div id="contenedorTablaImpacto" style="display:none">
<?php 
	if($listaParametros != null && $TempImpacto == true){
?>
<h4>Valores de impacto para agregar</h4>
	<div class="col s12 m8 l8">
		<div id="div1">
			<table class="responsive-table responsive ParametrosImpacto striped centered" id="tbParametros">
				<thead>
					<tr>
						<th>Valor</th>
						<th>Descriptor</th>
						<th>Descripci&oacuten</th>
						<th>Color</th>
						<th>Opci&oacuten 1</th>
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
								echo "<td>".$parametro->getValorParametro()."</td>";
								echo "<td>".$parametro->getDescriptorParametro()."</td>";
								echo "<td>".$parametro->getDescripcionParametro()."</td>";
								echo "<td><input class=\"btn btn-default\" type=\"button\" style=\"background-color:".$parametro->getColorParametro()."\"/></td>";
								echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
								echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Impacto')\"></td>";
						}
					}
						?>
				</tbody>
			</table>
		</div>
	</div>
	<?php 
		}else{
			echo "<h4>No se han Creado parámetros de Impacto</h4>";
		}
	?>
</div>


<div id="contenedorTablaCalificacion" style="display:none">
<?php 
	if($listaParametros != null && $TempCalificacion == true){
?>
<h4>Calificaci&oacuten de medida para agregar</h4>
	<div class="col s12 m8 l8">
		<div id="div1">
			<table class="responsive-table striped responsive ParametrosCalificacion centered" id="tbParametros">
				<thead>
					<tr>
						<th>Valor</th>
						<th>Descriptor</th>
						<th>Descripci&oacuten</th>
						<th>Color</th>
						<th>Opci&oacuten 1</th>
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
								echo "<td>".$parametro->getValorParametro()."</td>";
								echo "<td>".$parametro->getDescriptorParametro()."</td>";
								echo "<td>".$parametro->getDescripcionParametro()."</td>";
								echo "<td><input class=\"btn btn-default\" type=\"button\" style=\"background-color:".$parametro->getColorParametro()."\"/></td>";
								echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
								echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Calificación')\"></td>";
						}
					}
						?>
				</tbody>
			</table>
		</div>
	</div>
<?php 
	}else{
		echo "<h4>No se han creado parámetros de Calificaci&oacuten de la medida</h4>";
	}
?>	
</div>
	
<h4>Par&aacutemetros agregados</h4>
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

<script src="../js/jsParametros.js"></script>