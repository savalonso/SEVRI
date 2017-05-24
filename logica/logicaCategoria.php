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
			$mensaje = 'Lo sentimos no se ha podido ingresar la categoria';
		}else{
			$resultado1 = $dtcategoria->insertarSevriCategoria();
			if(!$resultado1){
				$mensaje =  'Lo sentimos no se ha podido ingresar la categoria';
			}else{
				$mensaje =  'La categoria se ha ingresado correctamente';
			}
			
		}
		return $mensaje;
	}
}

?>