<?php 
	include_once ('dtConnection.php');
	class dtAnalisis {
		
		function dtAnalisis(){}

		function insertarAnalisis($analisis){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$prueba = $con->conect();

			$idRiesgo = $analisis->getIdRiesgo();
			$probabilidad = $analisis->getProbabilidad();
			$impacto = $analisis->getImpacto();
			$medidaControl = $analisis->getMedidaControl();
			$calificacionMedida = $analisis->getCalificacionMedida();

			$primeraPalabra = "";
			$restoTexto="";
			$primeraLetra = "";
			$restoPalabra="";
			$contador=0;
			$contador2=0;
			$resultado = "";
			for($i=0;$i<strlen($medidaControl);$i++){ 
				if($medidaControl[$i] != " " && $contador==0){
					$primeraPalabra.=$medidaControl[$i];
				}else{
					$contador =1;
					$restoTexto.=$medidaControl[$i];
				}
			} 
			$primeraPalabra=strtolower($primeraPalabra);

			for($i=0;$i<strlen($primeraPalabra);$i++){ 
				if($contador2 == 0){
					$primeraLetra= $primeraPalabra[$i];
					$contador2 =1;
				}else{
					$restoPalabra.=$primeraPalabra[$i];
				}
			} 
			$primeraLetra= strtoupper($primeraLetra);
			$primeraPalabra = $primeraLetra.$restoPalabra;
			$resultado = $primeraPalabra.$restoTexto;

			$result = $prueba->query("CALL insertarAnalisis($idRiesgo, $probabilidad, $impacto, 0, '$resultado', $calificacionMedida)");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

		function getListaAnalisis(){
			include_once("../../dominio/dAnalisis.php");
			include_once("../../dominio/dParametro.php");
			$con = new dtConnection;
			$conexion = $con->conect();

			$query = "CALL obtenerListaAnalisis()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$analisis = new dAnalisis();
				$impacto = new dParametro;
				$probabilidad = new dParametro;

				$impacto->setValorParametro($row['valorImpacto']);
				$impacto->setDescriptorParametro($row['Impacto']);
				
				$probabilidad->setValorParametro($row['valorProbabilidad']);
				$probabilidad->setDescriptorParametro($row['Probabilidad']);

				$analisis->setId($row['Id']);
				$analisis->setIdRiesgo($row['Nombre']);
	    		$analisis->setProbabilidad($probabilidad);
		      	$analisis->setImpacto($impacto);
		      	$analisis->setNivelRiesgo($row['NivelRiesgo']);
		      	$analisis->setMedidaControl($row['MedidaControl']);
		      	$analisis->setCalificacionMedida($row['CalificacionMedida']);
				array_push($lista, $analisis);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function obtenerAnalisisPorRiesgo($idRiesgo){
			include_once("../../dominio/dAnalisis.php");
			$con = new dtConnection;
			$conexion = $con->conect();

			$query = "CALL obtenerAnalisisPorRiesgo($idRiesgo)";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$analisis = new dAnalisis();

				$analisis->setId($row['Id']);
	    		$analisis->setProbabilidad($row['Probabilidad']);
		      	$analisis->setImpacto($row['Impacto']);
		      	$analisis->setNivelRiesgo($row['NivelRiesgo']);
		      	$analisis->setMedidaControl($row['MedidaControl']);
		      	$analisis->setCalificacionMedida($row['CalificacionMedida']);
				array_push($lista, $analisis);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function getTodosAnalisis(){
			include_once("../../dominio/dAnalisis.php");
			$con = new dtConnection;
			$conexion = $con->conect();

			$query = "CALL obtenerTodosAnalisis()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$analisis = new dAnalisis();

				$analisis->setId($row['Id']);
				$analisis->setIdRiesgo($row['IdRiesgo']);
	    		$analisis->setProbabilidad($row['Probabilidad']);
		      	$analisis->setImpacto($row['Impacto']);
		      	$analisis->setNivelRiesgo($row['NivelRiesgo']);
		      	$analisis->setMedidaControl($row['MedidaControl']);
		      	$analisis->setCalificacionMedida($row['CalificacionMedida']);
				array_push($lista, $analisis);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getAnalisis($idAnalisis){
			include_once ("../../dominio/dAnalisis.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerAnalisis($idAnalisis)";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$analisis = new dAnalisis;
				$analisis->setId($row[0]);
				$analisis->setIdRiesgo($row[1]);
				$analisis->setProbabilidad($row[2]);	
				$analisis->setImpacto($row[3]);
				$analisis->setNivelRiesgo($row[4]);
				$analisis->setMedidaControl($row[5]);
				$analisis->setCalificacionMedida($row[6]);
				array_push($lista, $analisis);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function actualizarAnalisis($analisis, $idAnalisis){
			$con = new dtConnection;
			$prueba = $con->conect();

			$id = $idAnalisis;
  			$probabilidad = $analisis->getProbabilidad();
    		$impacto = $analisis->getImpacto();
    		$nivelRiesgo = $analisis->getNivelRiesgo();
    		$medidaControl = $analisis->getMedidaControl();
    		$calificacionMedida = $analisis->getCalificacionMedida();

			$primeraPalabra = "";
			$restoTexto="";
			$primeraLetra = "";
			$restoPalabra="";
			$contador=0;
			$contador2=0;
			$resultado = "";
			for($i=0;$i<strlen($medidaControl);$i++){ 
				if($medidaControl[$i] != " " && $contador==0){
					$primeraPalabra.=$medidaControl[$i];
				}else{
					$contador =1;
					$restoTexto.=$medidaControl[$i];
				}
			} 
			$primeraPalabra=strtolower($primeraPalabra);

			for($i=0;$i<strlen($primeraPalabra);$i++){ 
				if($contador2 == 0){
					$primeraLetra= $primeraPalabra[$i];
					$contador2 =1;
				}else{
					$restoPalabra.=$primeraPalabra[$i];
				}
			} 
			$primeraLetra= strtoupper($primeraLetra);
			$primeraPalabra = $primeraLetra.$restoPalabra;
			$resultado = $primeraPalabra.$restoTexto;

			$result = $prueba->query("CALL modificarAnalisis($id, $probabilidad, $impacto, $nivelRiesgo, '$resultado', $calificacionMedida)");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

		function eliminarAnalisis($idAnalisis){
			$con = new dtConnection;
			$prueba = $con->conect();

			$result = $prueba->query("CALL eliminarAnalisis($idAnalisis);");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}
	}	
?>