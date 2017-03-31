<?php 

	class ctrListaAdministracion{

		public function ctrListaAdministracion(){}

		public function obtenerMedidas(){
			include_once('../../logica/logicaAdministracion.php');
 			$logica = new logicaAdministracion;
 			$lista = $logica->obtenerMedidas();		
			return $lista;
		}

		public function obtenerAdministraciones($analisis){
			include_once('../../logica/logicaAdministracion.php');
 			$logica = new logicaAdministracion;
 			$lista = $logica->obtenerAdministraciones($analisis);		
			return $lista;
		}

		public function obtenerAdministracion($idAdministracion){
			include_once('../../logica/logicaAdministracion.php');
 			$logica = new logicaAdministracion;
 			$lista = $logica->obtenerAdministracion($idAdministracion);		
			return $lista;
		}

	}

 ?>