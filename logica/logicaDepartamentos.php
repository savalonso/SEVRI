<?php 

class logicaDepartamentos{

	public function logicaDepartamentos(){}

	public function obtenerDepartamentos(){
		include_once('../../data/dtDepartamento.php');
		$data = new dtDepartamento;
		$lista = $data->getDepartamentos();		
		if(!$lista){
		return false;
		}else{
			return $lista;
		}
	}

	public function obtenerDepartamentosAgregados(){
		include_once('../../data/dtDepartamento.php');
		$data = new dtDepartamento;
		$lista = $data->getDepartamentosAgregados();		
		if(!$lista){
		return false;
		}else{
			return $lista;
		}
	}

	public function obtenerDepartamentosUsuario($cedula){
		include_once('../../data/dtDepartamento.php');
		$data = new dtDepartamento;
		$lista = $data->getDepartamentosUsuario($cedula);		
		if(!$lista){
		return false;
		}else{
			return $lista;
		}
	}

	public function obtenerDepartamentosSevriNuevo(){
		include_once('../../data/dtDepartamento.php');
		$data = new dtDepartamento;
		$lista = $data->getDepartamentosSevriNuevo(2);		
		if(!$lista){
		return false;
		}else{
			return $lista;
		}
	}
	
	public function insertarDepartamento($departamento){

		include_once("../data/dtDepartamento.php");
		$dtdepartamento=new dtDepartamento();
		$resultado=$dtdepartamento->insertarDepartamentos($departamento);
		$mensaje = '';
		if(!$resultado){
			$mensaje = 'Lo sentimos no se ha podido ingresar el departamento';
		} else {
			$mensaje =  'El departamento se ha ingresado correctamente';
		}
		return $mensaje;
	}
	
	public function modificarDepartamento($departamento,$idDepartamento){
		include_once("../data/dtDepartamento.php");
		$dtdepartamento = new dtDepartamento();
		$resultado = $dtdepartamento->modificarDepartamento($departamento,$idDepartamento);
		$mensaje = '';
		if(!$resultado){	
			$mensaje = 'Lo sentimos no se ha podido modificar el departamento';			
		} else{	
			$mensaje = 'El departamento se ha modificado correctamente';
		}
		return $mensaje;
	}
	
	public function eliminarDepartamento($idDepartamento){	
		include_once("../data/dtDepartamento.php");
		$dtdepartamento = new dtDepartamento();
		$resultado=$dtdepartamento->eliminarDepartamento($idDepartamento);
		$mensaje='';
		if(!$resultado){
			$mensaje='Lo sentimos no se ha podido eliminar del departamento';
		} else {
			$mensaje='Se ha eliminado el departamento';
		}
		return $mensaje;
	}
	
	public function traerDepartamentos(){
		include_once('../data/dtDepartamento.php');
		$dataDepartamento = new dtDepartamento();
		$lista = $dataDepartamento->getDepartamentos();
		if(!$lista){	
			return false;
		} else {
			return $lista;
		}
	}

	public function obtenerDepartamentosSeguimientos(){
		include_once('../../data/dtDepartamento.php');
		$dataDepartamento = new dtDepartamento();
		$lista=$dataDepartamento->getDepartamentosSeguimientos();
		if(!$lista){	
			return false;
		} else {
			return $lista;
		}
	}
	
	public function obtenerDepartamentosFiltrados(){
		include_once('../../data/dtDepartamento.php');
		$dataDepartamento=new dtDepartamento();
		$listaDepartamentos=$dataDepartamento->getDepartamentos();
		$sevriDepartamentos=$dataDepartamento->getSevriDepartamentos();
		$vinculados=array();
		$encontrado=false;
		for ($i=0; $i <count($listaDepartamentos) ; $i++) {
			for ($j=0; $j <count($sevriDepartamentos) ; $j++) {
				$temporalSevriDepartamento=$sevriDepartamentos[$j];
				if($listaDepartamentos[$i]->getIdDepartamento()==$temporalSevriDepartamento['idDepartamento']){
					array_push($vinculados, $listaDepartamentos[$i]);
					$j=count($sevriDepartamentos);
				}
			}
		}
		for ($i=0; $i <count($listaDepartamentos) ; $i++) {
			for ($j=0; $j < count($vinculados); $j++) {
				if ($listaDepartamentos[$i]->getIdDepartamento()==$vinculados[$j]->getIdDepartamento()) {
					$encontrado=true;
				}
			}
			if ($encontrado==false) {	
				$listaDepartamentos[$i]->setEsModificable(true);
			} else {
				$listaDepartamentos[$i]->setEsModificable(false);
				$encontrado=false;
			}
		}
		if (!$listaDepartamentos) {
			return false;
		} else {
			return $listaDepartamentos;
		}
	}

}

 ?>