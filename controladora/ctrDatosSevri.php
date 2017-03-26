
<?php

 	class ctrDatosSevri{
		
 		function obtenerParametros(){
 			include_once('../../logica/logicaParametros.php');
 			$logica = new logicaParametros;
 			$lista = $logica->obtenerParametros();		
			return $lista;
 		}

 		function obtenerParametrosSevriActivo(){
 			include_once('../../logica/logicaParametros.php');
 			$logica = new logicaParametros;
 			$lista = $logica->obtenerParametrosSevriActivo();		
			return $lista;
 		}

 		function obtenerNivelesSevriActivo(){
 			include_once('../../logica/logicaNivelRiesgo.php');
 			$logica = new logicaNivelRiesgo;
 			$lista = $logica->obtenerNivelesSevriActivo();		
			return $lista;
 		}

 		function obtenerParametrosSevriNuevo(){
 			include_once('../../logica/logicaParametros.php');
 			$logica = new logicaParametros;
 			$lista = $logica->obtenerParametrosSevriNuevo();		
			return $lista;
 		}

 		function obtenerCategorias(){
 			include_once('../../logica/logicaCategorias.php');
 			$logica = new logicaCategorias;
 			$lista = $logica->obtenerCategorias();		
			return $lista;
 		}

 		function obtenerTodasLasCategorias(){
 			include_once('../../logica/logicaCategorias.php');
 			$logica = new logicaCategorias;
 			$lista = $logica->getTodasLasCategorias();		
			return $lista;
 		}

 		function obtenerCategoriasActivas(){
 			include_once('../../logica/logicaCategorias.php');
 			$logica = new logicaCategorias;
 			$lista = $logica->obtenerCategoriasActivas();		
 			return $lista;
 		}

 		function obtenerCategoriasSevriNuevo(){
 			include_once('../../logica/logicaCategorias.php');
 			$logica = new logicaCategorias;
 			$lista = $logica->obtenerCategoriasSevriNuevo();		
 			return $lista;
 		}

 		function obtenerDepartamentos(){
 			include_once('../../logica/logicaDepartamentos.php');
 			$logica = new logicaDepartamentos;
 			$lista = $logica->obtenerDepartamentos();		
 			return $lista;
 		}

 		function obtenerDepartamentosAgregados(){
 			include_once('../../logica/logicaDepartamentos.php');
 			$logica = new logicaDepartamentos;
 			$lista = $logica->obtenerDepartamentosAgregados();		
 			return $lista;
 		}

 		function obtenerDepartamentosSevriNuevo(){
 			include_once('../../logica/logicaDepartamentos.php');
 			$logica = new logicaDepartamentos;
 			$lista = $logica->obtenerDepartamentosSevriNuevo();		
 			return $lista;
 		}

 		function obtenerValorFormula(){
 			include_once('../../logica/logicaParametros.php');
 			$logica = new logicaParametros;
 			$valorFormula = $logica->obtenerValorFormula();		
 			return $valorFormula;
 		}

 		function obtenerRiesgos(){
 			include_once('../../data/dtRiesgo.php');
 			$data = new dtRiesgo;
 			$lista = $data->getRiesgos();

 			if(!$lista){
 			return false;
	 		}else{
	 			return $lista;
	 		}
 		}

 		function obtenerRiesgosSevriActivo(){
 			include_once('../../data/dtRiesgo.php');
 			$data = new dtRiesgo;
 			$lista = $data->getRiesgosSevriActivo();

 			if(!$lista){
 			return false;
	 		}else{
	 			return $lista;
	 		}
 		}
 	}

?>
