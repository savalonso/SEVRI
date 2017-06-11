<?php


	class ctrSeguimiento{

		function ctrSeguimiento(){}

				
		function insertarSeguimientoNuevo(){
			include_once("../dominio/dSeguimiento.php");
			include_once("../logica/logicaSeguimiento.php");
	      	$seguimiento = new dSeguimiento;
			$logica = new logicaSeguimiento;

			$seguimiento->setActividadTratamiento($_POST['IdAdministracion']);
			$seguimiento->setMontoSeguimiento($_POST['monto']);
			$seguimiento->setComentarioAvance($_POST['comentario']);
			$seguimiento->setPorcentajeAvance($_POST['porcentaje']);
			$seguimiento->setUsuarioAprobador($_POST['aprobador']);
			
	      	$resultado = $logica->insertarSeguimientoNuevo($seguimiento);
			echo $resultado;
		}

		function eliminarSeguimiento(){
			include_once("../data/dtSeguimiento.php");
			$dataSeguimiento = new dtSeguimiento;
			$id = $_POST['id'];
			
	      	if($dataSeguimiento->eliminarSeguimiento($id) == true){
	      		echo 'Se ha eliminado el seguimiento con exito.';
	      	} else {
	      		echo 'Lo sentimos no se ha podido eliminar el seguimiento';
	      	}
		}

		function modificarSeguimiento(){
			include_once("../dominio/dSeguimiento.php");
			include_once("../logica/logicaSeguimiento.php");
	      	$seguimiento = new dSeguimiento;
			$logica = new logicaSeguimiento;

			$seguimiento->setId($_POST['IdSeguimiento']);
			$seguimiento->setMontoSeguimiento($_POST['monto']);
			$seguimiento->setComentarioAvance($_POST['comentario']);
			$seguimiento->setPorcentajeAvance($_POST['porcentaje']);
			$seguimiento->setUsuarioAprobador($_POST['aprobador']);
			
	      	$resultado = $logica->modificarSeguimiento($seguimiento);
			echo $resultado;
		}

		function insertarSeguimientoAprobador(){
			include_once("../dominio/dSeguimiento.php");
			include_once("../logica/logicaSeguimiento.php");
			$logica = new logicaSeguimiento;
			$seguimiento = new dSeguimiento;
			$seguimiento->setEstadoSeguimiento($_POST['estado']);
			$seguimiento->setComentarioAprobador($_POST['comentario']);
			$id=$_POST['idSeguimiento'];

			$resultado = $logica->insertarSeguimientoAprobador($id,$seguimiento);
			echo $resultado;
		}
		function modificarSeguimientoAprobador(){
			include_once("../dominio/dSeguimiento.php");
			include_once("../logica/logicaSeguimiento.php");
			$logica = new logicaSeguimiento;
			$seguimiento = new dSeguimiento;
			$seguimiento->setEstadoSeguimiento($_POST['estadoSeguimiento']);
			$seguimiento->setComentarioAprobador($_POST['comentarioAprobador']);
			$id=$_POST['idSeguimiento'];
			$resultado = $logica->modificarSeguimientoAprobador($id,$seguimiento);
			echo $resultado;
		}
		function eliminarSeguimientoAprobador(){
			include_once("../logica/logicaSeguimiento.php");
			$logica=new logicaSeguimiento;
			$idSeguimiento=$_POST['idSeguimiento'];
			$resultado=$logica->eliminarSeguimientoAprobador($idSeguimiento);
			echo $resultado;
		}
	}

	$op = $_POST['opcion'];
	$control = new ctrSeguimiento;
	if($op==1){
		$control->insertarSeguimientoAprobador();
	}else if($op==2){
		$control->modificarSeguimientoAprobador();
	}else if($op==3){
		$control->eliminarSeguimientoAprobador();
	} else if ($op==4) {
		$control->insertarSeguimientoNuevo();
	} else if ($op==5) {
		$control->modificarSeguimiento();
	} else if ($op==6) {
		$control->eliminarSeguimiento();
	}
  ?>