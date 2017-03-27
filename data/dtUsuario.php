<?php 

	class dtUsuario{

		public function dtUsuario(){}

		public function get_Nom_Ced_Usuarios(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dUsuario.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerNomCedUsuarios()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
				$usuario = new dUsuario;
				$usuario->setCedula($row['Cedula']);
				$nombre = $row['Nombre'];	
				$nombre .= " " . $row['PrimerApellido'];
				$nombre .= " " . $row['SegundoApellido'];
				$usuario->setNombre($nombre);
				array_push($lista, $usuario);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		public function getMensajesUsuario(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dBandejaEntrada.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerMensajesUsuario('123456789')";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
				$mensaje = new dBandejaEntrada;
				$mensaje->setNombreRemitente($row['EnviadoPor']);
				$mensaje->setMensaje($row['Mensaje']);
				$mensaje->setDireccionPagina($row['DireccionPagina']);

				array_push($lista, $mensaje);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		public function getMensajesNuevos($cedula){
			include_once ('dtConnection.php');
			include_once("../dominio/dBandejaEntrada.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerMensajesNuevos('$cedula')";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
				$mensaje = new dBandejaEntrada;
				$mensaje->setNombreRemitente($row['EnviadoPor']);
				$mensaje->setMensaje($row['Mensaje']);
				$mensaje->setDireccionPagina($row['DireccionPagina']);

				array_push($lista, $mensaje);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		public function getCantidadMensajesNuevos($cedula){
			include_once ('dtConnection.php');
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerCantidadMensajesNuevos('$cedula')";
			$result = mysqli_query($conexion, $query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$cantidadMensajes = $row['cantidad'];
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $cantidadMensajes;
			}
		}

		function insertarUsuario($usuario){
		    include_once ('dtConnection.php');
			$con = new dtConnection;
			$prueba = $con->conect();

		    $cedula = $usuario->getCedula();
		    $nombre = $usuario->getNombre();
		    $primerApellido = $usuario->getPrimerApellido();
		    $segundoApellido = $usuario->getSegundoApellido();
		    $telefono = $usuario->getTelefono();
		    $correo = $usuario->getCorreo();
		    $clave = $usuario->getClave();
		    $cargo = $usuario->getCargo();
		    $tipo = $usuario->getTipo();

		    $result = $prueba->query("CALL insertarUsuario('$cedula', '$nombre', '$primerApellido', '$segundoApellido', $telefono, '$correo', '$clave', '$cargo', '$tipo')");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

        function getListaUsuarios(){
			include_once("../../dominio/dUsuarios.php");
			$con = new dtConnection;
			$conexion = $con->conect();

			$query = "CALL obtenerListaUsuarios()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$usuario = new dUsuarios();

				$usuario->setCedula($row['Cedula']);
				$usuario->setNombre($row['Nombre']);
	    		$usuario->setPrimerApellido($row['PrimerApellido']);
		      	$usuario->setSegundoApellido($row['SegundoApellido']);
		      	$usuario->setFechaRegistro($row['FechaRegistro']);
		      	$usuario->setTelefono($row['Telefono']);
		      	$usuario->setCorreo($row['Correo']);
                $usuario->setClave($row['Clave']);
                $usuario->setCargo($row['Cargo']);
                $usuario->setTipo($row['Tipo']);

				array_push($lista, $usuario);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function eliminarUsuarios($cedula){
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL eliminarUsuario($cedula);");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

		function marcarMensajeLeido($idMensaje){
			$con = new dtConnection;
			$conexion = $con->conect();

			$conexion->query("CALL marcarMensajeLeido($idMensaje);");
		}

		function getUsuario($cedula){
			include_once ("../../dominio/dUsuarios.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerUsuario($cedula)";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$usuario = new dUsuarios;
				$usuario->setCedula($row[0]);
				$usuario->setNombre($row[1]);
				$usuario->setPrimerApellido($row[2]);	
				$usuario->setSegundoApellido($row[3]);
				$usuario->setFechaRegistro($row[4]);
				$usuario->setTelefono($row[5]);
				$usuario->setCorreo($row[6]);
				$usuario->setClave($row[7]);
				$usuario->setCargo($row[8]);
				$usuario->setTipo($row[9]);
				array_push($lista, $usuario);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function actualizarUsuario($usuario, $cedulaUsuario){
			$con = new dtConnection;
			$conexion = $con->conect();

			$cedula = $cedulaUsuario;
  			$nombre = $usuario->getNombre();
			$primerApellido = $usuario->getPrimerApellido();
			$segundoApellido = $usuario->getSegundoApellido();
			$telefono = $usuario->getTelefono();
			$correo = $usuario->getCorreo();
			$clave = $usuario->getClave();
			$cargo = $usuario->getCargo();
			$tipo = $usuario->getTipo();

			$result = $conexion->query("CALL modificarUsuario('$cedula', '$nombre', '$primerApellido', '$segundoApellido', $telefono, '$correo', '$clave', '$cargo', '$tipo')");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

	}

 ?>