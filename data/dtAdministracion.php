<?php 

	class dtAdministracion{

		public function dtAdministracion(){}

		public function getMedidas(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dMedidaAdministracion.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerMedidas()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
				$medida = new dMedidaAdministracion;
				$medida->setId($row['Id']);	
				$medida->setNombreMedida($row['nombreMedida']);
				$medida->setDescripcionMedida($row['descripcionMedida']);
				array_push($lista, $medida);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		public function getAdministraciones($analisis){
			include_once ('dtConnection.php');
			include_once("../../dominio/dAdministracion.php");
			include_once("../../dominio/dUsuario.php");
			include_once("../../dominio/dMedidaAdministracion.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerAdministraciones('$analisis')";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
				$administracion = new dAdministracion;
				$administracion->setId($row['Id']);	

				$usuario = new dUsuario;
				$usuario->setCedula($row['Cedula']);
				$nombre = $row['Nombre'];	
				$nombre .= " " . $row['PrimerApellido'];
				$nombre .= " " . $row['SegundoApellido'];
				$usuario->setNombre($nombre);

				$medida = new dMedidaAdministracion;
				$medida->setId($row['IdMedida']);	
				$medida->setNombreMedida($row['nombreMedida']);
				$medida->setDescripcionMedida($row['descripcionMedida']);

				$administracion->setUsuario($usuario);
				$administracion->setActividadTratamiento($row['ActividadTratamiento']);
				$administracion->setPlazoTratamiento($row['PlazoTratamiento']);
				$administracion->setCostoActividad($row['CostoActividad']);
				$administracion->setIndicador($row['Indicador']);
				$administracion->setMedidaAdministracion($medida);

				array_push($lista, $administracion);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function agregarAdministracion($administracion, $idAnalisis){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

			$responsable = $administracion->getUsuario();
    		$actividad = $administracion->getActividadTratamiento();
    		$plazo = $administracion->getPlazoTratamiento();
    		$costo = $administracion->getCostoActividad();
    		$indicador = $administracion->getIndicador();
    		$medida = $administracion->getMedidaAdministracion();

			$result = $conexion->query("CALL insertarAdministracion('$idAnalisis','$responsable', '$actividad', '$plazo', '$costo', '$indicador', '$medida')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}
			
		}
		function actualizarAdministracion($administracion){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$prueba = $con->conect();

			$id = $administracion->getId();
			$cedulaResponsable = $administracion->getUsuario();
			$actividad = $administracion->getActividadTratamiento();
			$plazo = $administracion->getPlazoTratamiento();
			$costoActividad = $administracion->getCostoActividad();
			$medidaAdministracion = $administracion->getMedidaAdministracion();
			$indicador = $administracion->getIndicador();
			$result = $prueba->query("CALL modificarAdministracion('$medidaAdministracion','$cedulaResponsable','$actividad','$plazo', '$costoActividad', '$id','$indicador')");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}
		function eliminarAdministracion($id){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL eliminarAdministracion($id);");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}
	}

 ?>