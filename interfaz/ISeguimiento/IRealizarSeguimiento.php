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
    echo "<h5>Actividad: ".$administracion->getActividadTratamiento()." | Costo: ₡".number_format($administracion->getCostoActividad(), 2, ',', '.')."</h5>";
    echo "<h5>Procentaje de avance: ".$porcentajeTotal."%<h5>";
    echo "<h5>Monto de avance: ₡".number_format($montoTotal, 2, ',', '.')."<h5>";
    echo "<table class=\"responsive-table centered bordered\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Comentario de avance</th>";
    echo "<th>Porcentaje de avance</th>";
    echo "<th>Opci&oacuten 1</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    if($listaSeguimiento!=null){
        foreach($listaSeguimiento as $seguimiento){
            echo "<tr>";
            echo "<td>".$seguimiento->getComentarioAvance()."</td>";
            echo "<td>".$seguimiento->getPorcentajeAvance()."%</td>";
            $aprobador = "Sin asignar";
            foreach ($listaUsuario as $usuario){
                if($usuario->getCedula() == $seguimiento->getUsuarioAprobador()){
                    $aprobador = $usuario->getNombre();
                }
            }
            echo "<td><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Mmostrar\" onClick=\"cargarModal('".number_format($seguimiento->getMontoSeguimiento(), 2, ',', '.')."','".$seguimiento->getComentarioAvance()."','".$seguimiento->getPorcentajeAvance()."','".$seguimiento->getFechaAvance()."','".$aprobador."')\">Ver detalles</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td>NO TIENE SEGUIMIENTO REALIZADO!</tr></td>";
    }
    echo "</tbody>";
    echo "</table>";
    ?>
    </div>
</div>
<?php
    if($porcentajeTotal < 100){
        echo "<a class=\"waves-effect waves-light btn modal-trigger\" href=\"#MInsertar\">Nuevo Avance</a>";
    }
?>
<div class="modal blue darken-3 z-depth-5 white-text" id="Mmostrar">
</div>
<div class="modal blue darken-3 z-depth-5 white-text" id="MInsertar">
    <div class="inputs modal-content" id="contenido" style="width:100%;">
        <div id="contenidoFormulario">
        <form id="IRegistrarSeguimiento" method="Post" role="form">
            <input type="text" name="IdAdministracion" id="IdAdministracion" class="hide" value="<?php echo $IdAdministracion;?>">
            <h3>Avance de seguimiento</h3>
            <div class="">
                <label  for="monto">Monto:</label>
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
                    <?php
                    foreach ($listaUsuario as $usuario){
                        if($usuario->getCedula() != $_SESSION['idUsuario']){
                            echo "<option value=".$usuario->getCedula().">".$usuario->getNombre()."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Guardar" class="btn btn-default">
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
var variable = '<?php echo $IdAdministracion; ?>'
var montoMaximo = '<?php echo number_format($administracion->getCostoActividad()-$montoTotal, 2, ',', '.'); ?>'
var porcentajeMaximo = '<?php echo 100-$porcentajeTotal ?>'

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
                aprovador:{ required: true},
            },
            messages: {
                monto:"Se debe ingresar el monto para la actividad. Monto m&aacute;ximo ₡"+montoMaximo,
                comentario:"Se debe ingresar un comentario de avence",
                porcentaje:"Se debe ingresar un porcentaje de avance. Porcentaje m&aacute;ximo "+porcentajeMaximo+"%",
                aprobador:"Se debe seleccionar un aprobador"
            },
            submitHandler: function(form){
                registrarSeguimiento(variable);
            }
        });
    });
    function cargarModal(monto,comentario,porcentaje,fecha,aprobador){
        $('#Mmostrar').html('');
        $('#Mmostrar').html('<div class="col s12 m8 l8 blue darken-3 z-depth-5"><table class="responsive-table bordered"><tbody><tr><td><h5>Monto:</h5></td><td><h5>₡ ' + monto + '</h5></td></tr><tr><td><h5>Comentario:</h5></td><td><h5>' + comentario + '</h5></td></tr><tr><td><h5>Porcentaje:</h5></td><td><h5>' + porcentaje + '%</h5></td></tr><tr><td><h5>Fecha del avance:</h5></td><td><h5>' + fecha + '</h5></td></tr><tr><td><h5>Nombre del aprobador:</h5></td><td><h5>' + aprobador + '</h5></td></tr></tbody></table></div>');
    }
</script>