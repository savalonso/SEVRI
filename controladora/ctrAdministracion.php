<?php 

class ctrAdministracion{

	public function ctrAdministracion(){}
	
	function insertarAdministracion(){
		
		include_once("../logica/logicaAdministracion.php");
		include_once("../dominio/dAdministracion.php");
		
		$logica = new logicaAdministracion;
		$administracion = new dAdministracion;
		$administracion->setUsuario($_POST['encargado']);
		$administracion->setActividadTratamiento($_POST['actividad']);
		$administracion->setPlazoTratamiento($_POST['plazo']);
		$montoTemp =str_replace(".","",$_POST['valor']);
		$administracion->setCostoActividad(str_replace("₡","",$montoTemp));
		$administracion->setIndicador($_POST['indicador']);
		$administracion->setMedidaAdministracion($_POST['medida']);
		$analisis = $_POST['analisis'];
		$resultado = $logica->insertarAdministracion($administracion, $analisis);
		echo $resultado;
	}
	
	function actualizarAdministracion(){
		
		include_once("../logica/logicaAdministracion.php");
		include_once("../dominio/dAdministracion.php");

		$administracion = new dAdministracion();
		$administracion->setId($_POST['idAdmi']);
		$administracion->setUsuario($_POST['encargado']);
		$administracion->setActividadTratamiento($_POST['actividad']);
		$administracion->setPlazoTratamiento($_POST['plazo']);
		$montoTemp =str_replace(".","",$_POST['valor']);
		$administracion->setCostoActividad(str_replace("₡","",$montoTemp));
		$administracion->setMedidaAdministracion($_POST['medida']);
		$administracion->setIndicador($_POST['indicador']);
		$logicaAdmi = new logicaAdministracion();
		
		if($logicaAdmi->actualizarAdministracion($administracion) == true){
			echo 'Se ha modificado correctamente la administraci&oacuten del riesgo.';
		} else {
			echo 'No se ha modificado la administraci&oacuten del riesgo.';
		}
	}
	
	function eliminarAdministracion(){
		
		include_once("../logica/logicaAdministracion.php");
		
		$idAdmi = $_POST['idAdmi'];
		$logica = new logicaAdministracion();
		
		if($logica->eliminarAdmi($idAdmi) == true){
			echo 'Se ha eliminado correctamente la administraci&oacuten del riesgo.';
		} else {
			echo 'No se ha eliminado la administraci&oacuten del riesgo.';
		}
	}
}

$op = $_POST['opcion'];
$control = new ctrAdministracion;

if($op == 1){
	$control->insertarAdministracion();
}
if($op == 2){	
	$control->actualizarAdministracion();
}
if($op == 3){	
	$control->eliminarAdministracion();
}
?>