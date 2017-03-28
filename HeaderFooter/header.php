<?php  
	session_start();
	if($_SESSION){
		include_once('../controladora/ctrListaUsuario.php');
		$controlUsuario = new ctrListaUsuario;
		$cantidadMensajes = $controlUsuario->contarMensajesNuevos($_SESSION['idUsuario']);
		?>
<header>
	<div class="navbar-fixed">
		<ul id="dropdown1" class="dropdown-content">
			<li><a href="../desconectar.php">Salir</a></li>
		</ul>
			<nav class="blue darken-4 posicionamiento">
			    <div class="nav-wrapper">
					
					<div class="posicion1">
						<a href="../interfaz/paginaPrincipal.php" class="brand-logo left ">SEVRI</a>
					</div>
					<a href="#" data-activates="menuresponsive" class="button-collapse right"><i class="material-icons">menu</i></a>
	
					<div class="posicion2">
						<ul id="nav-mobile" class="right hide-on-med-and-down">
						<?php  
			      			if($_SESSION['tipo']=='Administrador'){?>
								<li><a class="dropdown-button" href="#" data-activates="SubSevri">SEVRI</a></li>
								<li><a class="dropdown-button" href="#" data-activates="subComplementos">Agregar Complementos</a></li>
								<li><a class="dropdown-button" href="#" data-activates="subCrearComplementos">Crear Complementos</a></li>
								<li><a class="dropdown-button" href="#" data-activates="subUsuarios">Usuarios</a></li>
								<li><a class="dropdown-button" href="#" data-activates="subDepartamentos">Departamentos</a></li>
							<?php } ?>
							<li><a class="dropdown-button" href="#" data-activates="subProceso">Procesos SEVRI</a></li>
							<li><a class="dropdown-button" href="#" data-activates="subMensajes"><?php echo "Mensajes: ".$cantidadMensajes; ?></a></li>
							<li class="active"><a class="dropdown-button" href="#" data-activates="subDropdown1"><?php echo $_SESSION['nombreUsuario']; ?><i class="material-icons right">more_vert</i></a></li>
						</ul>

						<ul class="side-nav" id="menuresponsive">
						<?php  
				      	  	if($_SESSION['tipo']=='Administrador'){?>
								<li><a class="dropdown-button white-text" href="#" data-activates="SubSevri2">SEVRI</a></li>
								<li><a class="dropdown-button white-text" href="#" data-activates="subComplementos2">Agregar Complementos</a></li>
								<li><a class="dropdown-button white-text" href="#" data-activates="subUsuarios2">Usuarios</a></li>
								<li><a class="dropdown-button white-text" href="#" data-activates="subNivelRiesgo2">Nivel Riesgo</a></li>
								<li><a class="dropdown-button white-text" href="#" data-activates="subParametro2">Par&aacutemetros</a></li>
								<li><a class="dropdown-button" href="#" data-activates="subCategoria2">Categor&iacuteas</a></li>
							<?php } ?>
							<li><a class="dropdown-button white-text" href="#" data-activates="subIdentificar2">Identificaci&oacuten</a></li>
							<li><a class="dropdown-button white-text" href="#" data-activates="subAnalizar2">An&aacutelisis</a></li>
							<li><a class="dropdown-button white-text" href="#" data-activates="subAdministrar2">Administraci&oacuten</a></li>
							<li class="active"><a class="dropdown-button" href="#!" data-activates="subDropdown22"><?php echo $_SESSION['nombreUsuario']; ?><i class="material-icons right">more_vert</i></a></li>
						</ul>
					</div>
	
			    </div>
		  </nav>
	   </div>
		   <!-- Dropdown Structure -->
		   <?php
			if($_SESSION['tipo']=='Administrador'){?>
				<ul id="SubSevri" class="dropdown-content" >
				  <li><a href="javascript:cargarPagina('../interfaz/ISevri/IcrearSevri.php')">Crear SEVRI</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/ISevri/IMostrarSevri.php')">Mostrar Versiones</a></li>
				 
				</ul>
				<ul id="subComplementos" class="dropdown-content" >
					<li><a href="javascript:cargarPagina('../interfaz/IComplementos/IAgregarParametros.php')">Agregar Par&aacutemetros</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/IComplementos/IAgregarDepartamentos.php')">Agregar Departamentos</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/IComplementos/IAgregarCategorias.php')">Agregar Categor&iacuteas</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/IAgregarNivelRiesgoAuxiliar.php')">Agregar Nivel Riesgo</a></li>
					
				</ul>
				<ul id="subCrearComplementos" class="dropdown-content" >
				  <li><a href="javascript:cargarPagina('../interfaz/IParametros/IcrearParametro.php')">Crear Par&aacutemetro</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/IParametros/IMostrarParametros.php')">Mostrar Par&aacutemetro</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/ICategoria/IInsertarCategoria.php')">Insertar Categor&iacuteas</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php')">Mostrar Categor&iacuteas</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/ICrearNiveles.php')">Crear Niveles de Riesgo</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/IMostrarNivelRisgoAuxiliar.php')">Mostrar Nivel Riesgo</a></li>	
				</ul>
			<?php } ?>
				<ul id="subProceso" class="dropdown-content">
				  <li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IIdentificarRiesgo.php')">Identificar Riesgo</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IMostrarRiesgo.php')">Mostrar Riesgos</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IAnalizarRiesgo.php')">Analizar Riesgo</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarAnalisisRiesgo.php')">Mostrar An&aacutelisis</a></li>
				   <li><a href="javascript:cargarPagina('../interfaz/IAdministracion/ISeleccionarRiesgoAdministracion.php')">Administrar Riesgo</a></li>
				</ul>
				<ul id="subUsuarios" class="dropdown-content">
				  <li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IRegistrarUsuarios.php')">Registrar Usuarios</a></li>
				  <li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IMostrarUsuarios.php')">Mostrar Usuarios</a></li>
				</ul>
				<ul id="subDepartamentos" class="dropdown-content">
				
				</ul>
		<ul id="subDropdown1" class="dropdown-content">
			<li><a href="../desconectar.php">Salir</a></li>
		</ul>
		<?php
			if($_SESSION['tipo']=='Administrador'){?>
				<ul id="SubSevri2" class="dropdown-content" >
					<li><a href="javascript:cargarPagina('../interfaz/ISevri/IcrearSevri.php')">Crear SEVRI</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/ISevri/IAgregarComponentesSEVRI.php')">Complementos</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/ISevri/IMostrarSevri.php')">Mostrar Versiones</a></li>
				</ul>
				<ul id="subComplementos2" class="dropdown-content" >
					<li><a href="javascript:cargarPagina('../interfaz/IComplementos/IAgregarParametros.php')">Agregar Par&aacutemetros</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/IComplementos/IAgregarDepartamentos.php')">Agregar Departamentos</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/IComplementos/IAgregarCategorias.php')">Agregar Categor&iacuteas</a></li>
				</ul>
				<ul id="subUsuarios2" class="dropdown-content" >
					<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IRegistrarUsuarios.php')">Registrar Usuarios</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IMostrarUsuarios.php')">Mostrar Usuarios</a></li>
				</ul>
				<ul id="subParametro2" class="dropdown-content">
					<li><a href="javascript:cargarPagina('../interfaz/IParametros/IcrearParametro.php')">Crear Par&aacutemetro</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/IParametros/IMostrarParametros.php')">Mostrar Par&aacutemetro</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/ICrearNiveles.php')">Crear Niveles de Riesgo</a></li>
				</ul>
				<ul id="subNivelRiesgo2" class="dropdown-content">
					<li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/IAgregarNivelRiesgoAuxiliar.php')">Agregar Nivel Riesgo</a></li>
					<li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/ICrearNiveles.php')">Crear Niveles de Riesgo</a></li>
				</ul>
		<?php } ?>
		<ul id="subIdentificar2" class="dropdown-content">
		  <li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IIdentificarRiesgo.php')">Identificar Riesgo</a></li>
		  <li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IMostrarRiesgo.php')">Mostrar Riesgos</a></li>
		</ul>
		<ul id="subAnalizar2" class="dropdown-content">
		  <li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IAnalizarRiesgo.php')">Analizar Riesgo</a></li>
		  <li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarAnalisisRiesgo.php')">Mostrar An&aacutelisis</a></li>
		</ul>
		<ul id="subAdministrar2" class="dropdown-content">
		  <li><a href="javascript:cargarPagina('../interfaz/IAdministracion/ISeleccionarAdministracion.php')">Administrar Riesgo</a></li>
		</ul>
		<ul id="subDropdown22" class="dropdown-content">
			<li><a href="../desconectar.php">Salir</a></li>
		</ul>
		<script>
		$( document ).ready(function(){
		   $('.dropdown-button').dropdown();
		   $('.button-collapse').sideNav();
		});
		</script>
</header>
<?php  
}else{
	header("location:../loginUsuarios.php");
}
?>