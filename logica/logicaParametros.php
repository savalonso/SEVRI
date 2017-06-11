<?php 

class logicaParametros{

	public function logicaParametros(){}

	public function obtenerParametros(){
		include_once('../../data/dtParametro.php');
		$data = new dtParametro;
		$lista = $data->getParametros();		
		if(!$lista){
		return false;
		}else{
			return $lista;
		}
	}

	public function obtenerParametrosSevriActivo(){
		include_once('../../data/dtParametro.php');
		$data = new dtParametro;
		$lista = $data->getParametrosSevriActivo();		
		if(!$lista){
		return false;
		}else{
			return $lista;
		}
	}

	public function obtenerValorFormula(){
		include_once('../../data/dtParametro.php');
		$data = new dtParametro;
		$lista = $data->getParametrosSevriActivo();		
		$maximaProbabilidad = 0;
		$maximoImpacto = 0;

		foreach ($lista as $parametro) {
			if (strcmp ($parametro->getNombreParametro() , "Probabilidad" ) == 0) {
				if($maximaProbabilidad < $parametro->getValorParametro()){
					$maximaProbabilidad = $parametro->getValorParametro();
				}
			}elseif (strcmp ($parametro->getNombreParametro() , "Impacto" ) == 0) {
				if($maximoImpacto < $parametro->getValorParametro()){
					$maximoImpacto = $parametro->getValorParametro();
				}
			} 	
		}

		$valorFormula = 100 / (($maximoImpacto * $maximaProbabilidad)/1);
		return $valorFormula;
	}

	public function obtenerValorFormulaReporte($desicion, $idSevri){
		include_once('../data/dtParametro.php');
		$data = new dtParametro;
		$lista = $data->getParametrosReporte($desicion, $idSevri);		
		$maximaProbabilidad = 0;
		$maximoImpacto = 0;

		foreach ($lista as $parametro) {
			if (strcmp ($parametro->getNombreParametro() , "Probabilidad" ) == 0) {
				if($maximaProbabilidad < $parametro->getValorParametro()){
					$maximaProbabilidad = $parametro->getValorParametro();
				}
			}elseif (strcmp ($parametro->getNombreParametro() , "Impacto" ) == 0) {
				if($maximoImpacto < $parametro->getValorParametro()){
					$maximoImpacto = $parametro->getValorParametro();
				}
			} 	
		}

		$valorFormula = 100 / (($maximoImpacto * $maximaProbabilidad)/1);
		return $valorFormula;
	}

	public function obtenerParametrosSevriNuevo(){
		include_once('../../data/dtParametro.php');
		$data = new dtParametro;
		$lista = $data->getParametrosSevriNuevo(2);		
		if(!$lista){
		return false;
		}else{
			return $lista;
		}
	}

}

 ?>