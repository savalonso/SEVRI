<?php

	class logicaSeguimiento{

		public function logicaSeguimiento(){}

		public function insertarSeguimientoNuevo($seguimiento){
			include_once("../data/dtSeguimiento.php");
			$dataSeguimiento = new dtSeguimiento;
			$resultado = $dataSeguimiento->insertarSeguimientoNuevo($seguimiento);

			$mensaje='';

			if(!$resultado){
				$mensaje='Lo sentimos no se ha podido insertar el seguimiento';
			} else {
				$mensaje='Se ha insertado el seguimiento con exito.';
			}
			return $mensaje;
		}
		public function obtenerSeguimiento($idAdministracion){
			include_once('../../data/dtSeguimiento.php');
			$dataSeguimiento= new dtSeguimiento;
			$lista = $dataSeguimiento->obtenerSeguimiento($idAdministracion);
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		public function obtenerAdministracionRiesgo($cedula){
			include_once('../../data/dtSeguimiento.php');
			$dataSeguimiento= new dtSeguimiento;
			$lista = $dataSeguimiento->obtenerAdministracionRiesgo($cedula);
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function obtenerSeguimientosAsignados($cedulaAprobador){

			include_once('../../data/dtSeguimiento.php');
		
			$dataSeguimiento= new dtSeguimiento;
			$lista=$dataSeguimiento->getSeguimientosAsignados($cedulaAprobador);
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function obtenerSeguimientosAprobador($cedulaAprobador){
			include_once('../../data/dtSeguimiento.php');

			$dataSeguimiento= new dtSeguimiento;
			$lista=$dataSeguimiento->getSeguimientosAprobador($cedulaAprobador);
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
				
			
		}


		public function obtenerSeguimientoAprobador($idSeguimiento){
			include_once('../../data/dtSeguimiento.php');
			$dataSeguimiento= new dtSeguimiento;
			$lista=$dataSeguimiento->getSeguimientoAprobador($idSeguimiento);

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
				
		}

		public function obtenerSeguimientosDepartamento($idDepartamento){
			include_once('../../data/dtSeguimiento.php');
			$dataSeguimiento= new dtSeguimiento;
			$lista=$dataSeguimiento->getSeguimientosPorDepartamento($idDepartamento);

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
				
		}

		public function insertarSeguimientoAprobador($idSeguimiento,$seguimiento){
			include_once("../data/dtSeguimiento.php");
			$dataSeguimiento=new dtSeguimiento;
			$resultado=$dataSeguimiento->modificarSeguimientoAprobador($idSeguimiento,$seguimiento);

			$mensaje='';

			if(!$resultado){
				$mensaje='Lo sentimos no se ha podido insertar la aprobacion';
			} else {
				$mensaje='Se ha insertado la aprobacion con exito.';
			}

			return $mensaje;
		}

		public function modificarSeguimientoAprobador($idSeguimiento,$seguimiento){
			include_once("../data/dtSeguimiento.php");
			$dataSeguimiento=new dtSeguimiento;
			$resultado=$dataSeguimiento->modificarSeguimientoAprobador($idSeguimiento,$seguimiento);

			$mensaje='';

			if(!$resultado){
				$mensaje='Lo sentimos no se ha podido modificar la aprobacion';
			} else {
				$mensaje='Se ha modificado la aprobacion con exito.';
			}

			return $mensaje;
		
		}

		public function eliminarSeguimientoAprobador($idSeguimiento){

			include_once("../data/dtSeguimiento.php");
			$dataSeguimiento=new dtSeguimiento;
			$resultado=$dataSeguimiento->eliminarSeguimientoAprobador($idSeguimiento);

			$mensaje='';

			if(!$resultado){
				$mensaje='Lo sentimos no se ha podido eliminar la aprobacion';
			} else {
				$mensaje='Se ha eliminado la aprobacion con exito';
			}

			return $mensaje;

		}

	}

 ?>