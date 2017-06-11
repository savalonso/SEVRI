<?php 
	include_once('dtConnection.php');

	class dtNivelRiesgo{
		
		public function dtNivelRiesgo(){}

		function insertarNivelRiesgo($nivelesRiesgo){
			include_once ('dtConnection.php');

			$con = new dtConnection;
			$conexion = $con->conect();
			$query = "CALL obtenerUltimoIdDivisionNivelRiesgo()";

			$result = mysqli_query($conexion, $query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$id = $row['id'] + 1; 
			$cantidadDivisiones = count($nivelesRiesgo);
			$nombreDivision = "Niveles del Riesgo_".$cantidadDivisiones."_".$id;

			$conexion = $con->crearConexionPDO();
			try {
        	 	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	 		$conexion->beginTransaction();
 	 			$conexion->exec("CALL insertarDivicionNivelRiesgo('$id','$cantidadDivisiones', '$nombreDivision')");
				foreach ($nivelesRiesgo as $nivelRiego) {
					$limite = $nivelRiego->limite;
    				$descriptor= $nivelRiego->descriptor;
    				$descripcion = $nivelRiego->descripcion;
    				$color = $nivelRiego->colorAsociado;
	                $conexion->exec("CALL insertarNivelRiesgo('$id','$limite','$descriptor','$descripcion','$color')");
				}				  

				$conexion->commit();
				return true;
            } catch (Exception $e) {
            	$conexion->rollback();
            	return false;
            }
		}

		function modificarNivelRiesgo($nivelesRiesgo){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->crearConexionPDO();
			try {
        	 	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	 		$conexion->beginTransaction();
				foreach ($nivelesRiesgo as $nivelRiego) {
    				$descriptor= $nivelRiego->descriptor;
    				$descripcion = $nivelRiego->descripcion;
    				$color = $nivelRiego->colorAsociado;
    				$id = $nivelRiego->idNivel;
	                $conexion->exec("CALL actualizarNivelRiesgo('$id','$descriptor','$descripcion','$color')");
				}				  

				$conexion->commit();
				return true;
            } catch (Exception $e) {
            	$conexion->rollback();
            	return false;
            }
		}

		function eliminarNivelRiesgo($idDivision){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->crearConexionPDO();
			try {
        	 	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	 		$conexion->beginTransaction();

	 	 		$conexion->exec("CALL eliminarNivelRiesgo('$idDivision')");			  
	 	 		$conexion->exec("CALL eliminarDivisionesNivelRiesgo('$idDivision')");

				$conexion->commit();
				return true;
            } catch (Exception $e) {
            	$conexion->rollback();
            	return false;
            }
		}

		function getNivelesRiesgo(){
			include_once("../../dominio/dNivelRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerNivelRiesgo()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$nivelRiesgo = new dNivelRiesgo;
					
				$nivelRiesgo->setIdNivel($row['Id']);
				$nivelRiesgo->setIdDivisiones($row['IdCantidadDiviciones']);	
				$nivelRiesgo->setLimite($row['Limite']);	
				$nivelRiesgo->setDescriptor($row['Descriptor']);						
				$nivelRiesgo->setDescripcion($row['Descripcion']);
				$nivelRiesgo->setColor($row['Color']);

				array_push($lista, $nivelRiesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}

		}

		function getNivelesSevriActivo(){
			include_once("../../dominio/dNivelRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerNivelesRiesgoSevriActivo()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$nivelRiesgo = new dNivelRiesgo;
						
				$nivelRiesgo->setLimite($row['Limite']);	
				$nivelRiesgo->setDescriptor($row['Descriptor']);						
				$nivelRiesgo->setDescripcion($row['Descripcion']);
				$nivelRiesgo->setColor($row['Color']);

				array_push($lista, $nivelRiesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}

		}

		function getNivelesReporte($desicion, $idSevri){
			include_once("../dominio/dNivelRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			if ($desicion == 1) {
				$query = "CALL obtenerNivelesRiesgoSevriActivo()";
			}else{
				$query = "CALL obtenerNivelesRiesgoPorIdSevri('$idSevri')";
			}

			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$nivelRiesgo = new dNivelRiesgo;
						
				$nivelRiesgo->setLimite($row['Limite']);	
				$nivelRiesgo->setDescriptor($row['Descriptor']);						
				$nivelRiesgo->setDescripcion($row['Descripcion']);
				$nivelRiesgo->setColor($row['Color']);

				array_push($lista, $nivelRiesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}

		}

		function getDivicionNiveles(){
			include_once("../../dominio/dNivelRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerDivicionNivelRiesgo()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$divicionNivel = new dNivelRiesgo;
					
				$divicionNivel->setIdDivisiones($row['Id']);
				$divicionNivel->setCantidadDivisiones($row['CantidadDiviciones']);	
				$divicionNivel->setNombreDiviciones($row['NombreDivicion']);	

				array_push($lista, $divicionNivel);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function realizarVinculacionNivel($idDivicion){
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL insertarSevriNivel('$idDivicion')");

			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return true;
			}
		}
		function realizarDesvinculacionNivel($idDivicion){
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL eliminarSevriNivel('$idDivicion')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}
		}
		function getNivelRiesgoVinculado(){
			include_once("../../dominio/dNivelRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerNivelRiesgoVinculado()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$divicionNivel = new dNivelRiesgo;
					
				$divicionNivel->setIdDivisiones($row['Id']);	
				$divicionNivel->setNombreDiviciones($row['NombreDivicion']);	

				array_push($lista, $divicionNivel);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getSevriNivel(){
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerSevriNivelRiesgo()";
			$result = mysqli_query($conexion, $query);
			//falta obtener los datos de la tabla.
			$lista = array();
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
				
				$valores = array("idSevri"=>$row["IdSevri"],"idDivicion"=>$row["IdDivicionNivel"]);	
				
				array_push($lista, $valores);
			}
			
			if (!$result){
				return false;
			} else {
				return $lista;
			}

		}

		function verificarNivelRiesgoAgregado(){
		  $con = new dtConnection();
		  $conexion = $con->conect();
		  $query = "CALL obtenerNivelRiesgoSevriNuevo()";
		  $result = mysqli_query($conexion, $query);
		  $lista = array();
		  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
				
				$valores = array("idSevri"=>$row["Id"]);	
				
				array_push($lista, $valores);
			}

			if (!$result){
				return false;
			} else {
				return $lista;
			}

		}

	}

 ?>