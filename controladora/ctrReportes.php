<?php 
	
	class ctrReporte {
		
		function ctrReporte(){}


		function generarReporteRiesgoExcel(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteRiesgoExcel();
		}

		function generarReporteAnalisisExcel(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteAnalisisExcel();
		}

		function generarReporteAdministracionExcel(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteAdministracionExcel();
		}

		function generarReporteSeguimientoExcel(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteSeguimientoExcel();
		}

		function generarReporteSevriExcel(){
			include_once("../logica/logicaReporte.php");
			$idSevri = $_GET['sevriReporte'];
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteSevriExcel($idSevri);
		}

		function generarReporteRiesgoWord(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteRiesgoWord();
		}

		function generarReporteAnalisisWord(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteAnalisisWord();
		}

		function generarReporteAdministracionWord(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteAdministracionWord();
		}

		function generarReporteSeguimientoWord(){
			include_once("../logica/logicaReporte.php");
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteSeguimientoWord();
		}

		function generarReporteSevriWord(){
			include_once("../logica/logicaReporte.php");
			$idSevri = $_GET['sevriReporte'];
	      	$logReporte = new LogicaReporte();
	      	$respuesta = $logReporte->reporteSevriWord($idSevri);
		}
	}

	$op = $_GET['opcion'];
	$control = new ctrReporte;
	if($op == 1){
	 	$control->generarReporteRiesgoExcel();
	}
	else if($op == 2){
	 	$control->generarReporteAnalisisExcel();
	}
	else if($op == 3){
	 	$control->generarReporteAdministracionExcel();
	}
	else if($op == 4){
	 	$control->generarReporteSeguimientoExcel();
	}
	else if($op == 5){
	 	$control->generarReporteSevriExcel();
	}
	else if($op == 6){
	 	$control->generarReporteRiesgoWord();
	}
	else if($op == 7){
	 	$control->generarReporteAnalisisWord();
	}
	else if($op == 8){
	 	$control->generarReporteAdministracionWord();
	}
	else if($op == 9){
	 	$control->generarReporteSeguimientoWord();
	}
	else if($op == 10){
	 	$control->generarReporteSevriWord();
	}
?>