<?php 

	
	include_once("../dominio/dParametro.php");
	include_once("../data/dtSevri.php");
	class ctrParametros {
		
		function ctrParametros(){}

		function insertarParametros(){
			include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;
	      	$mparametro = new dParametro;

    		$mparametro->setNombreParametro($_POST['Tparametro']);
    		$mparametro->setDescriptorParametro($_POST['descriptor']);
    		$mparametro->setDescripcionParametro($_POST['descripcion']);
    		$mparametro->setValorParametro($_POST['valor']);
    		$mparametro->setColorParametro($_POST['color']);
	      
	      	$resultado = $logica->insertarParametro($mparametro);
			echo $resultado;
		}

		function modificarParametro(){
			include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;
	      	$mparametro = new dParametro;

    		$mparametro->setNombreParametro($_POST['Tparametro']);
    		$mparametro->setDescriptorParametro($_POST['descriptor']);
    		$mparametro->setDescripcionParametro($_POST['descripcion']);
    		$mparametro->setValorParametro($_POST['valor']);
    		$mparametro->setColorParametro($_POST['color']);
    		$mparametro->setIdParametro($_POST['idParametro']);
	      
	      	$resultado = $logica->modificarParametro($mparametro);
			echo $resultado;
		}

		function eliminarParametro(){
			include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;
    		$idParametro = $_POST['idParametro'];
	      
	      	$resultado = $logica->eliminarParametro($idParametro);
			echo $resultado;
		}
	}
	?>
	<?php

	$op = $_POST['opcion'];
	$control = new ctrParametros;
	if($op == 1){
	 	$control->insertarParametros();
	}else if($op == 2){
		$control->modificarParametro();
	}else if($op == 3){
		$control->eliminarParametro();
	}
	

?>