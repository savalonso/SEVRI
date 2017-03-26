<?php 

	class logicaRiesgo{

		public function logicaRiesgo(){}

		public function obtenerRiesgosAnalisados(){
			include_once('../../data/dtRiesgo.php');
			$data = new dtRiesgo;
			$lista = $data->getRiesgosAnalisados();		
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
	}

 ?>