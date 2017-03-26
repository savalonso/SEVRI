<!DOCTYPE html>

<?php
include_once ("../../controladora/ctrListaUsuarios.php");
$control = new ctrListaUsuarios();
$listaMensajes = $control->obtenerMensajesUsuario();
?>

<script>
    window.onload=ocultarBarra();
</script>

<div class="row">
    <h2>Lista de Mensajes</h2>
    <div class="col s12 m12 l12 blue darken-3 z-depth-5">
        <div id="div1">
            <?php  
                if($listaMensajes!=null){
	    	?>
            <table class="responsive-table centered bordered">
				<thead>
					<tr>
						<th>Remitente</th>
						<th>Mensaje</th>
						<th>Opcion</th>
					</tr>
				</thead>
				<tbody>
					<?php
                    foreach ($listaMensajes as $mensaje){
                        echo "<tr>
						        <td>
							        ".$mensaje->getNombreRemitente()."
						        </td>
						        <td>
							        ".$mensaje->getMensaje()."
						        </td>
						        <td> <input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"irPaginaEnlace('".$mensaje->getDireccionPagina()."')\"/>
						        </td>
					        </tr>";
                    }
                    ?>
				</tbody>
			</table>
            <?php  
                } else{
                    echo "<h3>Usted no tiene mensajes</h3>";
                }
            ?>
        </div>
	</div>
</div>