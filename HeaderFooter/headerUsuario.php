<?php 
$cedulaUsuarioLogin=$_SESSION['idUsuario'];
 ?>
<header>
	<input type="hidden" id="cedulaOculta" value="<?php echo "$cedulaUsuarioLogin"; ?>">
	<div class="navbar-fixed">
		<ul id="dropdown1" class="dropdown-content">
			<li><a href="../desconectar.php">Salir</a></li>
		</ul>
		<nav class="blue darken-4 posicionamiento">
		    <div class="nav-wrapper">
				
				<div class="posicion1">
					<a href="../interfaz/paginaPrincipal.php" class="brand-logo left">SEVRI</a>
				</div>
				<a href="#" data-activates="menuresponsive" class="button-collapse right"><i class="material-icons">menu</i></a>

				<div class="posicion2">
					<ul id="nav-mobile" class="right responsive-nav">
						<!--menu -->
						<li><a class="dropdown-button" href="#" data-activates="subIdentificar">Identificaci&oacuten</a></li>
						<li><a class="dropdown-button" href="#" data-activates="subAnalisis">An&aacutelisis</a></li>
						<li><a class="dropdown-button" href="#" data-activates="subAdministracion">Administraci&oacuten</a></li>
						<li><a class="dropdown-button" href="#" data-activates="subSeguimiento">Seguimiento</a></li>
						<li><a class="dropdown-button" href="#" data-activates="subMensajes" id="cantMenUsuario">Mensajes</a></li>
						<li class="active"><a class="dropdown-button" href="#" data-activates="subDropdown1"><?php echo $_SESSION['nombreUsuario']; ?><i class="material-icons right">more_vert</i></a></li>
					</ul>

					<ul class="side-nav" id="menuresponsive">
					<!-- sub menu responsive-->
						<li><a class="dropdown-button" href="#" data-activates="subIdentificar2">Identificaci&oacuten</a></li>
						<li><a class="dropdown-button" href="#" data-activates="subAnalisis2">An&aacutelisis</a></li>
						<li><a class="dropdown-button" href="#" data-activates="subAdministracion2">Administraci&oacuten</a></li>
						<li><a class="dropdown-button" href="#" data-activates="subSeguimiento2">Seguimiento</a></li>
						<li><a class="dropdown-button" href="#" data-activates="subMensajes2" id="cantMenUsuario2">Mensajes</a></li>
						<li class="active"><a class="dropdown-button" href="#" data-activates="subDropdown2"><?php echo $_SESSION['nombreUsuario']; ?><i class="material-icons right">more_vert</i></a></li>
					</ul>
				</div>

		    </div>
	  </nav>
	</div>
     <!-- Dropdown Structure -->
		  
	<ul id="subIdentificar" class="dropdown-content">
	  <li>
	  	  <a href="javascript:cargarPagina('../interfaz/IRiesgo/IIdentificarRiesgo.php')">Identificar Riesgo</a>
	  </li>
	  <li>
	  	  <a href="javascript:cargarPagina('../interfaz/IRiesgo/IMostrarRiesgosDepartamento.php')">Mostrar Riesgos</a>
	  </li>
	</ul>
	<ul id="subAnalisis" class="dropdown-content">
	  <li>
	  	  <a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarRiesgosAnalisis.php')">Analizar Riesgo</a>
	  </li>
	  <li>
	  	  <a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarRiesgosAnalizados.php')">Mostrar An&aacutelisis</a>
	  </li>
	</ul>
	  
	<ul id="subAdministracion" class="dropdown-content">  
	   <li>
	   	  <a href="javascript:cargarPagina('../interfaz/IAdministracion/IMostrarRiesgosAdministracion.php')">Administrar Riesgo</a>
	   	</li>
	</ul>  
	 <ul id="subSeguimiento" class="dropdown-content">	
	   <li>
	   	  <a href="javascript:cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosAsignados.php')">Realizar Seguimientos</a>
	   	</li>
	   <li>
	   	  <a href="javascript:cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php')">Mostrar Seguimientos</a>
	   </li>
	</ul>


	<ul id="subMensajes" class="dropdown-content">
		<li>
		  <a href="javascript:cargarPagina('../interfaz/IUsuarios/IMensajesUsuario.php')">Ver Mensajes</a>
		</li>
	</ul>

	<ul id="subDropdown1" class="dropdown-content">
		<li><a href="../desconectar.php">Salir</a></li>
	</ul>

	<!-- estructura del menú responsive-->
	<ul id="subIdentificar2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IIdentificarRiesgo.php')">Identificar Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IMostrarRiesgo.php')">Mostrar Riesgos</a></li>
	</ul>
	<ul id="subAnalisis2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IAnalizarRiesgo.php')">Analizar Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarAnalisisRiesgo.php')">Mostrar An&aacutelisis</a></li>
	</ul>
	<ul id="subAdministracion2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IAdministracion/ISeleccionarRiesgoAdministracion.php')">Administrar Riesgo</a></li>
	</ul>
	<ul id="subSeguimiento2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosAsignados.php')">Realizar Seguimientos</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php')">Mostrar Seguimientos</a></li>
	</ul>

	<ul id="subMensajes2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IMensajesUsuario.php')">Ver Mensajes</a></li>
	</ul>
	<ul id="subDropdown2" class="dropdown-content">
	  <li><a href="../desconectar.php">Salir</a></li>
	</ul>

		<script>
		$( document ).ready(function(){
			setInterval('traerMensajesNuevos()',10000);
		   $('.dropdown-button').dropdown();
		   $('.button-collapse').sideNav();
		});
		</script>
</header>
