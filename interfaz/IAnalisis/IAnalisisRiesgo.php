<script>
	window.onload=ocultarBarra();
</script>
<?php
	include_once ("../../Controladora/ctrListaRiesgo.php");
	include_once ("../../Controladora/ctrDatosSevri.php");
	$idRiesgo = $_GET['idRiesgo'];
	$controlRiesgo = new ctrListaRiesgo;
	$controlDatos = new ctrDatosSevri;
	$listaRiesgos = $controlRiesgo->obtenerRiesgo($idRiesgo);
	$listaParametros = $controlDatos->obtenerParametrosSevriActivo();
	$listaNiveles = $controlDatos->obtenerNivelesSevriActivo();
	$maximaProbabilidad = 0;
	$maximoImpacto = 0;
	foreach ($listaParametros as $parametro) {
		if (strcmp ($parametro->getNombreParametro() , "Probabilidad" ) == 0) {
			if($maximaProbabilidad < $parametro->getValorParametro()){
				$maximaProbabilidad = $parametro->getValorParametro();
			}
		}elseif (strcmp ($parametro->getNombreParametro() , "Impacto" ) == 0) {
			if($maximoImpacto < $parametro->getValorParametro()){
				$maximoImpacto = $parametro->getValorParametro();
			}
		}
		$arr[] = array(
		'_id' => $parametro->getIdParametro(),
		'descripcion' => $parametro->getDescripcionParametro(),
		'valorParametro' => $parametro->getValorParametro()
		); 	
	}
	$ArrayJson = json_encode($arr);
?>
<div class="row">
	<form class="responsive" id="IAnalisisRiesgo" method="Post" role="form">
		<div class="inputs blue darken-3 col s6 m6 l6 z-depth-5">	
	 		<h3>Analizar Riesgo</h3>
			<div class="">
				<label>Riesgo</label></br>
				<?php
					foreach ($listaRiesgos as $riesgo){
						if($riesgo->getId() == $idRiesgo) {
							echo $riesgo->getNombre()."</br></br>";
							echo "<input type=\"hidden\" id=\"riesgo\" name=\"riesgo\"  value=\"".$idRiesgo."\"/>";
						}
					}
				?>				
			</div>

			<div class="">
				<label>Probabilidad</label>
				<select id="probabilidad" name="probabilidad" onChange="mostrarDescripcionProbabilidad(this.value, <?php echo "$maximaProbabilidad"; ?>, <?php echo "$maximoImpacto"; ?>)">
					<option value="0" selected disabled>Selecione una probabilidad</option>
					<?php 
						foreach ($listaParametros as $parametro){
							if (strcmp ($parametro->getNombreParametro() , "Probabilidad" ) == 0) {
								echo "<option value=".$parametro->getIdParametro().">".$parametro->getValorParametro().": ".$parametro->getDescriptorParametro()."</option>";
							}
						}
					?>
				</select>
			</div>

			<div class="">
				<label>Impacto</label><br>
				<select id="impacto" name="impacto" onChange="mostrarDescripcionImpacto(this.value, <?php echo "$maximaProbabilidad"; ?>, <?php echo "$maximoImpacto"; ?>)">
					<option value="0" selected disabled>Seleccione un impacto</option> 
				<?php 
					foreach ($listaParametros as $parametro){
						if (strcmp ($parametro->getNombreParametro() , "Impacto" ) == 0) {
							echo "<option value=".$parametro->getIdParametro().">".$parametro->getValorParametro().": ".$parametro->getDescriptorParametro()."</option>";
						}
					}
				?>
				</select>
			</div>

			<div class="">
				<label>Calificación Nivel de Riesgo</label><br>
				<input type="hidden" id="valorProbabilidadSeleccionado" value="0">
				<input type="hidden" id="valorImpactoSeleccionado" value="0">
				<div class="mostrarNivel" id="visualizadorNivelRiesgo">
					
				</div>
			</div>

			<div class="">
				<label  for="medida">Medida de Control:</label>
				<input type="text" name="MedidaControl" id="MedidaControl">
			</div>


			<div class="">
				<label>Calificaci&oacute;n Medida</label><br>
				<select id="CalificacionMedida" name="CalificacionMedida" onChange="mostrarDescripcionCalificacion(this.value)">
					<option value="0" selected disabled>Seleccione una calificaci&oacute;n</option> 
					<?php 
						foreach ($listaParametros as $parametro){
							if (strcmp ($parametro->getNombreParametro() , "Calificacion" ) == 0) {
								echo "<option value=".$parametro->getIdParametro().">".$parametro->getDescriptorParametro()."</option>";
							}
						}
					?>
				</select>
			</div>
			<div>
				<input type="submit" value="Guardar" class="btn btn-default"></br></br>
			</div>	
		</div>
	</form>
	<div id="contenedorMensajes" class="contenedorMensajes col s6 m6 l6">
		<div id="divProbabilidad" class="divProbabilidad">
			<div id="mensajeProbabilidad" class="mensajeProbabilidad" style="display:none;"></div>
		</div>
		<div id="divImpacto" class="divImpacto">
			<div id="mensajeImpacto" class="mensajeImpacto" style="display:none;"></div>
		</div>
		<div id="mensajeCalificacion" class="mensajeCalificacion" style="display:none;"></div>
	</div>
