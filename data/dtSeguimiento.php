<?php
	
	class dtSeguimiento{

			public function dtSeguimiento(){}

			 function getSeguimientosAsignados($cedulaAprobador){
			
				include_once('dtConnection.php');
				include_once("../../dominio/dSeguimiento.php");
				$con=new dtConnection();
				$conexion=$con->conect();
				$query="CALL obtenerSeguimientosAsignados('$cedulaAprobador')";
				$resultado=mysqli_query($conexion,$query);
				$lista=array();

				while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM)) {
					$seguimiento=new dSeguimiento;

					$seguimiento->setId($row[0]);
					$seguimiento->setActividadTratamiento($row[1]);
					$seguimiento->setPorcentajeAvance($row[2]);
					$seguimiento->setComentarioAvance($row[3]);
					$seguimiento->setMontoSeguimiento($row[4]);
					$seguimiento->setFechaAvance($row[5]);
					$seguimiento->setEstadoSeguimiento($row[6]);

					array_push($lista, $seguimiento);
				
				}

				mysqli_free_result($resultado);
				mysqli_close($conexion);
				if (!$resultado){
					return false;
				} else {
					return $lista;
				}

		}

		 function getSeguimientosAprobador($cedulaAprobador){
			include_once('dtConnection.php');
			include_once("../../dominio/dSeguimiento.php");
			$con=new dtConnection();
			$conexion=$con->conect();
			$query="CALL obtenerSeguimientosAprobador('$cedulaAprobador')";
			$resultado=mysqli_query($conexion,$query);
			$lista=array();

			while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM)) {
				$seguimiento=new dSeguimiento;
				$seguimiento->setId($row[0]);
				$seguimiento->setPorcentajeAvance($row[1]);
				$seguimiento->setEstadoSeguimiento($row[2]);
				$seguimiento->setComentarioAprobador($row[3]);
				$seguimiento->setComentarioAvance($row[4]);
				$seguimiento->setMontoSeguimiento($row[5]);
				$seguimiento->setFechaAvance($row[6]);
				
				array_push($lista, $seguimiento);
			}

			mysqli_free_result($resultado);
			mysqli_close($conexion);

			if(!$resultado){
				return false;
			}else{
				return $lista;
			}
		}

		 function getSeguimientoAprobador($idSeguimiento){
			include_once('dtConnection.php');
			include_once("../../dominio/dSeguimiento.php");
			$con=new dtConnection();
			$conexion=$con->conect();
			$query="CALL obtenerSeguimientoAprobadorPorId('$idSeguimiento')";
			$resultado=mysqli_query($conexion,$query);
			$lista=array();

			while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM)) {
				$seguimiento=new dSeguimiento;
				$seguimiento->setId($row[0]);
				$seguimiento->setActividadTratamiento($row[1]);
				$seguimiento->setEstadoSeguimiento($row[2]);
				$seguimiento->setComentarioAprobador($row[3]);

				array_push($lista, $seguimiento);

			}

			mysqli_free_result($resultado);
			mysqli_close($conexion);

			if(!$resultado){
				return false;
			}else{
				return $lista;
			}
		}

		function getSeguimientosPorDepartamento($idDepartamento){
			include_once('dtConnection.php');
			include_once("../../dominio/dSeguimiento.php");
			$con=new dtConnection();
			$conexion=$con->conect();
			$query="CALL obtenerSeguimientosDepartamento('$idDepartamento')";
			$resultado=mysqli_query($conexion,$query);
			$lista=array();

			while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM)) {
				$seguimiento=new dSeguimiento;
				
				$seguimiento->setId($row[0]);
				$seguimiento->setActividadTratamiento($row[1]);
				$seguimiento->setPorcentajeAvance($row[2]);
				$seguimiento->setComentarioAvance($row[3]);
				$seguimiento->setFechaAvance($row[4]);
				$seguimiento->setMontoSeguimiento($row[5]);
				$seguimiento->setEstadoSeguimiento($row[6]);

				array_push($lista, $seguimiento);

			}

			mysqli_free_result($resultado);
			mysqli_close($conexion);

			if(!$resultado){
				return false;
			}else{
				return $lista;
			}


		}

		 function modificarSeguimientoAprobador($idSeguimiento,$seguimiento){
			include_once ("dtConnection.php");
			$con=new dtConnection();
			$conexion=$con->conect();

			$estadoSeguimiento=$seguimiento->getEstadoSeguimiento();
			$comentarioAprobador=$seguimiento->getComentarioAprobador();

			$result =$conexion->query("CALL actualizarSeguimientoAprobador('$idSeguimiento','$estadoSeguimiento','$comentarioAprobador')");

			if (!$result){
				return false;
			} else {
				return true;
			}

		}

		 function eliminarSeguimientoAprobador($idSeguimiento){

			include_once ("dtConnection.php");
			$con=new dtConnection();
			$conexion=$con->conect();

			$result = $conexion->query("CALL eliminarSeguimientoAprobador('$idSeguimiento')");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}


	}
?>