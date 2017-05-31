<?php 
class LogicaCategoria{
	public function LogicaCategoria(){

	}

	public function insertarCategoria($categoria){
		include_once("../data/dtCategoria.php");

		$dtcategoria = new dtCategoria();

		$resultado = $dtcategoria->insertarCategoria($categoria);
		$mensaje = '';

		if(!$resultado){
			return 'Lo sentimos no se ha podido ingresar la categoria';
		}else{
			return 'La categoría se ingresó correctamente';
		}
	}
}

?>