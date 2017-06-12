<?php
session_start();
if(!isset($_SESSION['tipo'])){
    echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
}
$IdAdministracion = $_GET['IdAdministracion'];
include_once ("../../controladora/ctrListaSeguimientos.php");
include_once ("../../controladora/ctrListaAdministracion.php");
include_once ("../../controladora/ctrListaUsuario.php");

$controlSeguimiento = new ctrListaSeguimientos();
$controlAdministracion = new ctrListaAdministracion();
$controlUsuario = new ctrListaUsuario();

$listaSeguimiento = $controlSeguimiento->obtenerSeguimiento($IdAdministracion);
$administracion = $controlAdministracion->obtenerAdministracion($IdAdministracion);//

$listaUsuario = $controlUsuario->obtenerListaUsuarios();

?>

<script>
    window.onload=ocultarBarra();
</script>

<div class="row">
    <div class="col s12 m12 l12">
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
        <?php
            if($listaSeguimiento!=null){
                if($porcentajeTotal < 100){
                    ?>
                        <a class="waves-effect waves-light btn modal-trigger" href="#MInsertar" style="margin-bottom: 7.5px;">Nuevo Avance</a>
                    <?php
                }
        ?>
            <table class="responsive-table centered bordered">
                <thead>
                    <tr>
                        <th>Comentario de avance</th>
                        <th>Porcentaje de avance</th>
                        <th>Opci&oacuten 1</th>
                        <th>Opci&oacuten 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($listaSeguimiento as $seguimiento){
                    ?>
                    <tr>
                        <td><?=$seguimiento->getComentarioAvance()?></td>
                        <td><?=$seguimiento->getPorcentajeAvance()?>%</td>
                        <?php
                            $aprobador = "Sin asignar";
                            foreach ($listaUsuario as $usuario){
                                if($usuario->getCedula() == $seguimiento->getUsuarioAprobador()){
                                    $aprobador = $usuario->getNombre()." ".$usuario->getPrimerApellido()." ".$usuario->getSegundoApellido();
                                }
                            }
                            echo "<td><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Mmostrar\" onClick=\"cargarModal('".number_format($seguimiento->getMontoSeguimiento(), 2, ',', '.')."','".$seguimiento->getComentarioAvance()."','".$seguimiento->getPorcentajeAvance()."','".$seguimiento->getFechaAvance()."','".$aprobador."')\">Ver detalles</a></td><td>";
                            if ($seguimiento->getArchivo() != "") {
                                echo "<button class=\"btn waves-effect waves-light\" onClick=\"document.location='../archivos/".$seguimiento->getArchivo()."'\">Descargar Archivo</button>";                       
                            } else {
                                echo "<button class=\"btn waves-effect waves-light\" disabled=\"disabled\">Descargar Archivo</button>";
                            }
                            echo "</td>";
                        ?>
                    </tr>
                    <?php
                        }
            } else {
            ?>
                <h4 class="red-text">No tiene seguimentos realizados!</h4>
            <?php
            }
            ?>
                </tbody>
            </table>
        </div>
    </div>
<div class="modal blue darken-3 z-depth-5 white-text" id="Mmostrar"></div>

<div class="modal blue darken-3 z-depth-5 white-text" id="MInsertar">
    <div class="inputs modal-content" id="contenido" style="width:100%;">
        <div id="contenidoFormulario">
        <form id="IRegistrarSeguimiento" method="Post" role="form">
            <input type="text" name="IdAdministracion" id="IdAdministracion" class="hide" value="<?php echo $IdAdministracion;?>">
            <h4>Avance de seguimiento</h4>
            <h5>Costo: ₡ <?=number_format($administracion->getCostoActividad(), 2, ',', '.')?></h5>
            <div class="">
                <label  for="monto">Monto del avance:</label>
                <input type="number" name="monto" id="monto" max="<?php echo $administracion->getCostoActividad()-$montoTotal ?>">
            </div>
            <div class="">
                <label  for="comentario">Comentario de avance:</label>
                <input type="text" name="comentario" id="comentario">
            </div>
            <div class="">
                <label  for="porcentaje">Porcentaje de avance:</label>
                <input type="number" name="porcentaje" id="porcentaje" max="<?php echo 100-$porcentajeTotal ?>">
            </div>
            <div class="">
                <label  for="aprobador">Aprobador:</label>
                <select id="aprobador" name="aprobador">
                    <option value="0" selected disabled>Seleccione un aprobador</option>
                    <?php
                    foreach ($listaUsuario as $usuario){
                        if($usuario->getCedula() != $_SESSION['idUsuario']){
                            echo "<option value=".$usuario->getCedula().">".$usuario->getNombre()." ".$usuario->getPrimerApellido()." ".$usuario->getSegundoApellido()."</option>";
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
            <center>
                <input type="submit" value="Guardar" class="btn-large btn-default" id="guardarAvance">
            </center>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
var variable = '<?php echo $IdAdministracion; ?>';
var montoMaximo = '<?php echo number_format($administracion->getCostoActividad()-$montoTotal, 2, ',', '.'); ?>';
var porcentajeMaximo = '<?php echo 100-$porcentajeTotal ?>';

    function descargarArchivo(archivo) {
        alert(archivo);
    }
   $(document).ready(function(){
		$('.modal-trigger').leanModal();
        $('select').material_select();
	});

    $(document).ready(function() {
        $("#IRegistrarSeguimiento").validate({
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
                aprobador:"Se debe seleccionar un aprobador"
            },
            submitHandler: function(form){
                if(document.getElementById('aprobador').value == 0) {
						Materialize.toast("Debe seleccionar un aprobador!", 7000, 'blue darken-3');
                } else {
                    $('#MInsertar').closeModal();
                    registrarSeguimiento(variable);
                }
            }
        });
    });
    function cargarModal(monto,comentario,porcentaje,fecha,aprobador){
        $('#Mmostrar').html('');
        $('#Mmostrar').html('<div class="col s12 m8 l8 blue darken-3 z-depth-5"><table class="responsive-table bordered"><tbody><tr><td>Monto:</td><td>₡ ' + monto + '</td></tr><tr><td>Comentario:</td><td>' + comentario + '</td></tr><tr><td>Porcentaje:</td><td>' + porcentaje + '%</td></tr><tr><td>Fecha del avance:</td><td>' + fecha + '</td></tr><tr><td>Nombre del aprobador:</td><td>' + aprobador + '</td></tr></tbody></table></div>');
    }
    $(document).ready(function(){
        $('.tooltipped').tooltip({delay: 50});
    });
</script>