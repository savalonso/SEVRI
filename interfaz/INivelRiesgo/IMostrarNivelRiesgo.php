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
	$NivelRiesgo = $ctrNivel->ObtenerNiveLRiesgoFiltrado();
	$idDivicion = $_GET['id']; 

 ?>

<div class="row">
	<div class="col s12 m8 l8">
		<div id="div1">
			 <table class="responsive-table responsive striped">
			 	<thead>
			 		<tr>
						<th>L&iacutemite</th>
						<th>Descriptor</th>
						<th>Descripci&oacuten</th>
						<th>Color</th>
						<th></th>
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
									echo "<td></td>";
								echo "</tr>";
							}
						}
						
					 for ($i=0; $i < count($NivelRiesgo) ; $i++) { 
						if($NivelRiesgo[$i]->getIdDivisiones() == $idDivicion){		
							if($NivelRiesgo[$i]->getEsEditable() == true){
							echo "<tr>";
								echo "<td colspan=\"4\">"."<input class=\"btn btn-default\" type=\"button\" id=\"btnModificarNivel\" value=\"Modificar\" onclick=\"invocarDivModificarNivel()\"/>"."<button type=\"button\" id=\"btnEliminarNivel\" style=\"padding:0 10px\"class=\"btnEliminar\" onclick=\"pasarIdParaEliminarNivel('".$idDivicion."')\"><a class=\" btnModal waves-effect waves-light btn modal-trigger\" href=\"#MeliminarNivel\">Eliminar</a> </button>"."</td>";
							echo "</tr>";
							$i=count($NivelRiesgo);	
						}else{
							echo "<tr>";
								echo "<td colspan=\"4\" >"."<input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Modificar\" onclick=\"invocarDivModificarAdmi()\"/>"."<input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" onclick=\"invocarDivModificarAdmi()\"/>"."</td>";
							echo "</tr>";
							$i=count($NivelRiesgo);	
						}	
					}	
					
				}
						
					?>
			 	</tbody>

			 </table>
		</div>

	</div>

</div>
	<!--  Modal para confirmar eliminación de nivel -->

	<div id="MeliminarNivel" class="modal  blue darken-3 z-depth-5 white-text">
		<div class="modal-content">
			<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
		</div>
		<div class="modal-footer blue darken-3 z-depth-5">
			<input type="hidden" id="idDivision" name="idDivision">
		 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarNivelRiesgo()" />
		</div>
	</div>

	<!-- Comienza el formulario para modificar el nivel de riesgo -->
<div class="row " id="contenedorFormModificarNiveles" style="display:none">
	<form id="IcrearNivelesRiesgo" method="Post" role="form" class="responsive">
		<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">

			<div class="row">
				<div class="col s12 m12 l12 blue darken-3 z-depth-5">
					<div id="div1">
						<table class="responsive-table responsive centered bordered" id="tablaModificarDivisiones">
							<thead>
								<tr>
									<th>De</th>
									<th>A</th>
									<th>Descriptor</th>
									<th>Descripción</th>
									<th>Color</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$contador = 0;
								$limiteAnterior = 0;
								foreach ($NivelRiesgo as $nivel) {
									if($nivel->getIdDivisiones() == $idDivicion){
										echo "<tr>";
											echo "<td style=\"display:none\"><input type=\"hidden\" id=\"inputId".$contador."\" value=\"".$nivel->getIdNivel()."\"></td>";
											echo "<td>".$limiteAnterior."%"."</td>";
											echo "<td>".$nivel->getLimite()."%"."</td>";
											echo "<td> <input type=\"text\" class=\"datoInput\" id=\"input01".$contador."\" value=\"".$nivel->getDescriptor()."\" placeholder=\"Dato: ".$nivel->getDescriptor()."\"></td>";
											echo "<td> <input type=\"text\" class=\"datoInput\" id=\"input02".$contador."\" value=\"".$nivel->getDescripcion()."\" placeholder=\"Dato: ".$nivel->getDescripcion()."\"></td>";
											echo "<td> <input type=\"color\" class=\"datoInput\" id=\"input03".$contador."\" value=\"".$nivel->getColor()."\" placeholder=\"Dato: ".$nivel->getColor()."\"></td>";
										echo "</tr>";
										$limiteAnterior = $nivel->getLimite();
										$contador++;
									}
								}

							 ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			 
			<div>
				<button type="button" class="btnModificar" ><a class="btnModal waves-effect waves-light btn modal-trigger" href="#MmodificarNivel">Modificar Niveles</a></button><br>
			</div>
			 
		</div>
	</form>
</div>

<!--  Modal para confirmar modificacion de nivel -->

	<div id="MmodificarNivel" class="modal  blue darken-3 z-depth-5 white-text">
		<div class="modal-content">
			<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
		</div>
		<div class="modal-footer blue darken-3 z-depth-5">
			<input type="hidden" id="idDivision" name="idDivision">
		 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="validarFormularioModificar()" />
		</div>
	</div>

<script>
  window.onload=ocultarBarra();
  $( document ).ready(function(){
  $('select').material_select();});
  $('.modal-trigger').leanModal();
</script>