</div>

<div style="display:none">
	<table id="tbNivelesRiesgoOcultos">
		<tbody>
			<?php 
			foreach ($listaNiveles as $nivel) {
				echo "<tr>";
					echo "<td>".$nivel->getLimite()."</td>";
					echo "<td>".$nivel->getDescriptor()."</td>";
					echo "<td>".$nivel->getDescripcion()."</td>";
					echo "<td>".$nivel->getColor()."</td>";
				echo "</tr>";
			}
			 ?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	
	function mostrarDescripcionProbabilidad(id, maximaProbabilidad, maximoImpacto) {
		if (id == 0) {
	        $("#mensajeProbabilidad").hide();
	    } else {
	        $("#mensajeProbabilidad").show();
			setTimeout(function() {
				$("#mensajeProbabilidad").fadeOut(5);
			},5000);
	    }
	    var lparametros = eval(<?php echo $ArrayJson ?>);
	    for(i=0;i<lparametros.length;i++){
			if(lparametros[i]._id == id){
				document.getElementById('valorProbabilidadSeleccionado').value = lparametros[i].valorParametro;
				document.getElementById('mensajeProbabilidad').innerHTML = lparametros[i].descripcion;
			}
		}
		crearNivelRiesgo(maximaProbabilidad, maximoImpacto);
	}

	function mostrarDescripcionImpacto(id, maximaProbabilidad, maximoImpacto) {
		if (id == 0) {
	        $("#mensajeImpacto").hide();
	    } else {
	        $("#mensajeImpacto").show();
			setTimeout(function() {
				$("#mensajeImpacto").fadeOut(5);
			},5000);
	    }
	    var lparametros = eval(<?php echo $ArrayJson ?>);
	    for(i=0;i<lparametros.length;i++){
			if(lparametros[i]._id == id){
				document.getElementById('valorImpactoSeleccionado').value = lparametros[i].valorParametro;
				document.getElementById('mensajeImpacto').innerHTML = lparametros[i].descripcion;
			}
		}
		crearNivelRiesgo(maximaProbabilidad, maximoImpacto);
	}
	function mostrarDescripcionCalificacion(id) {
		if (id == 0) {
	        $("#mensajeCalificacion").hide();
	    } else {
	        $("#mensajeCalificacion").show();
			setTimeout(function() {
				$("#mensajeCalificacion").fadeOut(5);
			},5000);
	    }
	    var lparametros = eval(<?php echo $ArrayJson ?>);
	    for(i=0;i<lparametros.length;i++){
			if(lparametros[i]._id == id){
				document.getElementById('mensajeCalificacion').innerHTML = lparametros[i].descripcion;
			}
		}
	}

 	$(document).ready(function() {
		    $("#IAnalisisRiesgo").validate({
		        rules: {
					probabilidad:{ required: true,},
					impacto: { required: true},
					MedidaControl: { required: true, minlength: 10, maxlength: 300},
					CalificacionMedida: { required: true}
		           
		        },
		        messages: {
					probabilidad:"Se debe seleccionar un valor de  probabilidad",
					impacto: "Se debe seleccionar un valor de impacto",
					MedidaControl: "No cumple con los requisitos establecidos",
					CalificacionMedida: "Se debe seleccionar un valor para la calificacion de la medida"
		           
		        },
		        submitHandler: function(form){
					if(document.getElementById('probabilidad').value == 0 || document.getElementById('impacto').value == 0 || document.getElementById('CalificacionMedida').value == 0) {
						Materialize.toast("Dede seleccionar un par&aacute;metro!", 7000, 'blue darken-3');
					} else {
						insertarAnalisis();
					}
		        }
		    });
		});
	$( document ).ready(function(){
	   $('select').material_select();
	});
</script>
</body>
</html>