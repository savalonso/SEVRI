<?php 

	class logicaRiesgo{

		public function logicaRiesgo(){}

		public function obtenerRiesgosAnalisados($idDepartamento){
			include_once('../../data/dtRiesgo.php');
			$data = new dtRiesgo;
			$lista = $data->getRiesgosAnalisados($idDepartamento);		
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function obtenerRiesgosDepartamento($idDepartamento){
			include_once('../../data/dtRiesgo.php');
			$data=new dtRiesgo;
			$lista=$data->getRiesgosDepartamento($idDepartamento);
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		

		}
	}

 ?>