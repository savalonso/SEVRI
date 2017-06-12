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
 				for ( $i=0; $i < count($listaNivel); $i++ ) {
			         for ( $j=0 ; $j < count($listaSevriNivel); $j++ ) { 
							
			         	$temp = $listaSevriNivel[$j];
			         	if ($listaNivel[$i]->getIdDivisiones() == $temp['idDivicion']) {
			         		$listaNivel[$i]->setEsEditable(false);
			              	array_push($vinculados,$listaNivel[$i]);
			            }else{
			            	$listaNivel[$i]->setEsEditable(true);
			            	array_push($vinculados,$listaNivel[$i]);
			            }
			         }
		        }
 			} else {
 				
				for ($i=0; $i < count($listaNivel) ; $i++) { 

	         		$listaNivel[$i]->setEsEditable(true);
	              	array_push($vinculados,$listaNivel[$i]);
	           }
 			}
			if(!$vinculados){
				return false;
			}else{

				return $vinculados;
			}
		}
	}

 ?>