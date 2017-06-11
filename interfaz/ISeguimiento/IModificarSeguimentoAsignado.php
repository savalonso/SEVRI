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
	include_once('../../controladora/ctrListaSeguimientos.php');
	include_once ("../../controladora/ctrListaAdministracion.php");
	include_once ("../../controladora/ctrListaUsuario.php");

	$IdAdministracion = $_GET['idAdministracion'];
	$idSeguimiento = $_GET['idSeguimiento'];
	$control = new ctrListaSeguimientos;
	$listaSeguimiento = $control->obtenerSeguimiento($IdAdministracion);
	$controlAdministracion = new ctrListaAdministracion();
	$controlUsuario = new ctrListaUsuario();
	$listaSeguimiento = $control->obtenerSeguimiento($IdAdministracion);
	$administracion = $controlAdministracion->obtenerAdministracion($IdAdministracion);
	$listaUsuario = $controlUsuario->obtenerListaUsuarios();

	foreach($listaSeguimiento as $seguimiento){
		if($idSeguimiento == $seguimiento->getId()){
			$id = $seguimiento->getId();
			$actividad = $seguimiento->getActividadTratamiento();
			$monto = $seguimiento->getMontoSeguimiento();
			$estado = $seguimiento->getEstadoSeguimiento();
			$comentarioAprovador = $seguimiento->getComentarioAprobador();
			$comentarioAvance = $seguimiento->getComentarioAvance();
			$porcentaje = $seguimiento->getPorcentajeAvance();
			$fecha = $seguimiento->getFechaAvance();
			$aprobador = $seguimiento->getUsuarioAprobador();
			$archivo = $seguimiento->getArchivo();
		}
	}
?>

<script>
    window.onload=ocultarBarra();
</script>

<div class="row">
    <div class="col s12 m8 l8">
		<?php
        	$porcentajeTotal= 0;
        	$montoTotal = 0;
        	if($listaSeguimiento!=null){
            	foreach($listaSeguimiento as $seguimiento){
                	$porcentajeTotal += $seguimiento->getPorcentajeAvance();
                	$montoTotal += $seguimiento->getMontoSeguimiento();
            	}
        	}
        ?>
		<h5>Actividad: <?=$administracion->getActividadTratamiento()?> | Costo: ₡ <?=number_format($administracion->getCostoActividad(), 2, ',', '.')?></h5>
		<h5>Procentaje de avance: <?=$porcentajeTotal?>%</h5>
		<h5>Monto de avance: ₡ <?=number_format($montoTotal, 2, ',', '.')?></h5>
		<hr>
	</div>
	<div class="col s12 m8 l8 blue darken-3 z-depth-5">
    	<h4>Avance de seguimiento</h4>
		<form id="IModificarSeguimiento" method="Post" role="form">
			<div class="inputs" style="width: 100%;">
				<br>
				<input type="hidden" name="IdSeguimiento" id="IdSeguimiento" value="<?=$id?>">
				<div class="">
					<label  for="monto">Monto del avance:</label>
					<input type="number" name="monto" id="monto" max="<?php echo ($administracion->getCostoActividad()-$montoTotal)+$monto ?>" value="<?=$monto?>">
				</div>
				<div class="">
					<label  for="comentario">Comentario de avance:</label>
					<input type="text" name="comentario" id="comentario" value="<?=$comentarioAvance?>">
				</div>
				<div class="">
					<label  for="porcentaje">Porcentaje de avance:</label>
					<input type="number" name="porcentaje" id="porcentaje" max="<?php echo (100-$porcentajeTotal)+$porcentaje ?>" value="<?=$porcentaje?>">
				</div>
				<div class="">
					<label  for="aprobador">Aprobador:</label>
					<select id="aprobador" name="aprobador">
						<option value="0" selected disabled>Seleccione un aprobador</option>
						<?php
						foreach ($listaUsuario as $usuario){
							if($usuario->getCedula() != $_SESSION['idUsuario']){
								?>
								<option value="<?=$usuario->getCedula()?>" <?=($usuario->getCedula() == $aprobador)? "selected=\"selected\"": ""?>><?=$usuario->getNombre()." ".$usuario->getPrimerApellido()." ".$usuario->getSegundoApellido()?></option>;
								<?php
							}
						}
						?>
					</select>
				</div>
				<div class="file-field input-field">
					<div class="btn">
						<span>Archivo</span>
						<input type="file" name="archivo" id="archivo">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" name="nombreArchivo" id="nombreArchivo">
					</div>
				</div>
				<input type="submit" value="Modificar" class="btn btn-default">
				<br>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
var montoMaximo = '<?php echo number_format(($administracion->getCostoActividad()-$montoTotal)+$monto, 2, ',', '.'); ?>';
var porcentajeMaximo = '<?php echo (100-$porcentajeTotal)+$porcentaje ?>';

   $(document).ready(function(){
        $('select').material_select();
	});

    $(document).ready(function() {
        $("#IModificarSeguimiento").validate({
            rules: {
                monto:{ required: true},
                comentario:{ required: true},
                porcentaje:{ required: true},
                aprobador:{ required: true},
            },
            messages: {
                monto:"Se debe ingresar el monto para la actividad. Monto m&aacute;ximo ₡"+montoMaximo,
                comentario:"Se debe ingresar un comentario de avence",
                porcentaje:"Se debe ingresar un porcentaje de avance. Porcentaje m&aacute;ximo "+porcentajeMaximo+"%",
                aprobador:"Se debe seleccionar un aprobador",
            },
            submitHandler: function(form){
                if(document.getElementById('aprobador').value == 0) {
						Materialize.toast("Debe seleccionar un aprobador!", 7000, 'blue darken-3');
                } else {
                    modificarSeguimientoAsignado();
                }
            }
        });
    });
</script>
