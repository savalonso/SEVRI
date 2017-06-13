<?php
	session_start();
    $tipo="";
    if(isset($_SESSION['tipo'])){
        $tipo=$_SESSION['tipo'];
    }else{
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
    if($tipo!='Administrador'){
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
?>
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
	<div class="row">
		<h4 class="col s12 m8 l8">Mostrar SEVRI</h4>
	</div>
	<?php if($lista){ ?>
			<div class="row">
			<div class="input-field buscar1 col s8 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="datosSevri" type="text" >
        	</div>
        	 <div class="col l4 m4 s4">
				<a id="boton" onclick="cargarPagina('../interfaz/ISevri/IcrearSevri.php');ocultarTooltip();" data-tooltip="Crear SEVRI" class="btn-floating tooltipped btn-large waves-effect waves-light blue" style="float: right;"><i class="material-icons">add</i></a>
			 </div>
				<div class="col s12 m12 l10">
					<div>
						<table class="responsive-table responsive2 striped centered" id="MostrarSevri">
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

			<div class="row ">
				<h4>Crear Reportes</h4>
				<form id="IcrearSevri" method="Get" role="form" action="../controladora/ctrReportes.php" class="responsive">
					<div class="inputs col s12 m6 l6 blue darken-3 z-depth-5">
						<div>
							<label class="white-text" for="sevriReporte">Seleccione el Sevri para realizar el reporte</label>
							<select name="sevriReporte" id="sevriReporte">
								<?php foreach ($lista as $sevri) { ?>
									
									<option value=<?php echo "\"".$sevri->getIdSevri()."\""; ?>><?php echo $sevri->getNombreVersion(); ?></option>

								<?php } ?>
							</select>
						</div>

						<input type="hidden" id="opcion" name="opcion" value="5">
						 
					 	<div>
					 		<input type="submit" value="Crear Reporte Excel" onclick="escogerTipoReporte(5)" class="btn btn-default">
					 	</div><br>

					 	<div>
					 		<input type="submit" value="Crear Reporte Word" onclick="escogerTipoReporte(10)" class="btn btn-default">
					 	</div><br>
						
					</div>
				</form>
			</div>
    	<?php  
		    }else{ ?>

				<div class="row">
					<h4 class="col s10 m10 l10">A&uacuten no se ha creado el SEVRI</h4>
					<div class="col l2 m2 s2">
						<a id="boton" href="#" onclick="cargarPagina('../interfaz/ISevri/IcrearSevri.php');ocultarTooltip();" data-tooltip="Crear SEVRI" class="btn-floating tooltipped btn-large waves-effect waves-light blue" style="float: right;"><i class="material-icons">add</i></a>
					</div>
				</div>
		<?php }?>	
			<script>
		  		$(document).ready(function(){
	   		  		$('.modal-trigger').leanModal();
	   		  		$('.tooltipped').tooltip({delay: 50});
	   		  		$('select').material_select();
  		   		});

			</script>
			