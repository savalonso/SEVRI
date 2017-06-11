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
<form class="responsive" id="IAnalisisRiesgo" method="Post" role="form">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="inputs blue darken-3 col s6 m6 l6">
				<h3>Analizar Riesgo</h3>
				<label>Riesgo</label></br>
				<?php
					foreach ($listaRiesgos as $riesgo){
						if($riesgo->getId() == $idRiesgo) {
							echo $riesgo->getNombre()."</br>";
							echo "<input type=\"hidden\" id=\"riesgo\" name=\"riesgo\"  value=\"".$idRiesgo."\"/>";
						}
					}
				?>
				<br>
			</div>
			<div class="inputs col s6 m6 l6"></div>
		</div>
		<div class="col s12 m12 l12">
			<div class="inputs blue darken-3 col s6 m6 l6">
				<label>Probabilidad</label>
				<select id="probabilidad" name="probabilidad" onChange="verProbabilidad(this.value, <?php echo "$maximaProbabilidad"; ?>, <?php echo "$maximoImpacto"; ?>)">
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
			<div class="inputs col s6 m6 l6" style="padding: 10px;">
				<p id="pro_id" class="blue z-depth-5" style="padding: 10px; padding-right: 10px; margin: 0px; display: none;"></p>
			</div>
		</div>
		<div class="col s12 m12 l12">
			<div class="inputs blue darken-3 col s6 m6 l6">
				<label>Impacto</label><br>
				<select id="impacto" name="impacto" onChange="verImpacto(this.value, <?php echo "$maximaProbabilidad"; ?>, <?php echo "$maximoImpacto"; ?>)">
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
			<div class="inputs col s6 m6 l6" style="padding: 10px;">
				<p id="imp_id" class="blue z-depth-5" style="padding: 10px; padding-right: 10px; margin: 0px; display: none;"></p>
			</div>
		</div>
		<div class="col s12 m12 l12">
			<div class="inputs blue darken-3 col s6 m6 l6">
				<label>Calificación Nivel de Riesgo</label><br>
				<input type="hidden" id="valorProbabilidadSeleccionado" value="0">
				<input type="hidden" id="valorImpactoSeleccionado" value="0">
				<div class="mostrarNivel" id="visualizadorNivelRiesgo">
					
				</div>
			</div>
			<div class="inputs col s6 m6 l6"></div>
		</div>			
		<div class="col s12 m12 l12">
			<div class="inputs blue darken-3 col s6 m6 l6">
				<label  for="medida">Medida de Control:</label>
				<input type="text" name="MedidaControl" id="MedidaControl">
			</div>
			<div class="inputs col s6 m6 l6"></div>
		</div>
		<div class="col s12 m12 l12">
			<div class="inputs blue darken-3 col s6 m6 l6">
				<label>Calificaci&oacuten Medida</label><br>
				<select id="CalificacionMedida" name="CalificacionMedida" onChange="verCalificacion(this.value)">
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
			<div class="inputs col s6 m6 l6" style="padding: 10px;">
				<p id="cal_id" class="blue z-depth-5" style="padding: 10px; padding-right: 10px; margin: 0px; display: none;"></p>
			</div>
		</div>
		<div class="col s12 m12 l12">
			<div class="inputs blue darken-3 col s6 m6 l6">
				<input type="submit" value="Guardar" id="btnGuardarAnalisis" class="btn btn-default"><br><br>
			</div>
			<div class="inputs col s6 m6 l6"></div>
		</div>
	</div>
</form>
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
	function verProbabilidad(id, maximaProbabilidad, maximoImpacto) {
		var lparametros = eval(<?php echo $ArrayJson ?>);
		if (id == 0) {
			$("#pro_id").hide();
	    } else {
			for(i=0;i<lparametros.length;i++){
				if(lparametros[i]._id == id){
					document.getElementById('valorProbabilidadSeleccionado').value = lparametros[i].valorParametro;
					$("#pro_id").show();
					$("#pro_id").text(lparametros[i].descripcion);
					setTimeout(function() {
						$("#pro_id").fadeOut(5);
					},10000);
				}
			}
	    }
		crearNivelRiesgo(maximaProbabilidad, maximoImpacto);
	}

	function verImpacto(id, maximaProbabilidad, maximoImpacto) {
		var lparametros = eval(<?php echo $ArrayJson ?>);
		if (id == 0) {
			$("#imp_id").hide();
	    } else {
			for(i=0;i<lparametros.length;i++){
				if(lparametros[i]._id == id){
					document.getElementById('valorImpactoSeleccionado').value = lparametros[i].valorParametro;
					$("#imp_id").show();
					$("#imp_id").text(lparametros[i].descripcion);
					setTimeout(function() {
						$("#imp_id").fadeOut(5);
					},10000);
				}
			}
	    }
		crearNivelRiesgo(maximaProbabilidad, maximoImpacto);
	}
	function verCalificacion(id) {
		var lparametros = eval(<?php echo $ArrayJson ?>);
		if (id == 0) {
			$("#cal_id").hide();
	    } else {
			for(i=0;i<lparametros.length;i++){
				if(lparametros[i]._id == id){
					$("#cal_id").show();
					$("#cal_id").text(lparametros[i].descripcion);
					setTimeout(function() {
						$("#cal_id").fadeOut(5);
					},10000);
				}
			}
	    }
		crearNivelRiesgo(maximaProbabilidad, maximoImpacto);
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