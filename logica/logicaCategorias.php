<?php 

class logicaCategorias{

	public function logicaCategorias(){}

	public function obtenerCategoriasActivas(){
		include_once('../../data/dtCategoria.php');
		$data = new dtCategoria;
		$lista = $data->obtenerCategoriasActivas();		
		if(!$lista){
			return false;
		}else{
			return $lista;
		}
	}

	public function getTodasLasCategorias(){
		include_once('../../data/dtCategoria.php');
		$data = new dtCategoria;
		$lista = $data->getTodasLasCategorias();		
		if(!$lista){
			return false;
		}else{
			return $lista;
		}
	}

	public function obtenerCategoriasSevriNuevo(){
		include_once('../../data/dtCategoria.php');
		$data = new dtCategoria;
		$lista = $data->obtenerCategoriasSevriNuevo(2);		
		if(!$lista){
			return false;
		}else{
			return $lista;
		}
	}

	public function obtenerCategorias(){
		include_once('../../data/dtCategoria.php');
		$data = new dtCategoria;
		$lista = $data->getCategorias();		
		if(!$lista){
			return false;
		}else{
			return $lista;
		}
	}
	
}

 ?>