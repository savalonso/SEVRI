<?php 
include_once("../dominio/dDepartamento.php");
include_once("../data/dtDepartamentoUsuario.php");
include_once("../dominio/dDepartamentoUsuario.php");

class ctrDepartamentos {
	function ctrDepartamentos(){}

	function insertarDepartamento(){
		include_once("../logica/logicaDepartamento.php");
		$logica=new LogicaDepartamento;
		$mdepartamento=new dDepartamento;
		$mdepartamento->setCodigoDepartamento($_POST['codigo']);
		$mdepartamento->setNombreDepartamento($_POST['nombre']);
		$mdepartamento->setFechaCreacion($_POST['fecha']);
		$resultado = $logica->insertarDepartamento($mdepartamento);
		echo $resultado;
	}

	function modificarDepartamento(){	
		include_once("../logica/logicaDepartamento.php");
		$logica = new LogicaDepartamento;
		$mdepartamento = new dDepartamento;
		$mdepartamento->setCodigoDepartamento($_POST['codigoDepartamento']);
		$mdepartamento->setNombreDepartamento($_POST['nombreDepartamento']);
		$mdepartamento->setFechaCreacion($_POST['fechaDepartamento']);
		$mdepartamento->setIdDepartamento($_POST['idDepartamento']);
		$resultado = $logica->modificarDepartamento($mdepartamento);
		echo $resultado;
	}

	function eliminarDepartamento(){
		include_once("../logica/logicaDepartamento.php");
		$logica = new LogicaDepartamento;
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
				Se ha insertado correctamente el usuario.
			';
		} else {
			echo 
			'	
				Error! No se ha podido insertar el usuario.
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
				Se ha eliminado correctamente el usuario.
			';
		} else {
			echo 
			'	
				Error! No se ha podido eliminar el usuario.
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