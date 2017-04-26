<?php


	class ctrSeguimiento{

		function ctrSeguimiento(){}


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
	$control=new ctrSeguimiento;
	if($op==1){
		$control->insertarSeguimientoAprobador();
	}else if($op==2){
		$control->modificarSeguimientoAprobador();
	}else if($op==3){
		$control->eliminarSeguimientoAprobador();
	}

  ?>