<script>
	window.onload=ocultarBarra();
</script>

<?php
	include_once ("../../Controladora/ctrDatosSevri.php");
	include_once ("../../Controladora/ctrListaAnalisis.php");
	$idAnalisis = $_GET['idAnalisis'];
	$controAnalisis = new ctrListaAnalisis;
	$controlDatos = new ctrDatosSevri;
	$listaAnalisis = $controAnalisis->obtenerAnalisis($idAnalisis);
	$listaParametros = $controlDatos->obtenerParametrosSevriActivo();
	$listaRiesgos = $controlDatos->obtenerRiesgosSevriActivo();
	foreach ($listaAnalisis as $analisis) {
		$id = $analisis->getId();
		$idRiesgo = $analisis->getIdRiesgo();
		$probabilidad = $analisis->getProbabilidad();
		$impacto = $analisis->getImpacto();
		$nivelRiesgo = $analisis->getNivelRiesgo();
		$medidaControl = $analisis->getMedidaControl();
		$calificacionMedida = $analisis->getCalificacionMedida();
	}
	foreach ($listaParametros as $parametro) {
		$arr[] = array(
		'_id' => $parametro->getIdParametro(),
		'descripcion' => $parametro->getDescripcionParametro()
		); 	
	}
	$ArrayJson = json_encode($arr);
?>
<div class="row">
	<form class="responsive" id="IModificarAnalisis" method="Post" role="form">
		<div class="inputs blue darken-3 col s6 m6 l6 z-depth-5">
			<h3>Modificar An&aacute;lisis</h3>
			<div class="">
				<label>Riesgo</label></br>
				<?php
					foreach ($listaRiesgos as $riesgo){
						if($riesgo->getId() == $idRiesgo) {
							echo $riesgo->getNombre()."</br></br>";
						}
					}
				?>
			</div>
			<div class="">
				<label>Probabilidad</label>
				<select id="probabilidad" name="probabilidad" onChange="mostrarDescripcionProbabilidad(this.value)"> 
				<?php 
					foreach ($listaParametros as $parametro){
						if (strcmp ($parametro->getNombreParametro() , "Probabilidad" ) == 0) {
							if($probabilidad == $parametro->getIdParametro()) {
								echo "<option value=".$parametro->getIdParametro()." selected>".$parametro->getDescriptorParametro()."</option>";	
							} else {
								echo "<option value=".$parametro->getIdParametro().">".$parametro->getDescriptorParametro()."</option>";
							}
						}
					}
				?>
				</select>
			</div>
			<div class="">
				<label>Impacto</label><br>
				<select id="impacto" name="impacto" onChange="mostrarDescripcionImpacto(this.value)"> 
				<?php 
					foreach ($listaParametros as $parametro){
						if (strcmp ($parametro->getNombreParametro() , "Impacto" ) == 0) {
							if($impacto == $parametro->getIdParametro()) {
								echo "<option value=".$parametro->getIdParametro()." selected>".$parametro->getDescriptorParametro()."</option>";
							} else {
								echo "<option value=".$parametro->getIdParametro().">".$parametro->getDescriptorParametro()."</option>";
							}
						}
					}
				?>
				</select>
			</div>
			<div class="">
				<label  for="medida">Medida de Control:</label>
				<input type="text" name="MedidaControl" id="MedidaControl" value="<?php echo "$medidaControl";?>">
			</div>
			<div class="">
				<label>Calificaci&oacute;n Medida</label><br>
				<select id="CalificacionMedida" name="CalificacionMedida" onChange="mostrarDescripcionCalificacion(this.value)"> 
				<?php 
					foreach ($listaParametros as $parametro){
						if (strcmp ($parametro->getNombreParametro() , "Calificacion" ) == 0) {
							if($calificacionMedida == $parametro->getIdParametro()) {
								echo "<option value=".$parametro->getIdParametro()." selected>".$parametro->getDescriptorParametro()."</option>";	
							} else {
								echo "<option value=".$parametro->getIdParametro().">".$parametro->getDescriptorParametro()."</option>";
							}
						}
					}
				?>
				</select>
			</div>
			<div>
				<input type="hidden" name="id" id="id" value="<?php echo "$idAnalisis";?>">
			</div>
			<div>
				<a class="waves-effect waves-light btn modal-trigger" href="#Mconfirmar">Modificar</a></br></br>
			</div>
			<div id="Mconfirmar" class="modal blue darken-3 z-depth-5 white-text">
				<div class="modal-content">
					<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				</div>
				<div class="modal-footer blue darken-3 z-depth-5">
					<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
					<input type="submit" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				</div>
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
<script type="text/javascript">

	$(document).ready(function(){
		$('.modal-trigger').leanModal();
	});

	function mostrarDescripcionProbabilidad(id) {
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
				document.getElementById('mensajeProbabilidad').innerHTML = lparametros[i].descripcion;
			}
		}
	}	
	function mostrarDescripcionImpacto(id) {
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
				document.getElementById('mensajeImpacto').innerHTML = lparametros[i].descripcion;
			}
		}
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
		    $("#IModificarAnalisis").validate({
		        rules: {
		        	riesgo:{ required: true},
					probabilidad:{ required: true},
					impacto: { required: true},
					MedidaControl: { required: true, minlength: 10, maxlength: 300},
					CalificacionMedida: { required: true}
		           
		        },
		        messages: {
		            riesgo:"Se debe seleccionar un riesgo",
					probabilidad:"Se debe seleccionar un valor de  probabilidad",
					impacto: "Se debe seleccionar un valor de impacto",
					MedidaControl: "No cumple con los requisitos establecidos",
					CalificacionMedida: "Se debe seleccionar un valor para la calificacion de la medida"
		           
		        },
		        submitHandler: function(form){
					modificarAnalisis();
		        }
		    });
		});
	$( document ).ready(function(){
	   $('select').material_select();
	});
</script>
</body>
</html>