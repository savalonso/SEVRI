
	<?php 
	    include ("../../controladora/ctrDatosSevri.php") ;
		$ctrDatos = new ctrDatosSevri;
		$listaCategoriasActivas = $ctrDatos->obtenerCategoriasSevriNuevo();
		$listaParametros = $ctrDatos->obtenerParametros();
		$listaCategorias = $ctrDatos->obtenerCategorias();
		$listaDepartamentos = $ctrDatos->obtenerDepartamentos();
		$listaParametrosActivos = $ctrDatos->obtenerParametrosSevriNuevo();
		$listaDepartamentosAgregados = $ctrDatos->obtenerDepartamentosSevriNuevo();
		
	?>
<script>
	window.onload=ocultarBarra();
</script>
	
<div class="row indicator">
	<div class="col s12">
		<ul class="tabs">
			<li class="tab s4"><a href="#contenedorGeneralParametros">Par&aacutemetros</a></li>
			<li class="tab s4"><a href="#contenedorDepartamentos">Departamentos</a></li>
			<li class="tab s4"><a href="#contenedorCategorias">Categor&iacuteas</a></li>
		</ul>
	</div>
</div>
	
	<div id="contenedorGeneralParametros">
		<div class="row" id="divParametros">
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

		<div class="row" id="contenedorTablaProbabilidad">
		<h3>Valores de probabilidad para agregar</h3>
			<div class="col s12 m8 l8 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered" id="tbParametros">
						<thead>
							<tr>
								<th>Valor</th>
								<th>Nombre</th>
								<th>Descripci&oacuten</th>
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
										echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
										echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Probabilidad')\"></td>";
									echo "</tr>";
								}
							}
							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row" id="contenedorTablaImpacto" style="display:none">
		<h3>Valores de impacto para agregar</h3>
			<div class="col s12 m8 l8 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered" id="tbParametros">
						<thead>
							<tr>
								<th>Valor</th>
								<th>Nombre</th>
								<th>Descripci&oacuten</th>
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
										echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
										echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Impacto')\"></td>";
									echo "</tr>";
								}
							}
							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row" id="contenedorTablaCalificacion" style="display:none">
		<h3>Valores de medida calificaci&oacuten para agregar</h3>
			<div class="col s12 m8 l8 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered" id="tbParametros">
						<thead>
							<tr>
								<th>Valor</th>
								<th>Nombre</th>
								<th>Descripci&oacuten</th>
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
										echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
										echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$parametro->getIdParametro()."','1','Calificación')\"></td>";
									echo "</tr>";
								}
							}
							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<h3>Par&aacutemetros Agregados</h3>
			<div class="col s12 m8 l8 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered" id="tbParametrosAgregados">
						<thead>
							<tr>
								<th>Valor</th>
								<th>Nombre</th>
								<th>Descripci&oacuten</th>
								<th>Tipo Par&aacutemetro</th>
								<th>Opci&oacuten 1</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if($listaParametrosActivos){
								foreach ($listaParametrosActivos as $parametro) {
									echo "<tr id=\"".$parametro->getIdParametro()."\">";
										echo "<td>".$parametro->getValorParametro()."</td>";
										echo "<td>".$parametro->getDescriptorParametro()."</td>";
										echo "<td>".$parametro->getDescripcionParametro()."</td>";
										echo "<td>".$parametro->getNombreParametro()."</td>";
										echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
										echo "<td style=\"display: none\">".$parametro->getIdParametro()."</td>";
										echo "<td> <input type=\"button\" value=\"Descartar\" class=\"btn btn-default\" onclick=\"removerParametros(this,'".$parametro->getIdParametro()."')\"></td>";
									echo "</tr>";
								}
							}
							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<!-- hasta aquí llegan las tablas para agregar Parametros y comienza la tabla para agregar categorias -->

	<div id="contenedorCategorias">
		<div class="row" id="contenedorTablaCategorias">
		<h3>Categor&iacuteas para agregar</h3>
			<div class="col s12 m8 l8 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered" id="tbCategorias">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Descripci&oacuten</th>
								<th>Opci&oacuten 1</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$encontrada = false;
							foreach ($listaCategorias as $categoria) {
								if($listaCategoriasActivas){
									foreach ($listaCategoriasActivas as $categoriaAct) {
										if(($encontrada == false) && ($categoria->getIdCategoria()==$categoriaAct->getIdCategoria())){
											$encontrada = true;
										}
									}
								}
								if($encontrada == true){
									echo "<tr id=\"ca".$categoria->getIdCategoria()."\" style=\"display:none\">";
									$encontrada = false;
								}else{
									echo "<tr id=\"ca".$categoria->getIdCategoria()."\" >";
								}
								
									echo "<td>".$categoria->getNombreCategoria()."</td>";
									echo "<td>".$categoria->getDescripcion()."</td>";
									echo "<td style=\"display: none\">".$categoria->getIdCategoria()."</td>";
									echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$categoria->getIdCategoria()."','2')\"></td>";
								echo "</tr>";
							}
							 ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col s12 m3 l3">
				<input type="button" value="Crear Categoria" class="btn">
			</div>
		</div>

		<div class="row">
			<h3>Categor&iacuteas Agregadas</h3>
			<div class="col s12 m8 l8 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered" id="tbCategoriasAgregadas">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Descripci&oacuten</th>
								<th>Opci&oacuten 1</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if($listaCategoriasActivas){
								foreach ($listaCategoriasActivas as $categoriaAct) {
									echo "<tr id=\"ca".$categoriaAct->getIdCategoria()."\">";
										echo "<td>".$categoriaAct->getNombreCategoria()."</td>";
										echo "<td>".$categoriaAct->getDescripcion()."</td>";
										echo "<td style=\"display: none\">".$categoriaAct->getIdCategoria()."</td>";
										echo "<td> <input type=\"button\" value=\"Descartar\" class=\"btn btn-default\" onclick=\"quitarCategoria(this, 'ca".$categoriaAct->getIdCategoria()."','".$categoriaAct->getIdCategoria()."')\"></td>";
									echo "</tr>";
								}
							}
							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	

