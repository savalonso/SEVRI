<?php 
	class LogicaReporte{

		public function LogicaReporte(){}

		public function reporteRiesgoExcel(){

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Reporte_Riesgos.xls");	
			include_once('../data/dtRiesgo.php');
			$data = new dtRiesgo;
			$lista = $data->getRiesgosReporte();		
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>

				<body>

					<table width="100%" border="2" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="9" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
					</table>
					
					<?php 

						$this->imprimirReporteRiesgo($lista);

					 ?>

				</body>
			</html>
			<?php 
		}

		public function reporteRiesgoWord(){

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=Reporte_Riesgos.doc");
			
			include_once('../data/dtRiesgo.php');
			$data = new dtRiesgo;
			$lista = $data->getRiesgosReporte();		
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>

				<body>

					<table width="100%" border="2" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="9" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
					</table>
					
					<?php 

						$this->imprimirReporteRiesgo($lista);

					 ?>

				</body>
			</html>
			<?php 
		}

		public function asignarNivelRiesgo($impacto, $probabilidad, $valorFormula, $listaNivel){
			$mensaje = '';
			$limiteInicial = 0;
			$contador = 1;
			$cantidadDivisiones = count($listaNivel);
			$resultadoOperacion = round(($impacto*$probabilidad)/1*$valorFormula);
			foreach ($listaNivel as $nivel) {
				if(($resultadoOperacion >= $limiteInicial && $resultadoOperacion <= $nivel->getLimite() && $contador < $cantidadDivisiones) || ($contador == $cantidadDivisiones && $resultadoOperacion >= $limiteInicial)){
					$mensaje = $resultadoOperacion."%: ".$nivel->getDescriptor();
				}
				$contador++;
				$limiteInicial = $nivel->getLimite();
			}
			return $mensaje;
		}

		public function asignarColorNivelRiesgo($impacto, $probabilidad, $valorFormula, $listaNivel){
			$color = '';
			$limiteInicial = 0;
			$contador = 1;
			$cantidadDivisiones = count($listaNivel);
			$resultadoOperacion = round(($impacto*$probabilidad)/1*$valorFormula);
			foreach ($listaNivel as $nivel) {
				if(($resultadoOperacion >= $limiteInicial && $resultadoOperacion <= $nivel->getLimite() && $contador < $cantidadDivisiones) || ($contador == $cantidadDivisiones && $resultadoOperacion >= $limiteInicial)){
					$color = $nivel->getColor();
				}
				$contador++;
				$limiteInicial = $nivel->getLimite();
			}
			return $color;
		}

		public function reporteAnalisisExcel(){

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Reporte_AnalisisRiesgo.xls");	
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtNivelRiesgo.php');
			include_once('logicaParametros.php');

			$logicaParametro = new logicaParametros;
			$dataNivel = new dtNivelRiesgo;
			
			/*
			* Si se envía 1 se traen los parámetros y niveles por el sevri activo 
			* si se envía 2 se traen los parámentros y niveles por el id del sevri
			*/
			$nivelRiesgo = 	$dataNivel->getNivelesReporte(1);	
			$valorFormula = $logicaParametro->obtenerValorFormulaReporte(1);

			$data = new dtAnalisis;
			$lista = $data->getAnalisisReporte();
			
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>
				<body>

					<table width="100%" border="2" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="9" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
					</table>

					<?php 

						$this->imprimirReporteAnalisis($nivelRiesgo, $valorFormula, $lista);

					 ?>

				</body>
			</html>
			<?php 
		}

		public function reporteAnalisisWord(){

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=Reporte_AnalisisRiesgo.doc");

			include_once('../data/dtAnalisis.php');
			include_once('../data/dtNivelRiesgo.php');
			include_once('logicaParametros.php');

			$logicaParametro = new logicaParametros;
			$dataNivel = new dtNivelRiesgo;
			
			/*
			* Si se envía 1 se traen los parámetros y niveles por el sevri activo 
			* si se envía 2 se traen los parámentros y niveles por el id del sevri
			*/
			$nivelRiesgo = 	$dataNivel->getNivelesReporte(1);	
			$valorFormula = $logicaParametro->obtenerValorFormulaReporte(1);

			$data = new dtAnalisis;
			$lista = $data->getAnalisisReporte();		
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>
				<body>

					<table width="100%" border="2" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="9" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
					</table>
					
					<?php 

						$this->imprimirReporteAnalisis($nivelRiesgo, $valorFormula, $lista);

					 ?>

				</body>
			</html>
			<?php 
		}

		public function reporteAdministracionExcel(){

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Reporte_AdministracionRiesgo.xls");	
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtNivelRiesgo.php');
			include_once('logicaParametros.php');

			$logicaParametro = new logicaParametros;
			$dataNivel = new dtNivelRiesgo;
			
			/*
			* Si se envía 1 se traen los parámetros y niveles por el sevri activo 
			* si se envía 2 se traen los parámentros y niveles por el id del sevri
			*/
			$nivelRiesgo = 	$dataNivel->getNivelesReporte(1);	
			$valorFormula = $logicaParametro->obtenerValorFormulaReporte(1);

			$data = new dtAnalisis;
			$lista = $data->getAnalisisReporte();		
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>
				<body>
					<table>
						<tr>
							<td colspan="8" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí </strong></CENTER></td>
						</tr>
					</table><br />

					<?php 

						$this->imprimirReporteAdministracion($nivelRiesgo, $valorFormula, $lista);

					?>
					
				</body>
			</html>
			<?php 
		}

		public function reporteAdministracionWord(){

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=Reporte_AdministracionRiesgo.doc");

			include_once('../data/dtAnalisis.php');
			include_once('../data/dtNivelRiesgo.php');
			include_once('logicaParametros.php');

			$logicaParametro = new logicaParametros;
			$dataNivel = new dtNivelRiesgo;
			
			/*
			* Si se envía 1 se traen los parámetros y niveles por el sevri activo 
			* si se envía 2 se traen los parámentros y niveles por el id del sevri
			*/
			$nivelRiesgo = 	$dataNivel->getNivelesReporte(1);	
			$valorFormula = $logicaParametro->obtenerValorFormulaReporte(1);

			$data = new dtAnalisis;
			$lista = $data->getAnalisisReporte();		
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>
				<body>
					<table>
						<tr>
							<td colspan="8" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí </strong></CENTER></td>
						</tr>
					</table><br />

					<?php 

						$this->imprimirReporteAdministracion($nivelRiesgo, $valorFormula, $lista);

					 ?>

				</body>
			</html>
			<?php 
		}

		public function reporteSeguimientoExcel(){

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Reporte_Seguimiento_Riesgo.xls");	
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtNivelRiesgo.php');
			include_once('logicaParametros.php');

			$logicaParametro = new logicaParametros;
			$dataNivel = new dtNivelRiesgo;
			
			/*
			* Si se envía 1 se traen los parámetros y niveles por el sevri activo 
			* si se envía 2 se traen los parámentros y niveles por el id del sevri
			*/
			$nivelRiesgo = 	$dataNivel->getNivelesReporte(1);	
			$valorFormula = $logicaParametro->obtenerValorFormulaReporte(1);

			$data = new dtAnalisis;
			$lista = $data->getAnalisisReporte();		
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>
				<body>
					<table>
						<tr>
							<td colspan="8" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí </strong></CENTER></td>
						</tr>
						<br />
						<tr>
							<td></td>
							<td colspan="6" bgcolor="#1976d2 "><CENTER><strong>Reporte Seguimiento de Riesgos </strong></CENTER></td>
						</tr>
					</table>

					<?php 

						$this->imprimirReporteSeguimiento($nivelRiesgo, $valorFormula, $lista);

					?>
					
				</body>
			</html>
		<?php 
		}

		public function reporteSeguimientoWord(){

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=Reporte_Seguimiento_Riesgo.doc");
	
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtNivelRiesgo.php');
			include_once('logicaParametros.php');

			$logicaParametro = new logicaParametros;
			$dataNivel = new dtNivelRiesgo;

			/*
			* Si se envía 1 se traen los parámetros y niveles por el sevri activo 
			* si se envía 2 se traen los parámentros y niveles por el id del sevri
			*/
			$nivelRiesgo = 	$dataNivel->getNivelesReporte(1);	
			$valorFormula = $logicaParametro->obtenerValorFormulaReporte(1);

			$data = new dtAnalisis;
			$lista = $data->getAnalisisReporte();		
			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>
				<body>
					<table>
						<tr>
							<td colspan="8" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí </strong></CENTER></td>
						</tr>
						<br />
						<tr>
							<td></td>
							<td colspan="6" bgcolor="#1976d2 "><CENTER><strong>Reporte Seguimiento de Riesgos </strong></CENTER></td>
						</tr>
					</table>

					<?php 

						$this->imprimirReporteSeguimiento($nivelRiesgo, $valorFormula, $lista);

					 ?>

				</body>
			</html>
			<?php 
		}

		public function reporteSevriExcel($idSevri){

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Reporte_SEVRI.xls");	
			include_once('../data/dtRiesgo.php');
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtNivelRiesgo.php');
			include_once('logicaParametros.php');

			$logicaParametro = new logicaParametros;
			$dataNivel = new dtNivelRiesgo;

			/*
			* Si se envía 1 se traen los parámetros y niveles por el sevri activo 
			* si se envía 2 se traen los parámentros y niveles por el id del sevri
			*/
			$nivelRiesgo = 	$dataNivel->getNivelesReporte(2, $idSevri);	
			$valorFormula = $logicaParametro->obtenerValorFormulaReporte(2, $idSevri);

			$data = new dtRiesgo;
			$lista = $data->getRiesgosReporteSevri($idSevri);	

			$dataAnalisis = new dtAnalisis;
			$listaAnalisis = $dataAnalisis->getAnalisisReporteSevri($idSevri);

			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>

				<body>
					
					<table width="100%" border="2" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="9" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
						<br />
						<td colspan="9" bgcolor="#1565c0"><CENTER><strong>Reporte General de la Valoración de Riesgos Institucional</strong></CENTER></td>
						<br />
					</table><br />

					<table width="100%" border="2" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="8" bgcolor="#1976d2 "><CENTER><strong>Lista de Riesgos</strong></CENTER></td>
						</tr>
					</table><br />

					<?php 

						$this->imprimirReporteRiesgo($lista);

					 ?>

					 <br /><br />

					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td colspan="8" bgcolor="#1976d2 "><CENTER><strong>Lista de Análisis</strong></CENTER></td>
						</tr>
					</table><br />

						<?php 

							$this->imprimirReporteAnalisis($nivelRiesgo, $valorFormula, $listaAnalisis);

						 ?>

					 <br /><br />
					
					<table>
						<tr>
							<td colspan="8" bgcolor="#1976d2 "><CENTER><strong>Lista de Administraciones</strong></CENTER></td>
						</tr>
					</table><br />
					<?php 
						
						$this->imprimirReporteAdministracion($nivelRiesgo, $valorFormula, $listaAnalisis);

					?>

					 <br /><br />

					<table>

						<tr>
							<td colspan="8" bgcolor="#1976d2 "><CENTER><strong>Lista de Seguimiento</strong></CENTER></td>
						</tr>
					</table><br />

					<?php 
						
						$this->imprimirReporteSeguimiento($nivelRiesgo, $valorFormula, $listaAnalisis);

					?>
			
				</body>
			</html>
			<?php 
		}

		public function reporteSevriWord($idSevri){

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=Reporte_SEVRI.doc");
			include_once('../data/dtRiesgo.php');
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtNivelRiesgo.php');
			include_once('logicaParametros.php');

			$logicaParametro = new logicaParametros;
			$dataNivel = new dtNivelRiesgo;

			/*
			* Si se envía 1 se traen los parámetros y niveles por el sevri activo 
			* si se envía 2 se traen los parámentros y niveles por el id del sevri
			*/
			$nivelRiesgo = 	$dataNivel->getNivelesReporte(2, $idSevri);	
			$valorFormula = $logicaParametro->obtenerValorFormulaReporte(2, $idSevri);

			$data = new dtRiesgo;
			$lista = $data->getRiesgosReporteSevri($idSevri);	

			$dataAnalisis = new dtAnalisis;
			$listaAnalisis = $dataAnalisis->getAnalisisReporteSevri($idSevri);

			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>

				<body>
					
					<table width="100%" border="2" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="9" bgcolor="#1565c0"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
						<br />
						<td colspan="9" bgcolor="#1565c0"><CENTER><strong>Reporte General de la Valoración de Riesgos Institucional</strong></CENTER></td>
						<br />
					</table><br />

					<table width="100%" border="2" cellspacing="0" cellpadding="0">
						<tr>
							<td></td>
							<td colspan="7" bgcolor="#1976d2 "><CENTER><strong>Lista de Riesgos</strong></CENTER></td>
						</tr>
					</table><br />

					<?php 

						$this->imprimirReporteRiesgo($lista);

					 ?>

					 <br /><br />

					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="7" bgcolor="#1976d2 "><CENTER><strong>Lista de Análisis</strong></CENTER></td>
						</tr>
					</table><br />

						<?php 

							$this->imprimirReporteAnalisis($nivelRiesgo, $valorFormula, $listaAnalisis);

						 ?>

					 <br /><br />
					
					<table>
						<tr>
							<td colspan="8" bgcolor="#1976d2 "><CENTER><strong>Lista de Administraciones</strong></CENTER></td>
						</tr>
					</table><br />
					<?php 
						
						$this->imprimirReporteAdministracion($nivelRiesgo, $valorFormula, $listaAnalisis);

					?>

					 <br /><br />

					<table>

						<tr>
							<td colspan="8" bgcolor="#1976d2 "><CENTER><strong>Lista de Seguimiento</strong></CENTER></td>
						</tr>
					</table><br />

					<?php 
						
						$this->imprimirReporteSeguimiento($nivelRiesgo, $valorFormula, $listaAnalisis);

					?>
			
				</body>
			</html>
			<?php 
		}

		public function imprimirReporteRiesgo($listaRiesgo){ ?>
			<table width="100%" border="2" cellspacing="0" cellpadding="0">

				<tr>
					<td></td>
					<td colspan="7" bgcolor="#1976d2 "><CENTER><strong>Reporte de Riesgos</strong></CENTER></td>
				</tr>

				<tr>
					<td></td>
					<td bgcolor="#9e9e9e ">Departamento</td>
					<td bgcolor="#9e9e9e ">Nombre</td>
					<td bgcolor="#9e9e9e ">Descripción</td>
					<td bgcolor="#9e9e9e ">Monto Ecómico</td>
					<td bgcolor="#9e9e9e ">Categoría</td>
					<td bgcolor="#9e9e9e ">Causa</td>
					<td bgcolor="#9e9e9e ">Fecha Registro</td>
				</tr>
			  
			<?php 
				foreach ($listaRiesgo as $riesgo) {	
			?>
				<tr>
					<td></td>
					<td><?php echo $riesgo->getIdDepartamento(); ?></td>
					<td><?php echo $riesgo->getNombre(); ?></td>
					<td><?php echo $riesgo->getDescripcion(); ?></td>
					<td><?php echo "₡".number_format($riesgo->getMontoEconomico(), 2, ',', ' '); ?></td>
					<td><?php echo $riesgo->getIdCategoria(); ?></td>
					<td><?php echo $riesgo->getCausa(); ?></td> 
					<td><?php echo $riesgo->getFecha(); ?></td>                    
				</tr> 
			<?php
				}
			 ?>
			</table>
			<?php
		}

		public function imprimirReporteAnalisis($listaNiveles, $valorFormula, $listaAnalisis){ ?>
			<table width="100%" border="2" cellspacing="0" cellpadding="0">

				<tr>
					<td></td>
					<td colspan="7" bgcolor="#1976d2 "><CENTER><strong>Reporte de Riesgos Analizados</strong></CENTER></td>
				</tr>

				<tr>
					<td></td>
					<td bgcolor="#9e9e9e ">Departamento</td>
					<td bgcolor="#9e9e9e ">Riesgo</td>
					<td bgcolor="#9e9e9e ">Probabilidad</td>
					<td bgcolor="#9e9e9e ">Impacto</td>
					<td bgcolor="#9e9e9e ">Nivel del Riesgo</td>
					<td bgcolor="#9e9e9e ">Medida Control</td>
					<td bgcolor="#9e9e9e ">Calificación Medida</td>
				</tr>
			  
			<?php 
				foreach ($listaAnalisis as $analisis) {	
					$nivel = $this->asignarNivelRiesgo($analisis->getImpacto()->getValorParametro(), 
						$analisis->getProbabilidad()->getValorParametro(), $valorFormula, $listaNiveles);

					$color = $this->asignarColorNivelRiesgo($analisis->getImpacto()->getValorParametro(), 
						$analisis->getProbabilidad()->getValorParametro(), $valorFormula, $listaNiveles);
			?>
				<tr>
					<td></td>
					<td><?php echo $analisis->getDepartamento(); ?></td>
					<td><?php echo $analisis->getIdRiesgo(); ?></td>
					<td bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
					<td bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
					<td bgcolor=<?php echo "\"".$color."\""; ?>><?php echo $nivel; ?></td>
					<td><?php echo $analisis->getMedidaControl(); ?></td> 
					<td bgcolor=<?php echo "\"".$analisis->getCalificacionMedida()->getColorParametro()."\""; ?> ><?php echo $analisis->getCalificacionMedida()->getValorParametro(). ": ".$analisis->getCalificacionMedida()->getDescriptorParametro(); ?></td>                    
				</tr> 
			<?php
				}
			 ?>
			</table>
			<?php
		}

		public function imprimirReporteAdministracion($listaNiveles, $valorFormula, $listaAnalisis){
			include_once('../data/dtAdministracion.php');

			$dataAdmin = new dtAdministracion;	
			$contador = 0;
			foreach ($listaAnalisis as $analisis) {
				$contador ++;
				$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());

				$nivel = $this->asignarNivelRiesgo($analisis->getImpacto()->getValorParametro(), 
					$analisis->getProbabilidad()->getValorParametro(), $valorFormula, $listaNiveles);

				$color = $this->asignarColorNivelRiesgo($analisis->getImpacto()->getValorParametro(), 
					$analisis->getProbabilidad()->getValorParametro(), $valorFormula, $listaNiveles);
			?>
				<table width="100%" border="2" cellspacing="0" cellpadding="0">

					<tr>
						<td></td>
						<td colspan="6" bgcolor="#1976d2 "><CENTER><strong>Reporte Administración de Riesgo <?php echo " ".$contador; ?> </strong></CENTER></td>
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Departamento</td>
						<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Riesgo</td>
						<td colspan="5"><?php echo $analisis->getIdRiesgo(); ?></td>
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Probabilidad</td>
						<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Impacto</td>
						<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Nivel de Riesgo</td>
						<td colspan="5" bgcolor=<?php echo "\"".$color."\""; ?>><?php echo $nivel; ?></td>  
					</tr> 

					<tr>
						<td></td>
						<td bgcolor="#9e9e9e ">Medida</td>
						<td bgcolor="#9e9e9e ">Actividad de tratamiento</td>
						<td bgcolor="#9e9e9e ">Indicador</td>
						<td bgcolor="#9e9e9e ">Plazo</td>
						<td bgcolor="#9e9e9e ">Monto Económico</td>
						<td bgcolor="#9e9e9e ">Responsable</td>
					</tr>

					<?php 
					foreach ($listaAdministracion as $administracion) {
					 ?>
						<tr>
							<td></td>
							<td><?php echo $administracion->getMedidaAdministracion()->getNombreMedida(); ?></td>
							<td><?php echo $administracion->getActividadTratamiento(); ?></td>
							<td><?php echo $administracion->getIndicador() ?></td>
							<td><?php echo $administracion->getPlazoTratamiento(); ?></td>
							<td><?php echo "₡".number_format($administracion->getCostoActividad(), 2, ',', ' '); ?></td> 
							<td><?php echo $administracion->getUsuario()->getNombre(); ?></td>                    
						</tr> 
					 <?php
					 }
					?>
				
				</table>
				<br /><br />
		<?php
			}
		}

		public function imprimirReporteSeguimiento($listaNiveles, $valorFormula, $listaAnalisis){
			include_once('../data/dtAdministracion.php');
			include_once('../data/dtSeguimiento.php');

			$dataAdmin = new dtAdministracion;
			$dataSeguimiento = new dtSeguimiento;	
			foreach ($listaAnalisis as $analisis) {
				$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());

				$nivel = $this->asignarNivelRiesgo($analisis->getImpacto()->getValorParametro(), 
					$analisis->getProbabilidad()->getValorParametro(), $valorFormula, $listaNiveles);

				$color = $this->asignarColorNivelRiesgo($analisis->getImpacto()->getValorParametro(), 
					$analisis->getProbabilidad()->getValorParametro(), $valorFormula, $listaNiveles);
			?>
				<table width="100%" border="2" cellspacing="0" cellpadding="0">

					<tr>
						<td></td>
						<td colspan="6" bgcolor="#1976d2 "><CENTER><strong>Seguimiento del Riesgo: <?php echo " ".$analisis->getIdRiesgo(); ?> </strong></CENTER></td>
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Departamento</td>
						<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Probabilidad</td>
						<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Impacto</td>
						<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
					</tr>

					<tr>
						<td></td>
						<td bgcolor="#1976d2 ">Nivel de Riesgo</td>
						<td colspan="5" bgcolor=<?php echo "\"".$color."\""; ?>><?php echo $nivel; ?></td>  
					</tr>

					<?php 
					$contador = 0;
					foreach ($listaAdministracion as $administracion) {
						$contador ++;
					 ?>

						<tr>
							<td></td>
							<td colspan="6" bgcolor="#1976d2 "><CENTER><strong>Medida de Administración: <?php echo " ".$contador; ?></strong></CENTER></td>
						</tr> 

						<tr>
							<td></td>
							<td bgcolor="#9e9e9e ">Medida</td>
							<td bgcolor="#9e9e9e ">Actividad de tratamiento</td>
							<td bgcolor="#9e9e9e ">Indicador</td>
							<td bgcolor="#9e9e9e ">Plazo</td>
							<td bgcolor="#9e9e9e ">Monto Económico</td>
							<td bgcolor="#9e9e9e ">Responsable</td>
						</tr>

						<tr>
							<td></td>
							<td><?php echo $administracion->getMedidaAdministracion()->getNombreMedida(); ?></td>
							<td><?php echo $administracion->getActividadTratamiento(); ?></td>
							<td><?php echo $administracion->getIndicador() ?></td>
							<td><?php echo $administracion->getPlazoTratamiento(); ?></td>
							<td><?php echo "₡".number_format($administracion->getCostoActividad(), 2, ',', ' '); ?></td> 
							<td><?php echo $administracion->getUsuario()->getNombre(); ?></td>                    
						</tr>

						<tr>
							<td></td>
							<td colspan="6" bgcolor="#1976d2 "><CENTER><strong>Seguimientos Realizados a la Medida de Administración</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
					 		<td colspan="3" bgcolor="#9e9e9e "> <CENTER> Comentario de Avance </CENTER> </td>
					 		<td bgcolor="#9e9e9e ">Porcentaje de Avance</td>
					 		<td bgcolor="#9e9e9e ">Monto del Avance</td>
					 		<td bgcolor="#9e9e9e ">Fecha del Avance</td>
					 	</tr>
						
						<?php 
						$listaSeguimiento = $dataSeguimiento->obtenerSeguimientoReporte($administracion->getId());
						foreach ($listaSeguimiento as $seguimiento) {
						 ?>

						 	<tr>
						 		<td></td>
						 		<td colspan="3"> <CENTER> <?php echo $seguimiento->getComentarioAvance(); ?> </CENTER> </td>
						 		<td><?php echo $seguimiento->getPorcentajeAvance()."%"; ?></td>
						 		<td><?php echo $seguimiento->getMontoSeguimiento(); ?></td>
						 		<td><?php echo $seguimiento->getFechaAvance(); ?></td>
						 	</tr>

					 <?php
						}
					 }
					?>
				
				</table>
				<br/> <br/>
				<?php
			}
		}
			
	}

 ?>