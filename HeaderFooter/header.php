
<header>
	<input type="hidden" id="cedulaOculta" value="<?php echo "$cedulaUsuarioLogin"; ?>">
	<nav class="navbar-fixed blue darken-4">
		<div class="nav-wrapper">
			<div class="posicion1">
				<a href="../interfaz/paginaPrincipal.php" class="brand-logo left ">SEVRI</a>
			</div>
			<a href="#" data-activates="menuresponsive" class="button-collapse right"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a class="dropdown-button " href="#" data-activates="SubSevri">SEVRI</a></li>
				<li><a class="dropdown-button" href="#" data-activates="subCrearComplementos">Crear Complementos</a></li>
				<li><a class="dropdown-button" href="#" data-activates="subUsuarios">Usuarios</a></li>
				<li><a class="dropdown-button" href="#" data-activates="subDepartamentos">Departamentos</a></li>
				<li><a class="dropdown-button" href="#" data-activates="subProceso">Procesos SEVRI</a></li>
				<li><a class="dropdown-button" href="#" data-activates="subMensajes" id="cantMenUsuario">Mensajes</a></li>
				<li class="active"><a class="dropdown-button" href="#" data-activates="subDropdown1"><?php echo $_SESSION['nombreUsuario']; ?><i class="material-icons right">more_vert</i></a></li>
			</ul>
			<ul class="side-nav" id="menuresponsive">
				<li><a class="dropdown-button" href="#" data-activates="SubSevri2">SEVRI</a></li>
					<li><a class="dropdown-button" href="#" data-activates="subCrearComplementos2">Crear Complementos</a></li>
					<li><a class="dropdown-button" href="#" data-activates="subUsuarios2">Usuarios</a></li>
					<li><a class="dropdown-button" href="#" data-activates="subDepartamentos2">Departamentos</a></li>
					<li><a class="dropdown-button" href="#" data-activates="subProceso2">Procesos SEVRI</a></li>
					<li><a class="dropdown-button" href="#" data-activates="subMensajes2" id="cantMenUsuario2">Mensajes</a></li>
					<li class="active"><a class="dropdown-button" href="#" data-activates="subDropdown2"><?php echo $_SESSION['nombreUsuario']; ?><i class="material-icons right">more_vert</i></a></li>
			</ul>
		</div>
	</nav>

	<!-- Dropdown Structure -->
	<ul id="SubSevri" class="dropdown-content" >
		<li><a href="javascript:cargarPagina('../interfaz/ISevri/IcrearSevri.php')">Crear SEVRI</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ISevri/IMostrarSevri.php')">Mostrar Versiones</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IHistorial/IMostarRiesgos.php')">Historial</a></li>
	</ul>

	<ul id="subCrearComplementos" class="dropdown-content" >
		<li><a href="javascript:cargarPagina('../interfaz/IParametros/IcrearParametro.php')">Crear Par&aacutemetro</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IParametros/IMostrarParametros.php')">Mostrar Par&aacutemetro</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ICategoria/IInsertarCategoria.php')">Insertar Categor&iacuteas</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php')">Mostrar Categor&iacuteas</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/ICrearNiveles.php')">Crear Niveles de Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/IMostrarNivelRisgoAuxiliar.php')">Mostrar Nivel Riesgo</a></li>	
	</ul>

	<ul id="subProceso" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IIdentificarRiesgo.php')">Identificar Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IMostrarRiesgosDepartamento.php')">Mostrar Riesgos</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarRiesgosAnalisis.php')">Analizar Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarRiesgosAnalizados.php')">Mostrar An&aacutelisis</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IAdministracion/IMostrarRiesgosAdministracion.php')">Administrar Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosAsignados.php')">Realizar Seguimientos</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php')">Mostrar Seguimientos</a></li>
	</ul>


	<ul id="subMensajes" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IMensajesUsuario.php')">Ver Mensajes</a></li>
	</ul>

	<ul id="subUsuarios" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IRegistrarUsuarios.php')">Registrar Usuarios</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IMostrarUsuarios.php')">Mostrar Usuarios</a></li>
	</ul>

	<ul id="subDepartamentos" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IDepartamento/IInsertarDepartamento.php')">Registrar Departamentos</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IDepartamento/IMostrarDepartamentos.php')">Mostrar Departamentos</a></li>
	</ul>

	<ul id="subDropdown1" class="dropdown-content">
		<li><a href="../desconectar.php">Salir</a></li>
	</ul>
	
	<!-- estructura del menú responsive-->
	<ul id="SubSevri2" class="dropdown-content" >
		<li><a href="javascript:cargarPagina('../interfaz/ISevri/IcrearSevri.php')">Crear SEVRI</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ISevri/IMostrarSevri.php')">Mostrar Versiones</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IHistorial/IMostarRiesgos.php')">Historial</a></li>
	</ul>
				
	<ul id="subCrearComplementos2" class="dropdown-content" >
		<li><a href="javascript:cargarPagina('../interfaz/IParametros/IcrearParametro.php')">Crear Par&aacutemetro</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IParametros/IMostrarParametros.php')">Mostrar Par&aacutemetro</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ICategoria/IInsertarCategoria.php')">Insertar Categor&iacuteas</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php')">Mostrar Categor&iacuteas</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/ICrearNiveles.php')">Crear Niveles de Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/INivelRiesgo/IMostrarNivelRisgoAuxiliar.php')">Mostrar Nivel Riesgo</a></li>	
	</ul>

	<ul id="subProceso2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IIdentificarRiesgo.php')">Identificar Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IRiesgo/IMostrarRiesgosDepartamento.php')">Mostrar Riesgos</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarRiesgosAnalisis.php')">Analizar Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IAnalisis/IMostrarRiesgosAnalizados.php')">Mostrar An&aacutelisis</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IAdministracion/IMostrarRiesgosAdministracion.php')">Administrar Riesgo</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosAsignados.php')">Realizar Seguimientos</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/ISeguimiento/IMostrarSeguimientosRealizados.php')">Mostrar Seguimientos</a></li>
	</ul>

	<ul id="subMensajes2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IMensajesUsuario.php')">Ver Mensajes</a></li>
	</ul>

	<ul id="subUsuarios2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IRegistrarUsuarios.php')">Registrar Usuarios</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IUsuarios/IMostrarUsuarios.php')">Mostrar Usuarios</a></li>
	</ul>

	<ul id="subDepartamentos2" class="dropdown-content">
		<li><a href="javascript:cargarPagina('../interfaz/IDepartamento/IInsertarDepartamento.php')">Registrar Departamentos</a></li>
		<li><a href="javascript:cargarPagina('../interfaz/IDepartamento/IMostrarDepartamentos.php')">Mostrar Departamentos</a></li>
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
