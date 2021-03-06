<?php 
	session_start();
	if(!isset($_SESSION['tipo'])){
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
	}
?>
<!DOCTYPE html>

<?php
include_once ("../../controladora/ctrListaUsuario.php");
$control = new ctrListaUsuario();
$listaMensajes = $control->obtenerMensajesUsuario();
?>

<script>
    window.onload=ocultarBarra();
</script>

<div class="row">
	<?php  
        if($listaMensajes==null){
        	echo "<h4>Usted no tiene mensajes</h4>";
        }else{
	?>
    <h2>Lista de Mensajes</h2>
    <div class="col s12 m12 l12 blue darken-3 z-depth-5">
        <div id="div1">
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
                    	if($mensaje->getEsNuevo() == 1){
                    		echo "<tr style=\"background-color:#F39C12;\">
							        <td>
								        ".$mensaje->getNombreRemitente()."
							        </td>
							        <td>
								        ".$mensaje->getMensaje()."
							        </td>
							        <td> <input class=\"btn btn-default\" type=\"button\" value=\"Realizar Proceso\" onclick=\"dirigir_url_mensaje('".$mensaje->getDireccionPagina()."', '".$mensaje->getIdMensaje()."')\"/>
							        </td>
						        </tr>";
                    	}else{
                    		echo "<tr>
							        <td>
								        ".$mensaje->getNombreRemitente()."
							        </td>
							        <td>
								        ".$mensaje->getMensaje()."
							        </td>
							        <td> <input class=\"btn btn-default\" type=\"button\" value=\"Realizar Proceso\" onclick=\"dirigir_url_mensaje('".$mensaje->getDireccionPagina()."', '".$mensaje->getIdMensaje()."')\"/>
							        </td>
						        </tr>";
                    	}
                    }
                    ?>
				</tbody>
			</table>
        </div>
	</div>
	<?php  
    	}
	?>
</div>