<?php 

	
	include_once("../dominio/dSevri.php");
	include_once("../data/dtSevri.php");
	class ctrSevri {
		
		function ctrSevri(){}

		function insertarSevri(){
			include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;
	      	$msevri = new dSevri;

    		$msevri->setNombreVersion($_POST['nombre']);
    		$msevri->setFechaVersion($_POST['fecha']);
	      
	      	$resultado = $logica->insertarSevri($msevri);
			echo $resultado;
		}

		function ActualizarSevri(){
			$sevri = new dSevri();
			$sevri->setNombreVersion($_POST['nombre']);
    		$sevri->setFechaVersion($_POST['fecha']);
	      	$id = $_POST['id'];
	      
	      	$dataSevri = new dtSevri();
               
	      	if($dataSevri->actualizarSevri($sevri,$id) == true){
	      		echo 
	      		'	
					Perfecto! Se ha actualizado el SEVRI correctamente.
	      		';
	      	} else {
	      		echo 
	      		'	
					Error! Se ha producido un error al actualizar el SEVRI.
	      		';
	      	}
		}

		function eliminarSevri(){
	      	$id = $_POST['idSevri'];
	      
	      	$dataSevri = new dtSevri();
               
	      	if($dataSevri->eliminarSevri($id) == true){
	      		echo 
	      		'	
					Perfecto! Se ha eliminado el SEVRI correctamente.

	      		';
	      	} else {
	      		echo 
	      		'	
					  	<strong>Error!</strong> Se ha producido un error al eliminar el SEVRI.
	      		';
	      	}
		}

		function insertarParametroSevri(){
	      	include("../data/dtParametro.php");

	      	$idParametro = $_POST['id'];
	      	$dataParam = new dtParametro;
           	$Respuesta = array();    
	      	if($dataParam->insertarSevriParametro($idParametro) == true){

	      		$Respuesta[] = array('inserto' => 1,
                   					 'mensaje' => "Se ha vinculado correctamente el parametro");	

	      		echo '' . json_encode($Respuesta) . '';
	      	} else {
	      		$Respuesta[] = array('inserto' => 0,
                   					 'mensaje' => "No se ha podido vincular el parametro");
	      		echo '' . json_encode($Respuesta) . '';
	      	}
		}

		function eliminarParametroSevri(){
	      	include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;

	      	$idParametro = $_POST['id'];
            $Respuesta = array();   
	      	if($logica->desvincularParametro($idParametro) == true){
	      		$Respuesta[] = array('inserto' => 1,
                   					 'mensaje' => "Se ha desvinculado correctamente el parametro");	
	      		echo '' . json_encode($Respuesta) . '';
	      	} else {
	      		$Respuesta[] = array('inserto' => 0,
                   					 'mensaje' => "No se ha podido desvincular el parametro");
	      		echo '' . json_encode($Respuesta) . '';
	      	}
		}

		function insertarCategoriaSevri(){
	      	include("../data/dtCategoria.php");

	      	$idCategoria = $_POST['id'];
	      	$dataCat = new dtCategoria;
            $Respuesta = array(); 
	      	if($dataCat->insertarSevriCategoria($idCategoria) == true){
	      		$Respuesta[] = array('inserto' => 1,
                   					 'mensaje' => "Se ha vinculado correctamente la categoria");	
	      		echo '' . json_encode($Respuesta) . '';
	      	} else {
	      		$Respuesta[] = array('inserto' => 0,
                   					 'mensaje' => "No se ha podido vincular la categoria");
	      		echo '' . json_encode($Respuesta) . '';
	      	}
		}

		function eliminarCategoriaSevri(){
	      	include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;

	      	$idCategoria = $_POST['id'];
            $Respuesta = array();   
	      	if($logica->desvincularCategoria($idCategoria) == true){
	      	$Respuesta[] = array('inserto' => 1,
                   				 'mensaje' => "Se ha desvinculado correctamente la categoria");	
				echo '' . json_encode($Respuesta) . '';
	      	} else {
	      		$Respuesta[] = array('inserto' => 0,
                   					 'mensaje' => "No se ha podido desvincular la categoria");
	      		echo '' . json_encode($Respuesta) . '';
	      	}
		}

		function InsertarDepartamento(){
	      	include("../data/dtDepartamento.php");

	      	$idDepartamento = $_POST['id'];
	      	$dataDep = new dtDepartamento();
            $Respuesta = array(); 
	      	if($dataDep->insertarSevriDepartamento($idDepartamento) == true){
	      		$Respuesta[] = array('inserto' => 1,
                   				 	 'mensaje' => "Se ha vinculado correctamente el departamento");	
				echo '' . json_encode($Respuesta) . '';
	      	} else {
	      		$Respuesta[] = array('inserto' => 0,
                   					 'mensaje' => "No se ha podido vincular el departamento");
	      		echo '' . json_encode($Respuesta) . '';
	      	}
		}

		function EliminarDepartamentoSevri(){
	      	include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;

	      	$idDepartamento = $_POST['id'];
            $Respuesta = array();   
	      	if($logica->desvincularDepartamento($idDepartamento) == true){
	      	$Respuesta[] = array('inserto' => 1,
                   				 'mensaje' => "Se ha desvinculado correctamente el departamento");	
				echo '' . json_encode($Respuesta) . '';
	      	} else {
      		$Respuesta[] = array('inserto' => 0,
                   				 'mensaje' => "No se ha podido desvincular el departamento");
	      		echo '' . json_encode($Respuesta) . '';
	      	}
		}

		function ActivarSevri(){
			include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;
			$idSevri = $_POST['idSevri'];
			
			$resultado = $logica->verificarComplementos($idSevri);
			echo $resultado;
		}

		function DesactivarSevri(){
			include_once("../logica/logicaSevri.php");
			$logica = new LogicaSevri;
			$idSevri = $_POST['idSevri'];
			
			$resultado = $logica->desactivarSevri($idSevri);
			echo $resultado;
		}
	}
	?>
	<?php

	$op = $_POST['opcion'];
	$control = new ctrSevri;
	if($op == 1){
	 	$control->insertarSevri();
	}
	else if($op == 2){
	 	$control->insertarSevriParametros();
	}
	else if($op == 3){
	 	$control->insertarSevriCategorias();
	}
	else if($op == 4){
	 	$control->insertarSevriDepartamentos();
	}else if($op == 5){
		$control->ActualizarSevri();
	}
	else if($op == 6){
		$control->eliminarSevri();
	}
	else if($op == 7){
		$control->insertarParametroSevri();
	}
	else if($op == 8){
		$control->eliminarParametroSevri();
	}
	else if($op == 9){
		$control->insertarCategoriaSevri();
	}
	else if($op == 10){
		$control->eliminarCategoriaSevri();
	}
	else if($op == 11){
		$control->InsertarDepartamento();
	}
	else if($op == 12){
		$control->EliminarDepartamentoSevri();
	}
	else if($op == 13){
		$control->ActivarSevri();
	}
	else if($op == 14){
		$control->DesactivarSevri();
	}

?>