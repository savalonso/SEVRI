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
<!DOCTYPE html>
	<?php
		include("../../controladora/ctrListaDepartamento.php");
		$control=new ctrListaDepartamento;
		$lista=$control->mostrarDepartamentos();
		$fechaActual=date("Y-m-d");
	?>
	<script>	
		window.onload=ocultarBarra();
		$( document ).ready(function(){
	   	$('select').material_select();
	   	});
	</script>

		<div class="row">
			<?php  
				if($lista!=null){
			?>

			<h2>Lista de Departamentos</h2>
			<div class="input-field buscar1 col s12 m8 l8">
		        <label class="white-text" for="filtrar">Buscar</label>
		        <input id="datosDepartamento" type="text" >
    		</div>
			<div class="col s12 m12 l12">
				<div>
					<table class="responsive-table striped centered responsive2" id="mostrarDep">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Nombre</th>
								<th>Fecha de creac&iacuteon</th>
								<th>Opcion 1</th>
								<th>Opcion 2</th>
								<th>Opcion 3</th>
							</tr>
						</thead>
						<tbody id="datosD">
							<?php 
							
								foreach ($lista as $departamento){
									
									echo "<tr>
											<td>".$departamento->getCodigoDepartamento()."</td>
											<td>".$departamento->getNombreDepartamento()."</td>
											<td>".$departamento->getFechaCreacion()."</td>";
											
											if($departamento->getEsModificable() == true){
											echo "<td>
									        <input class=\"btn btn-default\" type=\"button\" value=\"Modificar\" onclick=\"cargarPagina('../interfaz/IDepartamento/IModificarDepartamento.php?idDepartamento=".$departamento->getIdDepartamento()."')\"/></td>
								       		 </td>
											<td style=\"text-align:center;\"><button type=\"button\" class=\"btnEliminar\" onclick=\"confirmarEliminarDepartamento('".$departamento->getIdDepartamento()."')\"><a class=\"waves-effect waves-light btn modal-trigger\" href=\"#MeliminarDepartamento\">Eliminar</a> </button>  </td>
											<td><input class=\"btn btn-default\" type=\"button\" value=\"Agregar Usuarios\" onclick=\"cargarPagina('../interfaz/IDepartamento/IAgregarUsuarioDepartamento.php?idDepartamento=".$departamento->getIdDepartamento()."')\"/></td>
											</tr>";
											} else {
											echo "<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Modificar\" /></td>
											<td><input class=\"btn btn-default\" type=\"button\" disabled=\"true\" value=\"Eliminar\" /></td>
											<td><input class=\"btn btn-default\" type=\"button\" value=\"Agregar Usuarios\" onclick=\"cargarPagina('../interfaz/IDepartamento/IAgregarUsuarioDepartamento.php?idDepartamento=".$departamento->getIdDepartamento()."')\"/></td>
											</tr>";
											}
								}
							?>
						</tbody>
					</table>
				</div>
					<?php  
						}else{
							echo "<br><h3>A&uacuten no se ha creado ning&uacuten departamento</h3>";
						}
					?>
			</div>
		</div>



	<div id="MeliminarDepartamento" class="modal  blue darken-3 z-depth-5 white-text">
		<div class="modal-content">
			<h5>¿Estas seguro de realizar la siguiente operaci&oacuten?</h5>
		</div>
		<div class="modal-footer blue darken-3 z-depth-5">
			<input type="hidden" id="idDepartamento" name="idDepartamento">
		 	<input type="button" value="Cancelar" class="white-text modal-action modal-close waves-effect waves-green btn-flat"/>
		 	<input type="button" value="Confirmar" class="white-text modal-action modal-close waves-effect waves-green btn-flat" onclick="eliminarDepartamento()" />
		</div>
	</div>

<script>

	 $(document).ready(function() {
	   	 Materialize.updateTextFields();
 	 });
 	 $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
 	 });
	 
	 $( document ).ready(function(){
	   	$('.modal-trigger').leanModal();
	   	$('ul.tabs').tabs();
	});
  </script>	
  <script type="text/javascript" src="../js/jsDepartamento.js"></script>	
				