<?php
	session_start();
    $tipo="";
    $cedula = $_SESSION['idUsuario'];
    if(isset($_SESSION['tipo'])){
        $tipo=$_SESSION['tipo'];
    }else{
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
    if($tipo!='Administrador'){
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
?>
<!DOCTYPE html>

<?php
include_once ("../../controladora/ctrListaUsuario.php");
$control = new ctrListaUsuario();
$listaUsuarios = $control->obtenerListaUsuarios();
?>

<script>
    window.onload=ocultarBarra();
</script>

<div class="row">
    <h4>Lista de Usuarios</h4>
    <div class="input-field buscar1 col s12 m8 l8">
        <label class="white-text" for="filtrar">Buscar</label>
        <input id="datosUsuario" type="text" >
    </div>
    <div class="col l4 m4 s4">
        <div id="añadir">
            <a id="boton" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip" data-position="top" data-tooltip="Agregar Usuarios" style="float: right; margin-top: 22px;" href="javascript:ocultarTooltipPorClase('../interfaz/IUsuarios/IRegistrarUsuarios.php')"><i class="material-icons">add</i></a>
        </div>
    </div>
    <?php  
        if($listaUsuarios!=null){
            if(count($listaUsuarios) == 1 && $listaUsuarios[0]->getCedula() == $cedula){
                ?>
                <div class="col s12 m12 l12">
                    <h4>No hay usuarios registrados</h4>
                </div>
                <?php
            } else {
    ?>
    <div class="col s12 m12 l12 scrollH">
        <table id="tbUsuario" class="bordered striped centered">
            <thead>
                <tr>
                    <th>C&eacutedula</th>
                    <th>Nombre</th>
                    <th><div style="width: 135px;"> Primer apellido</div></th>
                    <th><div style="width: 135px;"> Segundo apellido</div></th>
                    <th><div style="width: 135px;"> Fecha de registro</div></th>
                    <th><div style="width: 80px;"> Tel&eacutefono</div></th>
                    <th><div style="width: 135px;"> Correo electr&oacutenico</div></th>
                    <th><div style="width: 135px;"> Cargo</div></th>
                    <th><div style="width: 135px;"> Tipo</div></th>
                    <th>Opci&oacuten 1</th>
                    <th>Opci&oacuten 2</th>
                </tr>
            </thead>
            <tbody id="datosU">
                <?php
                    foreach ($listaUsuarios as $usuario) {
                        if($usuario->getCedula() != $cedula) {
                            echo "<tr>
                                    <td>
                                        ".$usuario->getCedula()."
                                    </td>
                                    <td>
                                        ".$usuario->getNombre()."
                                    </td>
                                    <td>
                                        ".$usuario->getPrimerApellido()."
                                    </td>
                                    <td>
                                        ".$usuario->getSegundoApellido()."
                                    </td>
                                    <td>
                                        ".$usuario->getFechaRegistro()."
                                    </td>
                                    <td>
                                        ".$usuario->getTelefono()."
                                    </td>
                                    <td>
                                        ".$usuario->getCorreo()."
                                    </td>
                                    <td>
                                        ".$usuario->getCargo()."
                                    </td>
                                    <td>
                                        ".$usuario->getTipo()."
                                    </td>
                                    <td>
                                        <input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"cargarPagina('../interfaz/IUsuarios/IModificarUsuario.php?cedula=".$usuario->getCedula()."')\"/></td>
                                    </td>
                                    <td>
                                        <a class=\"waves-effect waves-light btn modal-trigger\" id=\"btnEliminarUsuario\" onclick=\" asignarID(".$usuario->getCedula().")\" href=\"#Meliminar\">Eliminar</a>
                                    </td>
                                </tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        <?php  
            } else {
                ?>
                <div class="col s8 m8 l8">
                    <h4>No hay usuarios registrados</h4>
                </div>
                <div class="col s4 m4 l4">
                    <a id="boton" class="btn-floating tooltipped btn-large waves-effect waves-light blue linkTooltip" data-position="top" data-tooltip="Agregar Usuarios" style="float: right; margin-top: 22px;" href="javascript:ocultarTooltipPorClase('../interfaz/IUsuarios/IRegistrarUsuarios.php')"><i class="material-icons">add</i></a>
                </div>
                <?php
            }
        ?>
    </div>
        <div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
            <div class="modal-content">
                <h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
            </div>
            <div class="modal-footer blue darken-3 z-depth-5">
                <input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
                <input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="confirmarEliminar()"/>
            </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var idJs;
	function asignarID(id)
    {
        idJs = id;
    }
    function confirmarEliminar(){
        eliminarUsuario(idJs);
    }
    $(document).ready(function(){
		$('.modal-trigger').leanModal();
	});
    $(document).ready(function(){
        $('.tooltipped').tooltip({delay: 50});
    });
</script>
<script type="text/javascript" src="../js/jsUsuarios.js"></script>