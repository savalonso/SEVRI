<?php 
		include_once ('../../data/dtCategoria.php');
	class ctrListaCategoria{

		function ctrListaCategoria(){}

		function obtenerListaCategoriasDE(){

			$dataCategoria = new dtCategoria();
			$lista = $dataCategoria->getListaCategoriaDE();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
		}
		function obtenerCategoria($idCategoria){
			$dataCategoria = new dtCategoria();
			$categoria = $dataCategoria->getCategoria($idCategoria);
			if(!$categoria){
				return false;
			}else{
				return $categoria;
			}
		}
	}

 ?>