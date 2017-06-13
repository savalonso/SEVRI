<?php 
	
	class dtParametro {
		
		function dtParametro(){}

		function getParametros(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dParametro.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerParametros()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$parametro = new dParametro;
				$parametro->setValorParametro($row[2]);
				$parametro->setDescriptorParametro($row[3]);	
				$parametro->setDescripcionParametro($row[4]);
				$parametro->setColorParametro($row[5]);
				$aux = $row[1];
				if($aux == 1){
					$parametro->setNombreParametro("Probabilidad");
				}						
				else if($aux == 2){
					$parametro->setNombreParametro("Impacto");
				}
				else{
					$parametro->setNombreParametro("Calificacion");
				}
				$parametro->setIdParametro($row[0]);

				array_push($lista, $parametro);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getParametrosSevriActivo(){
			include_once ('dtConnection.php');
			
			$con = new dtConnection();
			$conexion = $con->conect();
			include_once("../../dominio/dParametro.php");
			$query = "CALL obtenerParametrosSevriActivo()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$parametro = new dParametro;
				$parametro->setValorParametro($row[2]);
				$parametro->setDescriptorParametro($row[3]);	
				$parametro->setDescripcionParametro($row[4]);
				$parametro->setColorParametro($row[5]);
				$aux = $row[1];
				if($aux == 1){
					$parametro->setNombreParametro("Probabilidad");
				}						
				else if($aux == 2){
					$parametro->setNombreParametro("Impacto");
				}
				else{
					$parametro->setNombreParametro("Calificacion");
				}
				$parametro->setIdParametro($row[0]);

				array_push($lista, $parametro);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getParametrosReporte($desicion, $idSevri){
			include_once ('dtConnection.php');
			
			$con = new dtConnection();
			$conexion = $con->conect();
			include_once("../dominio/dParametro.php");
			

			if ($desicion == 1) {
				$query = "CALL obtenerParametrosSevriActivo()";
			}else{
				$query = "CALL obtenerParametrosPorIdSevri('$idSevri')";
			}

			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$parametro = new dParametro;
				$parametro->setValorParametro($row[2]);
				$parametro->setDescriptorParametro($row[3]);	
				$parametro->setDescripcionParametro($row[4]);
				$parametro->setColorParametro($row[5]);
				$aux = $row[1];
				if($aux == 1){
					$parametro->setNombreParametro("Probabilidad");
				}						
				else if($aux == 2){
					$parametro->setNombreParametro("Impacto");
				}
				else{
					$parametro->setNombreParametro("Calificacion");
				}
				$parametro->setIdParametro($row[0]);

				array_push($lista, $parametro);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function getParametrosHistorial($idSevri){
			include_once ('dtConnection.php');
			
			$con = new dtConnection();
			$conexion = $con->conect();
			include_once("../../dominio/dParametro.php");

			$query = "CALL obtenerParametrosPorIdSevri('$idSevri')";

			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$parametro = new dParametro;
				$parametro->setValorParametro($row[2]);
				$parametro->setDescriptorParametro($row[3]);	
				$parametro->setDescripcionParametro($row[4]);
				$parametro->setColorParametro($row[5]);
				$aux = $row[1];
				if($aux == 1){
					$parametro->setNombreParametro("Probabilidad");
				}						
				else if($aux == 2){
					$parametro->setNombreParametro("Impacto");
				}
				else{
					$parametro->setNombreParametro("Calificacion");
				}
				$parametro->setIdParametro($row[0]);

				array_push($lista, $parametro);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getParametrosSevriNuevo($desicion){
			include_once ('dtConnection.php');
			$con = new dtConnection();
			$conexion = $con->conect();
			if($desicion == 1){
				include_once("../dominio/dParametro.php");
			}else{
				include_once("../../dominio/dParametro.php");
			}
			$query = "CALL obtenerParametrosSevriNuevo()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$parametro = new dParametro;
				$parametro->setValorParametro($row[2]);
				$parametro->setDescriptorParametro($row[3]);	
				$parametro->setDescripcionParametro($row[4]);
				$aux = $row[1];
				if($aux == 1){
					$parametro->setNombreParametro("Probabilidad");
				}						
				else if($aux == 2){
					$parametro->setNombreParametro("Impacto");
				}
				else{
					$parametro->setNombreParametro("Calificacion");
				}
				$parametro->setIdParametro($row[0]);

				array_push($lista, $parametro);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getParametro($IdParametro){
			include_once ('dtConnection.php');
			include_once("../../dominio/dParametro.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerParametroPorId('$IdParametro')";
			$parametro = new dParametro();
			$result = mysqli_query($conexion, $query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			$parametro->setIdParametro($row['Id']);
			$parametro->setValorParametro($row['Valor']);
			if($parametro->getValorParametro() == 1){
					$parametro->setNombreParametro("Probabilidad");
				}						
				else if($parametro->getValorParametro() == 2){
					$parametro->setNombreParametro("Impacto");
				}
				else{
					$parametro->setNombreParametro("Calificacion");
				}
			$parametro->setDescriptorParametro($row['Descriptor']);
			$parametro->setDescripcionParametro($row['Descripcion']);

			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $parametro;
			}
		}

		function insertarSevriParametro($idParametro){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL insertarSevriParametros('$idParametro')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}
			
		}

		function eliminarSevriParametro($idParametro){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL eliminarSevriParametros('$idParametro')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}
			
		}

		function insertarParametros($parametro){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

			$nombre = $parametro->getNombreParametro();
			$descriptor = $parametro->getDescriptorParametro();
    		$descripcion= $parametro->getDescripcionParametro();
    		$valor = $parametro->getValorParametro();
    		$color = $parametro->getColorParametro();

    		$result = $conexion->query("CALL insertarParametro('$nombre','$descriptor','$descripcion','$valor','$color')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}

		}

		function modificarParametro($parametro){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

			$nombre = $parametro->getNombreParametro();
			$descriptor = $parametro->getDescriptorParametro();
    		$descripcion= $parametro->getDescripcionParametro();
    		$valor = $parametro->getValorParametro();
    		$color = $parametro->getColorParametro();
    		$id = $parametro->getIdParametro();
    		$result = $conexion->query("CALL actualizarParametro('$nombre','$descriptor','$descripcion','$valor','$color','$id')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}

		}

		function eliminarParametro($idParametro){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

    		$result = $conexion->query("CALL eliminarParametro('$idParametro')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}

		}

		function getSevriParametros(){
			include_once ('dtConnection.php');
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerSevriParametros()";
			$result = mysqli_query($conexion, $query);
			$lista = array();
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				
				$valores = array("idSevri"=>$row["IdSEVRI"],
					             "idParametro"=>$row["IdParametro"]);	
				
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