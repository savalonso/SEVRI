<?php 

	include_once("dtConnection.php");
	
	class dtRiesgo {
		
		function dtRiesgo(){}

		function insertarRiesgo($Riesgo){
			$con = new dtConnection;
			$prueba = $con->conect();

			$idDepartamento = $Riesgo->getIdDepartamento();
			$idCategoria = $Riesgo->getIdCategoria();
			$nombre = $Riesgo->getNombre();
			$descripcion = $Riesgo->getDescripcion();
			$montoEconomico = $Riesgo->getMontoEconomico();
			$estaActivo = $Riesgo->getEstaActivo();
			$causa = $Riesgo->getCausa();

			$primeraPalabra = "";
			$restoTexto="";
			$primeraLetra = "";
			$restoPalabra="";
			$contador=0;
			$contador2=0;
			$resultado = "";
			for($i=0;$i<strlen($descripcion);$i++){ 
				if($descripcion[$i] != " " && $contador==0){
					$primeraPalabra.=$descripcion[$i];
				}else{
					$contador =1;
					$restoTexto.=$descripcion[$i];
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

			///

			$primeraPalabra1 = "";
			$restoTexto1="";
			$primeraLetra1 = "";
			$restoPalabra1="";
			$contador1=0;
			$contador22=0;
			$resultado1 = "";
			for($i=0;$i<strlen($causa);$i++){ 
				if($causa[$i] != " " && $contador1==0){
					$primeraPalabra1.=$causa[$i];
				}else{
					$contador1 =1;
					$restoTexto1.=$causa[$i];
				}
			} 
			$primeraPalabra1=strtolower($primeraPalabra1);

			for($i=0;$i<strlen($primeraPalabra1);$i++){ 
				if($contador22 == 0){
					$primeraLetra1= $primeraPalabra1[$i];
					$contador22 =1;
				}else{
					$restoPalabra1.=$primeraPalabra1[$i];
				}
			} 
			$primeraLetra1= strtoupper($primeraLetra1);
			$primeraPalabra1 = $primeraLetra1.$restoPalabra1;
			$resultado1 = $primeraPalabra1.$restoTexto1;
			///



			$result = $prueba->query("CALL insertarRiesgo($idDepartamento, $idCategoria, '$nombre', '$resultado', $montoEconomico, $estaActivo, '$resultado1')");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}


		function modificarRiesgo($Riesgo){
			$con = new dtConnection;
			$prueba = $con->conect();

			$id = $Riesgo->getId();
			$idDepartamento = $Riesgo->getIdDepartamento();
			$idCategoria = $Riesgo->getIdCategoria();
			$nombre = $Riesgo->getNombre();
			$descripcion = $Riesgo->getDescripcion();
			$montoEconomico = $Riesgo->getMontoEconomico();
			$estaActivo = $Riesgo->getEstaActivo();
			$causa = $Riesgo->getCausa();

			$result = $prueba->query("CALL modificarRiesgo($id, $idDepartamento, $idCategoria, '$nombre', '$descripcion', $montoEconomico, $estaActivo, '$causa')");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

		function getRiesgos(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerRiesgos()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$riesgo = new dRiesgo;
				$riesgo->setId($row[0]);
				$riesgo->setIdDepartamento($row[2]);
				$riesgo->setIdCategoria($row[3]);	
				$riesgo->setNombre($row[4]);
				$riesgo->setDescripcion($row[5]);
				$riesgo->setMontoEconomico($row[6]);
				if($row[7]=='1'){
					$riesgo->setEstaActivo("Activo");
				}else{
					$riesgo->setEstaActivo("Inactivo");
				}
				$riesgo->setCausa($row[8]);
				$riesgo->setFecha($row[9]);

				array_push($lista, $riesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function obtenerRiesgoDetalles($idRiesgo){
			include_once ('dtConnection.php');
			include_once("../../dominio/dRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerRiesgoDetalles('$idRiesgo')";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$riesgo = new dRiesgo;
				$riesgo->setId($row[0]);
				$riesgo->setIdSevri($row[1]);
				$riesgo->setIdDepartamento($row[2]);
				$riesgo->setIdCategoria($row[3]);	
				$riesgo->setNombre($row[4]);
				$riesgo->setDescripcion($row[5]);
				$riesgo->setMontoEconomico($row[6]);
				if($row[7]=='1'){
					$riesgo->setEstaActivo("Activo");
				}else{
					$riesgo->setEstaActivo("Inactivo");
				}
				$riesgo->setCausa($row[8]);
				$riesgo->setFecha($row[9]);
				
				array_push($lista, $riesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function getRiesgosAnalisados(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerRiesgoAnalisis()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
				$riesgo = new dRiesgo;
				$riesgo->setId($row['Id']);	
				$riesgo->setNombre($row['Nombre']);
				$riesgo->setDescripcion($row['Descripcion']);
				array_push($lista, $riesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getRiesgosSevriActivo(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerRiesgosSevriActivo()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$riesgo = new dRiesgo;
				$riesgo->setId($row[0]);
				$riesgo->setIdDepartamento($row[2]);
				$riesgo->setIdCategoria($row[3]);	
				$riesgo->setNombre($row[4]);
				$riesgo->setDescripcion($row[5]);
				$riesgo->setMontoEconomico($row[6]);
				if($row[7]=='1'){
					$riesgo->setEstaActivo("Activo");
				}else{
					$riesgo->setEstaActivo("Inactivo");
				}
				$riesgo->setCausa($row[8]);
				$riesgo->setFecha($row[9]);

				array_push($lista, $riesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getRiesgo($idRiesgo){
			include_once ('dtConnection.php');
			include_once("../../dominio/dRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerRiesgo('$idRiesgo')";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$riesgo = new dRiesgo;
				$riesgo->setId($row[0]);
				$riesgo->setIdDepartamento($row[2]);
				$riesgo->setIdCategoria($row[3]);	
				$riesgo->setNombre($row[4]);
				$riesgo->setDescripcion($row[5]);
				$riesgo->setMontoEconomico($row[6]);
				if($row[7]=='1'){
					$riesgo->setEstaActivo("Activo");
				}else{
					$riesgo->setEstaActivo("Inactivo");
				}
				$riesgo->setCausa($row[8]);
				$riesgo->setFecha($row[9]);
				
				array_push($lista, $riesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function getRiesgosAntiguos(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dRiesgo.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerRiesgosAntiguos()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$riesgo = new dRiesgo;
				$riesgo->setId($row[0]);
				$riesgo->setIdSevri($row[1]);
				$riesgo->setIdDepartamento($row[2]);
				$riesgo->setIdCategoria($row[3]);	
				$riesgo->setNombre($row[4]);
				$riesgo->setDescripcion($row[5]);
				$riesgo->setMontoEconomico($row[6]);
				if($row[7]=='1'){
					$riesgo->setEstaActivo("Activo");
				}else{
					$riesgo->setEstaActivo("Inactivo");
				}
				$riesgo->setCausa($row[8]);
				$riesgo->setFecha($row[9]);

				array_push($lista, $riesgo);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function eliminarRiesgo($idRiesgo){
			$con = new dtConnection;
			$prueba = $con->conect();

			$result = $prueba->query("CALL eliminarRiesgo($idRiesgo);");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}
	}
?>