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
	$idCategoria = $_GET['idCategoria'];
	include ("../../data/dtCategoria.php");
	//include ("../../dominio/dRiesgo.php");
	$control = new dtCategoria;
	$lista = $control->getCategoria($idCategoria);
	foreach ($lista as $categoria) {
		$id = $categoria->getIdCategoria();
		$nombre = $categoria->getNombreCategoria();
		$descripcion = $categoria->getDescripcion();
		$hijoDe = $categoria->getHijoDe();	
	}
	$cont=0;
	include ("../../controladora/ctrDatosSevri.php");
	$control1 = new ctrDatosSevri;	
	$listaC =$control1->obtenerTodasLasCategorias();
	if($listaC!=null){
		foreach ($listaC as $categorias) {
			if($categorias->getHijoDe()==0){
				$cont++;
			}
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
<h4>Modificar Categor&iacutea</h4>	
<div class="row">
	<form class="responsive" id="IModificarCategoria" method="Post" role="form">
		<div class="inputs blue darken-3 col s12 m6 l6 z-depth-5">
			<div >
				<label for="nombre">Nombre:</label><br>
				<input type="text" name="nombre" id="nombre" value="<?php echo "$nombre";?>">
			</div>

			<div>
				<label for="descripcion">Descripci&oacuten:</label>
				<textarea class="materialize-textarea" rows="10" celds="30" id="descripcion" name="descripcion"><?php echo "$descripcion";?></textarea>
			</div>

			<div >
				<label  for="tipo">Tipo:</label></br></br>
				<select id="tipo" name="tipo" onchange="verificarCombo(this.value)">
				<?php
					if($hijoDe==0){
						if($cont==1){
							echo"<option selected=\"true\" value=\"1\">Categor&iacutea</option>";
							echo"<option disabled=\"true\" value=\"0\">Sub Categor&iacutea</option>";
						}else{
							echo"<option selected=\"true\" value=\"1\">Categor&iacutea</option>";
							echo"<option value=\"0\">Sub Categor&iacutea</option>";
						}
					}else{
						echo"<option value=\"1\">Categor&iacutea</option>";
						echo"<option selected=\"true\" value=\"0\">Sub Categor&iacutea</option>";
					}	
				?>	
				</select>
			</div>
			
			<div>
				<label  class="white-text" for="categoria">Categor&iacutea:</label>
				<?php 
				if($hijoDe==0){
					echo "<select id=\"categoria\" name=\"categoria\" disabled=\"true\"> ";
				}else{
					echo "<select id=\"categoria\" name=\"categoria\"> ";
				}
				?>
						<?php 
							if($listaC!=null){
								echo "<option disabled=\"true\" value=\"0\">Seleccione una subcategor&iacutea...</option>";
								foreach ($listaC as $categorias){
									if($categorias->getHijoDe()==0&&$categorias->getIdCategoria()!=$id){
										if($categorias->getIdCategoria()==$hijoDe){
											echo "<option selected=\"true\" value=".$categorias->getIdCategoria()." >".$categorias->getNombreCategoria()."</option>";
										}else{
											echo "<option value=".$categorias->getIdCategoria()." >".$categorias->getNombreCategoria()."</option>";
										}
									}
								}
							}else{
								echo "<option disabled=\"true\" selected=\"true\" value=\"0\">No hay categor&iacuteas disponibles</option>";
							}
						?>
				</select>
			</div>	

			<div >
				<input type="hidden" name="id" id="id" value="<?php echo "$idCategoria";?>">
			</div>
			<div>
				<?php echo "<button type=\"button\" class=\"btnEliminar btnModal\" id=\"btnModificarCategoria\" onclick=\"confirmarModificacionEliminacionCategoria($id)\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#Meliminar\">Modificar</a> </button>";?><br><br>
			</div>
			<div id="Meliminar" class="modal  blue darken-3 z-depth-5 white-text">
				<div class="modal-content">
					<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
				</div>
				<div class="modal-footer blue darken-3 z-depth-5">
					<input type="hidden" id="idRiesgo" name="idRiesgo">
				 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
				 	<input type="submit" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat btnAccionCrud"/>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	$( document ).ready(function(){
	   	$('select').material_select();
	   	$('.modal-trigger').leanModal();
	   	validarModificarCategoria();
	});
	function verificarCombo(valor){
		if(valor==0){
			document.getElementById('categoria').disabled=false;
		}else{
			document.getElementById('categoria').disabled=true;
		}
		$('select').material_select();
	}
</script>