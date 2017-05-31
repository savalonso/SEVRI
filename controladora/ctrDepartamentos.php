<?php 

include_once("../dominio/dDepartamento.php");
include_once("../data/dtDepartamentoUsuario.php");
include_once("../dominio/dDepartamentoUsuario.php");

class ctrDepartamentos {
	function ctrDepartamentos(){}

	function insertarDepartamento(){
		include_once("../logica/logicaDepartamentos.php");
		$logica=new logicaDepartamentos;
		$mdepartamento=new dDepartamento;
		$mdepartamento->setCodigoDepartamento($_POST['codigo']);
		$mdepartamento->setNombreDepartamento($_POST['nombre']);
		$mdepartamento->setFechaCreacion($_POST['fecha']);
		$resultado = $logica->insertarDepartamento($mdepartamento);
		echo $resultado;
	}

	function modificarDepartamento(){	
		include_once("../logica/logicaDepartamentos.php");
		$logica = new logicaDepartamentos;
		$mdepartamento = new dDepartamento;
		$mdepartamento->setNombreDepartamento($_POST['nombre']);
		$mdepartamento->setFechaCreacion($_POST['fecha']);
		$mdepartamento->setCodigoDepartamento($_POST['codigo']);
		$id=$_POST['idDepartamento'];
		$resultado = $logica->modificarDepartamento($mdepartamento,$id);
		echo $resultado;
	}

	function eliminarDepartamento(){
		include_once("../logica/logicaDepartamentos.php");
		$logica = new logicaDepartamentos;
		$idDepartamento = $_POST['idDepartamento'];
		$resultado = $logica->eliminarDepartamento($idDepartamento);
		echo $resultado;
	}

	function insertarDepartamentoUsuarios(){
		$depaUsu = new dDepartamentoUsuario;
		$depaUsu->setIdDepartamento($_POST['idDepartamento']);
		$depaUsu->setCedulaUsuario($_POST['cedulaUsuario']);
		
		$dataDepaUsu = new dtDepartamentoUsuario;
		if($dataDepaUsu->insertarDepartamentoUsuario($depaUsu) == true){
			echo 
			'
				Se ha agregado con exito el usuario al departamento.
			';
		} else {
			echo 
			'	
				Error! No se ha agregado el usuario al departamento.
			';
		}
	}

	function eliminarUsuarioDepartamento(){
		$idDepartamento = $_POST['idDepartamento'];
		$cedulaUsuario = ($_POST['cedulaUsuario']);
		$dataDepaUsu = new dtDepartamentoUsuario;
		if($dataDepaUsu->eliminarUsuarioDepartamento($idDepartamento, $cedulaUsuario) == true){
			echo 
			'
				Se ha descartado con exito el usuario del departamento.
			';
		} else {
			echo 
			'	
				Error! No se ha descartado el usuario del departamento.
			';
		}
	}
}

$op = $_POST['opcion'];
$control = new ctrDepartamentos;
if($op == 1){
	$control->insertarDepartamento();
}else if($op == 2){
	$control->modificarDepartamento();
}else if($op == 3){
	$control->eliminarDepartamento();
} else if($op == 4){
	$control->insertarDepartamentoUsuarios();
} else if($op == 5){
	$control->eliminarUsuarioDepartamento();
}
?>