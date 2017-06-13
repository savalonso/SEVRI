<!DOCTYPE html>
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
		include ("../../Controladora/ctrListaCategoria.php");
		$control = new ctrListaCategoria;	
		$lista =$control->obtenerListaCategoriasDE();
		$TempSubCategoria = false;
		$TempCategoria=false;
		
		if($lista != null){
			foreach ($lista as $temp) {
				if($temp->getHijoDe() == 0){
					$TempCategoria=true;
				}else if($temp->getHijoDe() != 0){
					$TempSubCategoria = true;
				}
			}
		}
		if($lista!=null){
			foreach ($lista as $categorias) {
				$arr[] = array(
				'_id' => $categorias->getIdCategoria(),
			    'nombre' => utf8_encode($categorias->getNombreCategoria()),
			    'padre' => utf8_encode($categorias->getHijoDe()),
			    'descripcion' => utf8_encode($categorias->getDescripcion())
	    		); 	
			}
			$ArrayJson =json_encode($arr);
		}
		
	?>
	<script>
		window.onload=ocultarBarra();
	</script>			

	
		
		
		
		<?php  
			if($lista!=null && $TempCategoria == true){
		?>
		<div class="row">
			<h4 class="col s12 m8 l8">Lista de Categor&iacuteas</h4>
			<div class="col s4 m4 l4">
				<a id="boton" onclick="cargarPagina('../interfaz/ICategoria/IInsertarCategoria.php');ocultarTooltip();" data-tooltip="Crear Categoría" class="btn-floating tooltipped btn-large waves-effect waves-light blue" style="float: right;"><i class="material-icons">add</i></a>
			</div>
		</div>
		<div class="row">

			<div class="input-field buscar1 col s12 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="datosCategoria" type="text" >
        	</div>
			<div class="col s12 m12 l12 scrollH" >
				<table class="responsive-table responsive2 striped" id="categoria">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripci&oacuten</th>
							<th>Modificar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody id="categoria1">
						<?php 
						if($lista==null){
							echo "NO HAY REGISTROS AUN";
						}else{
							foreach ($lista as $categoria){
					            if($categoria->getHijoDe()==0){
					            	echo $categoria->getCantSevri();
					            	echo "<tr>					        
						        	<td>".$categoria->getNombreCategoria()."</td>
						        	<td>".$categoria->getDescripcion()."</td>";
						        	if($categoria->getCantRiesgos()>0 || $categoria->getCantHijos()>0 || $categoria->getCantSevri()!=0){
						        		echo "<td><input class=\"btn btn-default btnAccionCrud\" disabled=\"true\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ICategoria/IModificarCategoria.php?idCategoria=".$categoria->getIdCategoria()."')\"/></td>";
						        	}else{
					        			echo "<td><input class=\"btn btn-default btnAccionCrud\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ICategoria/IModificarCategoria.php?idCategoria=".$categoria->getIdCategoria()."')\"/></td>";
					        		}
					        		if ($categoria->getCantHijos()>0 || $categoria->getCantRiesgos()>0 || $categoria->getCantSevri()!=0){
					    					echo "<td style=\"text-align:center;\"><button type=\"button\" disabled=\"true\" class=\"btnEliminar btnModal\"><a class=\"waves-effect waves-light btn disabled\">Eliminar</a> </button>  </td>
					    					</tr>";
					        		}else{
					        			echo "<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar btnModal\" onclick=\"confirmarModificacionEliminacionCategoria('".$categoria->getIdCategoria()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
					    					</tr>";
					        		}
					            }
							}
						}
						?>
					</tbody>
					</table>
			</div>	
			<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
	 		    <div class="modal-content">
				    <h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				 </div>
				 <div class="modal-footer blue darken-3 z-depth-5">
				 	<input type="hidden" id="idCategoria" name="idCategoria">
				 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat btnAccionCrud" onclick="eliminarCategoria()"/>
			     </div>
 			</div>
		</div>
		<?php }else{ ?>
				<div class="row">
					<h4 class="col s12 m8 l8">No se han creado categor&iacuteas</h4>
					<div class="col s4 m4 l4">
						<a id="boton" onclick="cargarPagina('../interfaz/ICategoria/IInsertarCategoria.php');ocultarTooltip();" data-tooltip="Crear Categoría" class="btn-floating tooltipped btn-large waves-effect waves-light blue" style="float: right;"><i class="material-icons">add</i></a>
					</div>
				</div>
			<?php } ?>

			<?php  
				if($lista!=null && $TempSubCategoria == true){
			?>
			<div class="row">
				<h4>Lista de Sub Categor&iacuteas</h4>
				<div class="input-field buscar1 col s12 m8 l8">
			        <label class="white-text" for="filtrar">Buscar</label>
			        <input id="datosSubCategoria"  type="text" >
        		</div>
				<div class="col s12 m12 l12 scrollH">
					<div>
						<table class="responsive-table responsive2 striped" id="subCategorias">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Descripci&oacuten</th>
									<th>Modificar</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody id="tbody" class="subcategoria">
								<?php 
									$contador=1;
									if($lista==null){
										echo "SELECCIONE UNA CATEGOR&IacuteA";
									}else{
										foreach ($lista as $categoria){
								            if($categoria->getHijoDe() != 0){
								            	echo "<tr id=\"tr".$contador."\">
								            	<td style=\"display:none\">".$categoria->getHijoDe()."</td>
									        	<td>".$categoria->getNombreCategoria()."</td>
									        	<td>".$categoria->getDescripcion()."</td>";
									        	if($categoria->getCantRiesgos()>0){
									        		echo "<td><input class=\"btn btn-default\" disabled=\"true\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ICategoria/IModificarCategoria.php?idCategoria=".$categoria->getIdCategoria()."')\"/></td>";
									        	}else{
									        		echo "<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ICategoria/IModificarCategoria.php?idCategoria=".$categoria->getIdCategoria()."')\"/></td>";
									        	}
								        		if ($categoria->getCantRiesgos()>0){
								    					echo "<td style=\"text-align:center;\"><button type=\"button\" disabled=\"true\" class=\"btnEliminar\"><a class=\"waves-effect waves-light btn disabled\">Eliminar</a> </button>  </td>
								    					</tr>";
								        		}else{
								        			echo "<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarModificacionEliminacionCategoria('".$categoria->getIdCategoria()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
								    				</tr>";
								        		}
								        		$contador++;
								            }
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php }else{ ?>
				<div class="row">
					<h4 class="col s12 m8 l8">No se han creado subcategor&iacuteas</h4>
				</div>
			<?php } ?>
	

	<script type="text/javascript" src="../js/jsCategoria.js"></script>	
