<script type="text/javascript" src="../js/jsTablas.js"></script>
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
        	
				<div class="col s12 m8 l8 blue darken-3 z-depth-5">
					<div id="div1">
						<table class="responsive-table centered bordered">
							<thead >
								<tr >
									<th>Nombre Versi&oacuten</th>
									<th>Fecha Creaci&oacuten</th>
									<th>Opcion 1</th>
									<th>Opcion 2</th>
									<th>Opcion 3</th>
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
						
										if($sevri->getActivo()==1){
										 echo 	"<td style=\"text-align:center;\"><button class=\"btn btn-danger\" type=\"button\" onclick=\"paginaModificarSevri('".$sevri->getIdSevri()."') \"><span class='glyphicon glyphicon-pencil'></span> Modificar</button></td>";
										 echo 	"<td style=\"text-align:center;\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a></td>";
										 echo 	"<td style=\"text-align:center;\"><input type=\"hidden\" value=\"".$sevri->getIdSevri()."\" id=\"idSevri\"></input></td>";
										}else{
											echo "<td style=\"text-align:center;\"><button class=\"btn btn-danger\" type=\"button\"><span class='glyphicon glyphicon-pencil'></span>Registros</button></td>";
										}

										if($sevri->getEsNuevo()==1 && $sevri->getActivo() == 0){
											echo 	"<td style=\"text-align:center;\"><button class=\"btn btn-danger\" type=\"button\" onclick=\"activarSevri('".$sevri->getIdSevri()."') \"><span class='glyphicon glyphicon-pencil'></span> Activar</button></td>";
										}
										else if($sevri->getEsNuevo()==1 && $sevri->getActivo() == 1){
											echo 	"<td style=\"text-align:center;\"><button class=\"btn btn-danger\" type=\"button\" onclick=\"desactivarSevri('".$sevri->getIdSevri()."') \"><span class='glyphicon glyphicon-pencil'></span> Desactivar</button></td>";
										}else{
											echo 	"<td style=\"text-align:center;\"><button class=\"btn btn-danger\" type=\"button\" ><span class='glyphicon glyphicon-pencil'></span> Sin Opci&oacuten</button></td>";
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
			