<!-- hasta aquí llegan las tablas para agregar Categorias y comienza el formulario para agregar Departamentos-->

	<div id="contenedorDepartamentos">
		
		<div class="row" id="contenedorTablaCategorias">
		<h3>Departamentos para agregar</h3>
			<div class="col s12 m8 l8 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered" id="tbDepartamentos">
						<thead>
							<tr>
								<th>C&oacutedigo Departamento</th>
								<th>Nombre Departamento</th>
								<th>Opci&oacuten 1</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$encontrada = false;
							foreach ($listaDepartamentos as $departamento) {
								if($listaDepartamentosAgregados){
									foreach ($listaDepartamentosAgregados as $depAgregado) {
										if(($encontrada == false) && ($departamento->getIdDepartamento()==$depAgregado->getIdDepartamento())){
											$encontrada = true;
										}
									}
								}
								if($encontrada == true){
									echo "<tr id=\"de".$departamento->getIdDepartamento()."\" style=\"display:none\">";
									$encontrada = false;
								}else{
									echo "<tr id=\"de".$departamento->getIdDepartamento()."\" >";
								}
								
									echo "<td>".$departamento->getCodigoDepartamento()."</td>";
									echo "<td>".$departamento->getNombreDepartamento()."</td>";
									echo "<td style=\"display: none\">".$departamento->getIdDepartamento()."</td>";
									echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$departamento->getIdDepartamento()."','3')\"></td>";
								echo "</tr>";
							}
							 ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col s12 m3 l3">
				<input type="button" value="Crear Departamento" class="btn">
			</div>
		</div>

		<div class="row">
			<h3>Departamentos Agregados</h3>
			<div class="col s12 m8 l8 blue darken-3 z-depth-5">
				<div id="div1">
					<table class="responsive-table centered bordered" id="tbDepartamentosAgregadas">
						<thead>
							<tr>
								<th>C&oacutedigo Departamento</th>
								<th>Nombre Departamento</th>
								<th>Opci&oacuten 1</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if($listaDepartamentosAgregados){
								foreach ($listaDepartamentosAgregados as $depAgregado) {
									echo "<tr id=\"de".$depAgregado->getIdDepartamento()."\">";
										echo "<td>".$depAgregado->getCodigoDepartamento()."</td>";
										echo "<td>".$depAgregado->getNombreDepartamento()."</td>";
										echo "<td style=\"display: none\">".$depAgregado->getIdDepartamento()."</td>";
										echo "<td> <input type=\"button\" value=\"Descartar\" class=\"btn btn-default\" onclick=\"quitarDepartamento(this, 'de".$depAgregado->getIdDepartamento()."','".$depAgregado->getIdDepartamento()."')\"></td>";
									echo "</tr>";
								}
							}
							 ?>
						</tbody>
					</table>
				<div id="div1">
			</div>
		</div>
	</div>

<script>
	$(document).ready(function() {
    $('select').material_select();
  	});

  	$(document).ready(function(){
    $('ul.tabs').tabs();
  	});
</script>