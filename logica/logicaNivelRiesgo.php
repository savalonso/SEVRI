<?php 

	class logicaNivelRiesgo{

		public function logicaNivelRiesgo(){}

		public function insertarNivelRiesgo($nivelesRiesgo){
			include_once("../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo;
			$mensaje = '';
			$resultado = $dataNivel->insertarNivelRiesgo($nivelesRiesgo);
			if($resultado){
				$mensaje = 'Los niveles de riesgo se han insertado correctamente';
			}else{
				$mensaje = 'No se han podido insertar los niveles de riesgo';
			}
			return $mensaje;
		}

		public function modificarNivelRiesgo($nivelesRiesgo){
			include_once("../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo;
			$mensaje = '';
			$resultado = $dataNivel->modificarNivelRiesgo($nivelesRiesgo);
			if($resultado){
				$mensaje = 'Los niveles de riesgo se han actualizado correctamente';
			}else{
				$mensaje = 'No se han podido actualizar los niveles de riesgo';
			}
			return $mensaje;
		}

		public function eliminarNivelesRiesgo($idDivision){
			include_once("../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo;
			$mensaje = '';
			$resultado = $dataNivel->eliminarNivelRiesgo($idDivision);
			if($resultado){
				$mensaje = 'Los niveles de riesgo se han eliminado correctamente';
			}else{
				$mensaje = 'No se han podido eliminar los niveles de riesgo';
			}
			return $mensaje;
		}

		public function obtenerNivelRiesgo(){
			include_once("../../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo();
			$lista = $dataNivel->getNivelesRiesgo();
			if(!$lista){
				return false;
			}else{
				return $lista;
			}

		}

		public function obtenerNivelesSevriActivo(){
			include_once("../../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo();
			$lista = $dataNivel->getNivelesSevriActivo();
			if(!$lista){
				return false;
			}else{
				return $lista;
			}

		}

		public function obtenerDiviciones(){
			include_once("../../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo();
			$lista = $dataNivel->getDivicionNiveles();
			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}

		public function insertarSevriNivel($idDivicion){
			include_once("../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo();
			$respuesta = $dataNivel->realizarVinculacionNivel($idDivicion);
			if(!$respuesta){
				return false;
			}else{
				return true; 
			}

		}

		public function eliminarSevriNivel($idDivicion){
			include_once("../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo();
			$respuesta = $dataNivel->realizarDesvinculacionNivel($idDivicion);
			if(!$respuesta){
				return false;
			}else{
				return true; 
			}

		}
		
		public function ObtenerNivelRiesgoViculado(){
			include_once("../../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo();
			$respuesta = $dataNivel->getNivelRiesgoVinculado();
			if(!$respuesta){
				return false;
			}else{
				return $respuesta; 
			}
		}

		public function obtenerNivelRiesgoFiltrado(){
			include_once("../../data/dtNivelRiesgo.php");
			$dataNivel = new dtNivelRiesgo();
			$listaNivel = $dataNivel->getNivelesRiesgo();
			$listaSevriNivel = $dataNivel->getSevriNivel();

			$vinculados = array();
 			$encontrado = false; 
 			
 			
 			if (!empty($listaSevriNivel)) { 
 				for ( $i=0; $i < count($listaSevriNivel); $i++ ) {
 					$temp = $listaSevriNivel[$i];
			         for ( $j=0 ; $j < count($listaNivel); $j++ ) { 
							
			         	if ($listaNivel[$j]->getIdDivisiones() == $temp['idDivicion']) {
			         		
			         		$condicion = logicaNivelRiesgo::valoresSinRepetir($vinculados,$listaNivel[$j]);//recive el array de vinculados y el nivel de riesgo
			         		if(!$condicion){
			         			$listaNivel[$j]->setEsEditable(false);
			              		array_push($vinculados,$listaNivel[$j]);
			         		}
			            }
			         }
		        } 
		        if($vinculados != null){
		        	$vinculados	= logicaNivelRiesgo::AgregarNovinculados($vinculados,$listaNivel);
 				}
 			} else {
				for ($i=0; $i < count($listaNivel) ; $i++) { 

	         		$listaNivel[$i]->setEsEditable(true);
	              	array_push($vinculados,$listaNivel[$i]);
	           }
 			}
 			
				return $vinculados;
		}

		function valoresSinRepetir($vinculados,$nivelRiesgo){

			$encontrado = false;
			if($vinculados != null){
				for($i = 0; $i<count($vinculados);$i++){

					if($vinculados[$i]==$nivelRiesgo){
						$encontrado = true;
						$i=count($vinculados);
					}
				}
			}else{
				
				$encontrado = false;
			}
			return $encontrado;
		}
		function AgregarNovinculados($vinculados,$listaNivel){

			for($i = 0; $i<count($listaNivel);$i++){
				if(!(logicaNivelRiesgo::valoresSinRepetir($vinculados,$listaNivel[$i]))){
					$listaNivel[$i]->setEsEditable(true);
			        array_push($vinculados,$listaNivel[$i]);
				}
			}

			return $vinculados;

		}
	}

 ?>