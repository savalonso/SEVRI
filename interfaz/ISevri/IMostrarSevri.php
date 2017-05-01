<script type="text/javascript" src="../js/jsTablas.js"></script>
<script type="text/javascript" src="../js/jsSevri.js"></script>

	<script>
		window.onload=ocultarBarra();
	</script>
	<?php
			include("../../controladora/ctrListaSevri.php");
			$control = new ctrListaSevri();
			$lista = $control->obtenerListaSevri();
			
	?>
	<?php  if($lista){?>

			
			<div class="row">
			<div class="input-group buscar1 col s12 m8 l8">
	        <label class="white-text" for="filtrar">Buscar</label>
	        <input id="filtrar" type="text" >
        	</div>
        	
				<div class="col s12 m12 l8">
					<div>
						<table class="responsive-table striped" id="MostrarSevri">
							<thead >
								<tr >
									<th>Nombre Versi&oacuten</th>
									<th>Fecha Creaci&oacuten</th>
									<th>Opci&oacuten 1</th>
									<th>Opci&oacuten 2</th>
									<th>Opci&oacuten 3</th>
									<th>Opci&oacuten 4</th>
								</tr>
							</thead>
							<tbody class="buscar">
								<?php 
								foreach ($lista as $sevri): 
								?>
									<tr>
										<td><?php echo $sevri->getNombreVersion();?></td>
										<td><?php echo $sevri->getFechaVersion();?></td>
						
										<?php 
						
										if($sevri->getActivo()==0 && $sevri->getEsNuevo()==1){
											echo 	"<td style=\"text-align:center;\"><button class=\"btn \" type=\"button\" onclick=\"paginaModificarSevri('".$sevri->getIdSevri()."') \">Modificar</button></td>";
											echo 	"<td style=\"text-align:center;\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a></td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn\" type=\"button\" onclick=\"cargarPagina('../interfaz/IComplementos/IConfigurarSevri.php') \">Configurar</button></td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn\" type=\"button\" onclick=\"activarSevri('".$sevri->getIdSevri()."') \">Activar</button></td>";
											echo 	"<td style=\"text-align:center;\"><input type=\"hidden\" value=\"".$sevri->getIdSevri()."\" id=\"idSevri\"></input></td>";
										}else if($sevri->getEsNuevo()==1 && $sevri->getActivo() == 1){
											echo 	"<td style=\"text-align:center;\"><button class=\"btn \" type=\"button\" disabled=\"true\">Modificar</button></td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn \" type=\"button\" disabled=\"true\">Eliminar</button></td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn\" type=\"button\" disabled=\"true\">Configurar</button></td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn\" type=\"button\" onclick=\"desactivarSevri('".$sevri->getIdSevri()."') \">Desactivar</button></td>";
										}else{
											echo 	"<td style=\"text-align:center;\"><button class=\"btn \" type=\"button\" disabled=\"true\">Modificar</button></td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn \" type=\"button\" disabled=\"true\">Eliminar</button></td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn\" type=\"button\" disabled=\"true\">Configurar</button></td>";
											echo 	"<td style=\"text-align:center;\"><button class=\"btn\" type=\"button\" disabled=\"true\">Activar</button></td>";
										}
										?>
										
									</tr>
								
								<?php 
								endforeach;
								?>
							</tbody>
						</table>
					</div>

					<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
			 		    <div class="modal-content">
						    <h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
						 </div>
						 <div class="modal-footer blue darken-3 z-depth-5">
						 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
						 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarSevri()"/>
					     </div>
		 			</div>
				</div>
			</div>
    <?php }else{?>
				<h3>A&uacuten no se ha creado el SEVRI </h3>
    	  <?php } ?>
			<script>
		  		$(document).ready(function(){
   		  		$('.modal-trigger').leanModal();
  		   		});

			</script>
			