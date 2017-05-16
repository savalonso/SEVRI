<!DOCTYPE html>
	<?php

	session_start();
	if($_SESSION['tipo']=='Administrador'){
		include ("../../Controladora/ctrListaCategoria.php");
		$control = new ctrListaCategoria;	
		$lista =$control->obtenerListaCategoriasDE();

		foreach ($lista as $categorias) {
			$arr[] = array(
			'_id' => $categorias->getIdCategoria(),
		    'nombre' => utf8_encode($categorias->getNombreCategoria()),
		    'padre' => utf8_encode($categorias->getHijoDe()),
		    'descripcion' => utf8_encode($categorias->getDescripcion())
    		); 	
		}
		$ArrayJson =json_encode($arr);
	?>
	<script>
		window.onload=ocultarBarra();
	</script>			

	<div class="row">
		<h2>Lista de Categor&iacuteas</h2>
		<div class="input-field buscar1 col s12 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="datosCategoria" type="text" >
        	</div>
		<div class="col s12 m12 l12">
		<?php  
			if($lista!=null){
		?>
			<div>
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
					            	echo "<tr>					        
						        	<td><a href=\"#\" onclick=\"agregarSubCategorias('".$categoria->getIdCategoria()."')\">".$categoria->getNombreCategoria()."</a></td>
						        	<td>".$categoria->getDescripcion()."</td>
					        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ICategoria/IModificarCategoria.php?idCategoria=".$categoria->getIdCategoria()."')\"/></td>";
					        		if ($categoria->getCantHijos()>0 || $categoria->getCantRiesgos()>0){
					    					echo "<td style=\"text-align:center;\"><button type=\"button\" disabled=\"true\" class=\"btnEliminar\"><a class=\"waves-effect waves-light btn disabled\">Eliminar</a> </button>  </td>
					    					</tr>";
					        		}else{
					        			echo "<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarModificacionEliminacionCategoria('".$categoria->getIdCategoria()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Eliminar</a> </button>  </td>
					    					</tr>";
					        		}
					            }
							}
						}
						?>
					</tbody>
					</table>
			</div>
			<?php  
				}else{
					echo "<h3>A&uacuten no hay Categor&iacuteas identificadas</h3>";
				}
			?>	
			<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
	 		    <div class="modal-content">
				    <h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				 </div>
				 <div class="modal-footer blue darken-3 z-depth-5">
				 	<input type="hidden" id="idCategoria" name="idCategoria">
				 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarCategoria()"/>
			     </div>
 			</div>
		</div>
		</div>

			<div class="row">
				<h2>Lista de Sub Categor&iacuteas</h2>
				<div class="input-field buscar1 col s12 m8 l8">
			        <label class="white-text" for="filtrar">Buscar</label>
			        <input id="datosSubCategoria"  type="text" >
        		</div>
				<div class="col s12 m12 l12">
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
									        	<td>".$categoria->getDescripcion()."</td>
								        		<td><input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"	cargarPagina('../interfaz/ICategoria/IModificarCategoria.php?idCategoria=".$categoria->getIdCategoria()."')\"/></td>";
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
	
	

	<script>
  		$(document).ready(function(){
	  		$('.modal-trigger').leanModal();
	   	});
	   	function agregarSubCategorias(idCategoria){
	   		//var categorias = eval(<?php echo $ArrayJson ?>);//obtengo lista de categorias
	   		var tbody = document.getElementById("tbody");//obtengo el objeto tabla del html
	   		var tabla = document.getElementById("subCategorias");//obtengo la tabla del html
	   		var cant = tabla.rows.length;
	   		//for(j=1;tabla.rows.length>1;j++){//recorro todas las filas y las elimino
	   			//tabla.deleteRow(j);//elimina la fila en la posicion i
	   			//j--;
	   		//}
	   		//alert(document.getElementById("tr"+j).cells[0].childNodes[0].nodeValue);
	   		for(j=1;j<tabla.rows.length;j++){
	   			if(document.getElementById("tr"+j).cells[0].childNodes[0].nodeValue==idCategoria){
	   				document.getElementById("tr"+j).style.display = "";
	   			}else{
	   				document.getElementById("tr"+j).style.display = "none";
	   			}
	   		}
	   }
	</script>
	<script type="text/javascript" src="../js/jsCategoria.js"></script>	
	<?php }else{

		header("location:../../loginUsuarios.php");
		}  ?>
<script type="text/javascript" src="../js/jsCategoria.js"></script>