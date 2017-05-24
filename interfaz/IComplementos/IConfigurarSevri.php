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
<script>
	window.onload=ocultarBarra();
</script>


<div class="responsive">
	<div class="inputs col s12 m6 l6 configurarionSevri">
		
		<p>
			<input class="with-gap radiosConfiguracion" name="group1" type="radio" id="radioParametros" onclick="cargarPaginaConfiguraciones('../interfaz/IComplementos/IAgregarParametros.php', this)" />
			<label for="radioParametros" class="white-text radiosConfiguracion">Agregar Par&aacutemetros</label>
		</p>
	
	
		<p>
			<input class="with-gap radiosConfiguracion" name="group1" type="radio" id="radioCategorias" onclick="cargarPaginaConfiguraciones('../interfaz/IComplementos/IAgregarCategorias.php', this)" />
			<label for="radioCategorias" class="white-text radiosConfiguracion">Agregar Categor&iacuteas</label>
		</p>
	
		<p>
			<input class="with-gap radiosConfiguracion" name="group1" type="radio" id="radioDepartamentos" onclick="cargarPaginaConfiguraciones('../interfaz/IComplementos/IAgregarDepartamentos.php', this)" />
			<label for="radioDepartamentos" class="white-text radiosConfiguracion">Agregar Departamentos</label>
		</p>

		<p>
			<input class="with-gap radiosConfiguracion" name="group1" type="radio" id="radioNivelRiesgo" onclick="cargarPaginaConfiguraciones('../interfaz/IComplementos/IAgregarNivelRiesgoAuxiliar.php', this)" />
			<label for="radioNivelRiesgo" class="white-text radiosConfiguracion">Agregar Nivel de Riesgo</label>
		</p>
		
	</div>
	<input type="hidden" id="idRadioSeleccionado">
</div>

<div id="contenedorPaginaConfiguraciones" class="container contForm">
				
</div>