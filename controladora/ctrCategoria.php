<?php 
	include_once("../dominio/dCategoria.php");
	include_once("../data/dtCategoria.php");
	class ctrCategoria {
		
		function ctrCategoria(){}

		function insertarCategoria(){
			include_once("../logica/logicaCategoria.php");
			$logica = new LogicaCategoria;
	      	$mcategoria = new dCategoria;

	      	if($sub = $_POST['subcategoria']==0){
	      		$mcategoria->setHijoDe(0);
	      	}else{
	      		$mcategoria->setHijoDe($_POST['categoria']);
	      	}

    		$mcategoria->setNombreCategoria($_POST['nombre']);
    		$mcategoria->setDescripcion($_POST['descripcion']);

    		
    		if($resultado = $logica->insertarCategoria($mcategoria)==true){
	      		echo 
	      		'	
					Perfecto! Se ha insertado la categoría correctamente.

	      		';
		    }else {
	      		echo 
	      		'	
					Se ha producido un error al insertar la categoría.
	      		';
		    }
		}
		function eliminarCategoria(){
			$id = $_POST['idCategoria'];
	      	$dataCategoria = new dtCategoria();
            
            if($dataCategoria->eliminarCategoria($id) == true){
	      		echo 
	      		'	
					Perfecto! Se ha eliminado la categoría correctamente.

	      		';
		    }else {
	      		echo 
	      		'	
					  	<strong>Error!</strong> Se ha producido un error al eliminar la categoría.
	      		';
		    }
	    }
		function modificarCategoria(){
	      	$mcategoria = new dCategoria;
	      	$mcategoria->setIdCategoria($_POST['idCategoria']);
	      	if($sub = $_POST['subcategoria']==0){
	      		$mcategoria->setHijoDe(0);
	      	}else{
	      		$mcategoria->setHijoDe($_POST['categoria']);
	      	}
    		$mcategoria->setNombreCategoria($_POST['nombre']);
    		$mcategoria->setDescripcion($_POST['descripcion']);
	      	$dataCategoria = new dtCategoria;
               
	      	if($dataCategoria->modificarCategoria($mcategoria) == true){
	      		echo 
	      		'	
	      			Se ha modificado correctamente la categoría.
	      		';
	      	} else {
	      		echo 
	      		'	
	      			Error! No se ha podido modificar la categoría.
	      		';
	      	}
		}
	 }
	?>
	<?php

	$op = $_POST['opcion'];
	$control = new ctrCategoria;
	if($op == 1){
	 	$control->insertarCategoria();
	}
	else if($op == 2){
	 	$control->eliminarCategoria();
	}
	else if($op == 3){
	 	$control->modificarCategoria();
	}
?>