<?php

	class ctrListaSeguimientos{

		public function ctrListaSeguimientos(){}

		function obtenerSeguimientosAsignados($cedulaAprobador){
			include_once('../../logica/logicaSeguimiento.php');
			$logica= new logicaSeguimiento;
			$lista=$logica->obtenerSeguimientosAsignados($cedulaAprobador);
			return $lista;
		}

		function obtenerSeguimientosAprobador($cedulaAprobador){
			include_once('../../logica/logicaSeguimiento.php');
			$logica=new logicaSeguimiento;
			$lista=$logica->obtenerSeguimientosAprobador($cedulaAprobador);
			return $lista;
		}

		function obtenerSeguimientoAprobador($idSeguimiento){
			include_once('../../logica/logicaSeguimiento.php');
			$logica=new logicaSeguimiento;
			$lista=$logica->obtenerSeguimientoAprobador($idSeguimiento);
			return $lista;
		}


		function obtenerSeguimientosDepartamento($idDepartamento){
			include_once('../../logica/logicaSeguimiento.php');
			$logica=new logicaSeguimiento;
			$lista=$logica->obtenerSeguimientosDepartamento($idDepartamento);
			return $lista;
		}

	}

	

?>