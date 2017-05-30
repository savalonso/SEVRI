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
							<td colspan="9" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
					</table>

					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="7" bgcolor="skyblue"><CENTER><strong>Reporte de Riesgos</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="red">Departamento</td>
							<td bgcolor="red">Nombre</td>
							<td bgcolor="red">Descripción</td>
							<td bgcolor="red">Monto Ecómico</td>
							<td bgcolor="red">Categoría</td>
							<td bgcolor="red">Causa</td>
							<td bgcolor="red">Fecha Registro</td>
						</tr>
					  
					<?php 
						foreach ($lista as $riesgo) {	
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
				</body>
			</html>
			<?php 
		}

		public function reporteAnalisisExcel(){

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Reporte_AnalisisRiesgo.xls");	
			include_once('../data/dtAnalisis.php');
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
							<td colspan="9" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
					</table>

					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="7" bgcolor="skyblue"><CENTER><strong>Reporte de Riesgos Analizados</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="red">Departamento</td>
							<td bgcolor="red">Riesgo</td>
							<td bgcolor="red">Probabilidad</td>
							<td bgcolor="red">Impacto</td>
							<td bgcolor="red">Nivel del Riesgo</td>
							<td bgcolor="red">Medida Control</td>
							<td bgcolor="red">Calificación Medida</td>
						</tr>
					  
					<?php 
						foreach ($lista as $analisis) {	
					?>
						<tr>
							<td></td>
							<td><?php echo $analisis->getDepartamento(); ?></td>
							<td><?php echo $analisis->getIdRiesgo(); ?></td>
							<td bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
							<td bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
							<td ><?php echo $analisis->getNivelRiesgo(); ?></td>
							<td><?php echo $analisis->getMedidaControl(); ?></td> 
							<td bgcolor=<?php echo "\"".$analisis->getCalificacionMedida()->getColorParametro()."\""; ?> ><?php echo $analisis->getCalificacionMedida()->getValorParametro(). ": ".$analisis->getCalificacionMedida()->getDescriptorParametro(); ?></td>                    
						</tr> 
					<?php
						}
					 ?>
					</table>
				</body>
			</html>
			<?php 
		}

		public function reporteAdministracionExcel(){

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Reporte_AdministracionRiesgo.xls");	
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtAdministracion.php');
			$data = new dtAnalisis;
			$dataAdmin = new dtAdministracion;
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
							<td colspan="8" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí </strong></CENTER></td>
						</tr>
					</table><br />

					<?php 
						$contador = 0;
						foreach ($lista as $analisis) {
							$contador ++;
							$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());
					?>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Reporte Administración de Riesgo <?php echo " ".$contador; ?> </strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Departamento</td>
							<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
						</tr>

						<tr>
							<td bgcolor="skyblue">Riesgo</td>
							<td colspan="5"><?php echo $analisis->getIdRiesgo(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Probabilidad</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Impacto</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Nivel de Riesgo</td>
							<td colspan="5" ><?php echo $analisis->getNivelRiesgo(); ?></td>  
						</tr> 

						<tr>
							<td></td>
							<td bgcolor="red">Medida</td>
							<td bgcolor="red">Actividad de tratamiento</td>
							<td bgcolor="red">Indicador</td>
							<td bgcolor="red">Plazo</td>
							<td bgcolor="red">Monto Económico</td>
							<td bgcolor="red">Responsable</td>
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
					 ?>
				</body>
			</html>
			<?php 
		}

		public function reporteSeguimientoExcel(){

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Reporte_Seguimiento_Riesgo.xls");	
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtAdministracion.php');
			include_once('../data/dtSeguimiento.php');
			$data = new dtAnalisis;
			$dataAdmin = new dtAdministracion;
			$dataSeguimiento = new dtSeguimiento;
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
							<td colspan="8" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí </strong></CENTER></td>
						</tr>
						<br />
						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Reporte Seguimiento de Riesgos </strong></CENTER></td>
						</tr>
					</table>

					<?php 
						foreach ($lista as $analisis) {
							$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());
					?>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Seguimiento del Riesgo: <?php echo " ".$analisis->getIdRiesgo(); ?> </strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Departamento</td>
							<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Probabilidad</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Impacto</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Nivel de Riesgo</td>
							<td colspan="5" ><?php echo $analisis->getNivelRiesgo(); ?></td>  
						</tr>

						<?php 
						$contador = 0;
						foreach ($listaAdministracion as $administracion) {
							$contador ++;
						 ?>

							<tr>
								<td></td>
								<td colspan="6" bgcolor="skyblue"><CENTER><strong>Medida de Administración: <?php echo " ".$contador; ?></strong></CENTER></td>
							</tr> 

							<tr>
								<td></td>
								<td bgcolor="red">Medida</td>
								<td bgcolor="red">Actividad de tratamiento</td>
								<td bgcolor="red">Indicador</td>
								<td bgcolor="red">Plazo</td>
								<td bgcolor="red">Monto Económico</td>
								<td bgcolor="red">Responsable</td>
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
								<td colspan="6" bgcolor="skyblue"><CENTER><strong>Seguimientos Realizados a la Medida de Administración</strong></CENTER></td>
							</tr>

							<tr>
								<td></td>
						 		<td colspan="3" bgcolor="red"> <CENTER> Comentario de Avance </CENTER> </td>
						 		<td bgcolor="red">Porcentaje de Avance</td>
						 		<td bgcolor="red">Monto del Avance</td>
						 		<td bgcolor="red">Fecha del Avance</td>
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
					<br /> <br />
					<?php
						}
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
			include_once('../data/dtAdministracion.php');
			include_once('../data/dtSeguimiento.php');

			$data = new dtRiesgo;
			$lista = $data->getRiesgosReporteSevri($idSevri);	

			$dataAnalisis = new dtAnalisis;
			$listaAnalisis = $dataAnalisis->getAnalisisReporteSevri($idSevri);

			$dataAdmin = new dtAdministracion;
			$dataSeguimiento = new dtSeguimiento;

			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>

				<body>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td colspan="9" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr><br />

						<tr>
							<td></td>
							<td colspan="7" bgcolor="skyblue"><CENTER><strong>Riesgos</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="red">Departamento</td>
							<td bgcolor="red">Nombre</td>
							<td bgcolor="red">Descripción</td>
							<td bgcolor="red">Monto Ecómico</td>
							<td bgcolor="red">Categoría</td>
							<td bgcolor="red">Causa</td>
							<td bgcolor="red">Fecha Registro</td>
						</tr>
					  
					<?php 
						foreach ($lista as $riesgo) {	
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
					</table> <br /><br />

					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="7" bgcolor="skyblue"><CENTER><strong>Análisis de Riesgos</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="red">Departamento</td>
							<td bgcolor="red">Riesgo</td>
							<td bgcolor="red">Probabilidad</td>
							<td bgcolor="red">Impacto</td>
							<td bgcolor="red">Nivel del Riesgo</td>
							<td bgcolor="red">Medida Control</td>
							<td bgcolor="red">Calificación Medida</td>
						</tr>
					  
					<?php 
						foreach ($listaAnalisis as $analisis) {	
					?>
						<tr>
							<td></td>
							<td><?php echo $analisis->getDepartamento(); ?></td>
							<td><?php echo $analisis->getIdRiesgo(); ?></td>
							<td bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
							<td bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
							<td ><?php echo $analisis->getNivelRiesgo(); ?></td>
							<td><?php echo $analisis->getMedidaControl(); ?></td> 
							<td bgcolor=<?php echo "\"".$analisis->getCalificacionMedida()->getColorParametro()."\""; ?> ><?php echo $analisis->getCalificacionMedida()->getValorParametro(). ": ".$analisis->getCalificacionMedida()->getDescriptorParametro(); ?></td>                    
						</tr> 
					<?php
						}
					 ?>
					</table> <br /><br />
					
					<table>
						<tr>
							<td colspan="8" bgcolor="skyblue"><CENTER><strong>Administración de Riesgos </strong></CENTER></td>
						</tr>
					</table><br />
					<?php 
						$contador = 0;
						foreach ($listaAnalisis as $analisis) {
							$contador ++;
							$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());
					?>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Administración de Riesgo <?php echo " ".$contador; ?> </strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Departamento</td>
							<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Riesgo</td>
							<td colspan="5"><?php echo $analisis->getIdRiesgo(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Probabilidad</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Impacto</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Nivel de Riesgo</td>
							<td colspan="5" ><?php echo $analisis->getNivelRiesgo(); ?></td>  
						</tr> 

						<tr>
							<td></td>
							<td bgcolor="red">Medida</td>
							<td bgcolor="red">Actividad de tratamiento</td>
							<td bgcolor="red">Indicador</td>
							<td bgcolor="red">Plazo</td>
							<td bgcolor="red">Monto Económico</td>
							<td bgcolor="red">Responsable</td>
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
					 ?>

					 <br /><br />

					<table>

						<tr>
							<td colspan="8" bgcolor="skyblue"><CENTER><strong>Seguimiento de Riesgos </strong></CENTER></td>
						</tr>
					</table><br />

					<?php 
						foreach ($listaAnalisis as $analisis) {
							$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());
					?>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Seguimiento del Riesgo: <?php echo " ".$analisis->getIdRiesgo(); ?> </strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Departamento</td>
							<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Probabilidad</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Impacto</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Nivel de Riesgo</td>
							<td colspan="5" ><?php echo $analisis->getNivelRiesgo(); ?></td>  
						</tr>

						<?php 
						$contador = 0;
						foreach ($listaAdministracion as $administracion) {
							$contador ++;
						 ?>

							<tr>
								<td></td>
								<td colspan="6" bgcolor="skyblue"><CENTER><strong>Medida de Administración: <?php echo " ".$contador; ?></strong></CENTER></td>
							</tr> 

							<tr>
								<td></td>
								<td bgcolor="red">Medida</td>
								<td bgcolor="red">Actividad de tratamiento</td>
								<td bgcolor="red">Indicador</td>
								<td bgcolor="red">Plazo</td>
								<td bgcolor="red">Monto Económico</td>
								<td bgcolor="red">Responsable</td>
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
								<td colspan="6" bgcolor="skyblue"><CENTER><strong>Seguimientos Realizados a la Medida de Administración</strong></CENTER></td>
							</tr>

							<tr>
								<td></td>
						 		<td colspan="3" bgcolor="red"> <CENTER> Comentario de Avance </CENTER> </td>
						 		<td bgcolor="red">Porcentaje de Avance</td>
						 		<td bgcolor="red">Monto del Avance</td>
						 		<td bgcolor="red">Fecha del Avance</td>
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
					<br /> <br />
					<?php
						}
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
							<td colspan="9" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
					</table>

					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="7" bgcolor="skyblue"><CENTER><strong>Reporte de Riesgos</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="red">Departamento</td>
							<td bgcolor="red">Nombre</td>
							<td bgcolor="red">Descripción</td>
							<td bgcolor="red">Monto Ecómico</td>
							<td bgcolor="red">Categoría</td>
							<td bgcolor="red">Causa</td>
							<td bgcolor="red">Fecha Registro</td>
						</tr>
					  
					<?php 
						foreach ($lista as $riesgo) {	
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
				</body>
			</html>
			<?php 
		}

		public function reporteAnalisisWord(){

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=Reporte_AnalisisRiesgo.doc");

			include_once('../data/dtAnalisis.php');
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
							<td colspan="9" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr>
					</table>

					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="7" bgcolor="skyblue"><CENTER><strong>Reporte de Riesgos Analizados</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="red">Departamento</td>
							<td bgcolor="red">Riesgo</td>
							<td bgcolor="red">Probabilidad</td>
							<td bgcolor="red">Impacto</td>
							<td bgcolor="red">Nivel del Riesgo</td>
							<td bgcolor="red">Medida Control</td>
							<td bgcolor="red">Calificación Medida</td>
						</tr>
					  
					<?php 
						foreach ($lista as $analisis) {	
					?>
						<tr>
							<td></td>
							<td><?php echo $analisis->getDepartamento(); ?></td>
							<td><?php echo $analisis->getIdRiesgo(); ?></td>
							<td bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
							<td bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
							<td ><?php echo $analisis->getNivelRiesgo(); ?></td>
							<td><?php echo $analisis->getMedidaControl(); ?></td> 
							<td bgcolor=<?php echo "\"".$analisis->getCalificacionMedida()->getColorParametro()."\""; ?> ><?php echo $analisis->getCalificacionMedida()->getValorParametro(). ": ".$analisis->getCalificacionMedida()->getDescriptorParametro(); ?></td>                    
						</tr> 
					<?php
						}
					 ?>
					</table>
				</body>
			</html>
			<?php 
		}

		public function reporteAdministracionWord(){

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=Reporte_AdministracionRiesgo.doc");

			include_once('../data/dtAnalisis.php');
			include_once('../data/dtAdministracion.php');
			$data = new dtAnalisis;
			$dataAdmin = new dtAdministracion;
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
							<td colspan="8" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí </strong></CENTER></td>
						</tr>
					</table><br />

					<?php 
						$contador = 0;
						foreach ($lista as $analisis) {
							$contador ++;
							$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());
					?>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Reporte Administración de Riesgo <?php echo " ".$contador; ?> </strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Departamento</td>
							<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
						</tr>

						<tr>
							<td bgcolor="skyblue">Riesgo</td>
							<td colspan="5"><?php echo $analisis->getIdRiesgo(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Probabilidad</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Impacto</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Nivel de Riesgo</td>
							<td colspan="5" ><?php echo $analisis->getNivelRiesgo(); ?></td>  
						</tr> 

						<tr>
							<td></td>
							<td bgcolor="red">Medida</td>
							<td bgcolor="red">Actividad de tratamiento</td>
							<td bgcolor="red">Indicador</td>
							<td bgcolor="red">Plazo</td>
							<td bgcolor="red">Monto Económico</td>
							<td bgcolor="red">Responsable</td>
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
					 ?>
				</body>
			</html>
			<?php 
		}

		public function reporteSeguimientoWord(){

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=Reporte_Seguimiento_Riesgo.doc");
	
			include_once('../data/dtAnalisis.php');
			include_once('../data/dtAdministracion.php');
			include_once('../data/dtSeguimiento.php');
			$data = new dtAnalisis;
			$dataAdmin = new dtAdministracion;
			$dataSeguimiento = new dtSeguimiento;
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
							<td colspan="8" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí </strong></CENTER></td>
						</tr>
						<br />
						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Reporte Seguimiento de Riesgos </strong></CENTER></td>
						</tr>
					</table>

					<?php 
						foreach ($lista as $analisis) {
							$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());
					?>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Seguimiento del Riesgo: <?php echo " ".$analisis->getIdRiesgo(); ?> </strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Departamento</td>
							<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Probabilidad</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Impacto</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Nivel de Riesgo</td>
							<td colspan="5" ><?php echo $analisis->getNivelRiesgo(); ?></td>  
						</tr>

						<?php 
						$contador = 0;
						foreach ($listaAdministracion as $administracion) {
							$contador ++;
						 ?>

							<tr>
								<td></td>
								<td colspan="6" bgcolor="skyblue"><CENTER><strong>Medida de Administración: <?php echo " ".$contador; ?></strong></CENTER></td>
							</tr> 

							<tr>
								<td></td>
								<td bgcolor="red">Medida</td>
								<td bgcolor="red">Actividad de tratamiento</td>
								<td bgcolor="red">Indicador</td>
								<td bgcolor="red">Plazo</td>
								<td bgcolor="red">Monto Económico</td>
								<td bgcolor="red">Responsable</td>
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
								<td colspan="6" bgcolor="skyblue"><CENTER><strong>Seguimientos Realizados a la Medida de Administración</strong></CENTER></td>
							</tr>

							<tr>
								<td></td>
						 		<td colspan="3" bgcolor="red"> <CENTER> Comentario de Avance </CENTER> </td>
						 		<td bgcolor="red">Porcentaje de Avance</td>
						 		<td bgcolor="red">Monto del Avance</td>
						 		<td bgcolor="red">Fecha del Avance</td>
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
					<br /> <br />
					<?php
						}
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
			include_once('../data/dtAdministracion.php');
			include_once('../data/dtSeguimiento.php');

			$data = new dtRiesgo;
			$lista = $data->getRiesgosReporteSevri($idSevri);	

			$dataAnalisis = new dtAnalisis;
			$listaAnalisis = $dataAnalisis->getAnalisisReporteSevri($idSevri);

			$dataAdmin = new dtAdministracion;
			$dataSeguimiento = new dtSeguimiento;

			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				</head>

				<body>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td colspan="9" bgcolor="skyblue"><CENTER><strong>Municipalidad de Sarapiquí</strong></CENTER></td>
						</tr><br />

						<tr>
							<td></td>
							<td colspan="7" bgcolor="skyblue"><CENTER><strong>Riesgos</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="red">Departamento</td>
							<td bgcolor="red">Nombre</td>
							<td bgcolor="red">Descripción</td>
							<td bgcolor="red">Monto Ecómico</td>
							<td bgcolor="red">Categoría</td>
							<td bgcolor="red">Causa</td>
							<td bgcolor="red">Fecha Registro</td>
						</tr>
					  
					<?php 
						foreach ($lista as $riesgo) {	
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
					</table> <br /><br />

					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="7" bgcolor="skyblue"><CENTER><strong>Análisis de Riesgos</strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="red">Departamento</td>
							<td bgcolor="red">Riesgo</td>
							<td bgcolor="red">Probabilidad</td>
							<td bgcolor="red">Impacto</td>
							<td bgcolor="red">Nivel del Riesgo</td>
							<td bgcolor="red">Medida Control</td>
							<td bgcolor="red">Calificación Medida</td>
						</tr>
					  
					<?php 
						foreach ($listaAnalisis as $analisis) {	
					?>
						<tr>
							<td></td>
							<td><?php echo $analisis->getDepartamento(); ?></td>
							<td><?php echo $analisis->getIdRiesgo(); ?></td>
							<td bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
							<td bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
							<td ><?php echo $analisis->getNivelRiesgo(); ?></td>
							<td><?php echo $analisis->getMedidaControl(); ?></td> 
							<td bgcolor=<?php echo "\"".$analisis->getCalificacionMedida()->getColorParametro()."\""; ?> ><?php echo $analisis->getCalificacionMedida()->getValorParametro(). ": ".$analisis->getCalificacionMedida()->getDescriptorParametro(); ?></td>                    
						</tr> 
					<?php
						}
					 ?>
					</table> <br /><br />
					
					<table>
						<tr>
							<td colspan="8" bgcolor="skyblue"><CENTER><strong>Administración de Riesgos </strong></CENTER></td>
						</tr>
					</table><br />
					<?php 
						$contador = 0;
						foreach ($listaAnalisis as $analisis) {
							$contador ++;
							$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());
					?>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Administración de Riesgo <?php echo " ".$contador; ?> </strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Departamento</td>
							<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Riesgo</td>
							<td colspan="5"><?php echo $analisis->getIdRiesgo(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Probabilidad</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Impacto</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Nivel de Riesgo</td>
							<td colspan="5" ><?php echo $analisis->getNivelRiesgo(); ?></td>  
						</tr> 

						<tr>
							<td></td>
							<td bgcolor="red">Medida</td>
							<td bgcolor="red">Actividad de tratamiento</td>
							<td bgcolor="red">Indicador</td>
							<td bgcolor="red">Plazo</td>
							<td bgcolor="red">Monto Económico</td>
							<td bgcolor="red">Responsable</td>
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
					 ?>

					 <br /><br />

					<table>

						<tr>
							<td colspan="8" bgcolor="skyblue"><CENTER><strong>Seguimiento de Riesgos </strong></CENTER></td>
						</tr>
					</table><br />

					<?php 
						foreach ($listaAnalisis as $analisis) {
							$listaAdministracion = $dataAdmin->getAdministracionesReporte($analisis->getId());
					?>
					<table width="100%" border="2" cellspacing="0" cellpadding="0">

						<tr>
							<td></td>
							<td colspan="6" bgcolor="skyblue"><CENTER><strong>Seguimiento del Riesgo: <?php echo " ".$analisis->getIdRiesgo(); ?> </strong></CENTER></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Departamento</td>
							<td colspan="5"><?php echo $analisis->getDepartamento(); ?></td>       
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Probabilidad</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getProbabilidad()->getColorParametro()."\""; ?> ><?php echo $analisis->getProbabilidad()->getValorParametro(). ": ".$analisis->getProbabilidad()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Impacto</td>
							<td colspan="5" bgcolor=<?php echo "\"".$analisis->getImpacto()->getColorParametro()."\""; ?> ><?php echo $analisis->getImpacto()->getValorParametro(). ": ".$analisis->getImpacto()->getDescriptorParametro(); ?></td>
						</tr>

						<tr>
							<td></td>
							<td bgcolor="skyblue">Nivel de Riesgo</td>
							<td colspan="5" ><?php echo $analisis->getNivelRiesgo(); ?></td>  
						</tr>

						<?php 
						$contador = 0;
						foreach ($listaAdministracion as $administracion) {
							$contador ++;
						 ?>

							<tr>
								<td></td>
								<td colspan="6" bgcolor="skyblue"><CENTER><strong>Medida de Administración: <?php echo " ".$contador; ?></strong></CENTER></td>
							</tr> 

							<tr>
								<td></td>
								<td bgcolor="red">Medida</td>
								<td bgcolor="red">Actividad de tratamiento</td>
								<td bgcolor="red">Indicador</td>
								<td bgcolor="red">Plazo</td>
								<td bgcolor="red">Monto Económico</td>
								<td bgcolor="red">Responsable</td>
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
								<td colspan="6" bgcolor="skyblue"><CENTER><strong>Seguimientos Realizados a la Medida de Administración</strong></CENTER></td>
							</tr>

							<tr>
								<td></td>
						 		<td colspan="3" bgcolor="red"> <CENTER> Comentario de Avance </CENTER> </td>
						 		<td bgcolor="red">Porcentaje de Avance</td>
						 		<td bgcolor="red">Monto del Avance</td>
						 		<td bgcolor="red">Fecha del Avance</td>
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
					<br /> <br />
					<?php
						}
					 ?>
			
				</body>
			</html>
			<?php 
		}

	}

 ?>