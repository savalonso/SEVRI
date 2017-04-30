<?php 

	
	class dtDepartamento {
		
		function dtDepartamento(){}

		function getDepartamentos(){
			include_once ('dtConnection.php');
			include("../../dominio/dDepartamento.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerDepartamentos()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$departamento = new dDepartamento;
					
				$departamento->setCodigoDepartamento($row['Codigo']);
				$departamento->setNombreDepartamento($row['Nombre']);	
				$departamento->setFechaCreacion($row['FechaCreacion']);	
				$departamento->setIdDepartamento($row['Id']);						
				

				array_push($lista, $departamento);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function getDepartamentosVersionesAntiguas(){
			include_once ('dtConnection.php');
			include("../../dominio/dDepartamento.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerDepartamentosVersionesAntiguas()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$departamento = new dDepartamento;
					
				$departamento->setCodigoDepartamento($row['Codigo']);
				$departamento->setNombreDepartamento($row['Nombre']);	
				$departamento->setFechaCreacion($row['FechaCreacion']);	
				$departamento->setIdDepartamento($row['Id']);
				$departamento->setIdSevri($row['IdSEVRI']);
				

				array_push($lista, $departamento);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getDepartamentosAgregados(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dDepartamento.php");
			$con = new dtConnection();
			$conexion = $con->conect();
		
			$query2 = "CALL obtenerDepartamentosAgregados()";
			
			$lista2 = array();
	
			$con2 = new dtConnection();
			$conexion2 = $con2->conect();
			$result2 = mysqli_query($conexion2, $query2);
			if($result2){
				while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
					    $departamento = new dDepartamento;
							
						$departamento->setCodigoDepartamento($row2['Codigo']);
						$departamento->setNombreDepartamento($row2['Nombre']);	
						$departamento->setFechaCreacion($row2['FechaCreacion']);	
						$departamento->setIdDepartamento($row2['Id']);					
						array_push($lista2, $departamento);
				}
	
		 	}
			 mysqli_free_result($result2);
			 mysqli_close($conexion2);

			if (!$result2){
				return false;
			} else {
				return $lista2;
			}
		}

		function getDepartamentosSevriNuevo($desicion){
			include_once ('dtConnection.php');
			if($desicion == 1){
				include_once("../dominio/dDepartamento.php");
			}else{
				include_once("../../dominio/dDepartamento.php");
			}
			
			$con = new dtConnection();
			$conexion = $con->conect();
		
			$query2 = "CALL obtenerDepartamentosSevriNuevo()";
			
			$lista2 = array();
	
			$con2 = new dtConnection();
			$conexion2 = $con2->conect();
			$result2 = mysqli_query($conexion2, $query2);
			if($result2){
				while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
					    $departamento = new dDepartamento;
							
						$departamento->setCodigoDepartamento($row2['Codigo']);
						$departamento->setNombreDepartamento($row2['Nombre']);	
						$departamento->setFechaCreacion($row2['FechaCreacion']);	
						$departamento->setIdDepartamento($row2['Id']);					
						array_push($lista2, $departamento);
				}
	
		 	}
			 mysqli_free_result($result2);
			 mysqli_close($conexion2);

			if (!$result2){
				return false;
			} else {
				return $lista2;
			}
		}

		function insertarSevriDepartamento($departamento){
			$con = new dtConnection;
			$prueba = $con->conect();
			$result = $prueba->query("CALL insertarSevriDepartamentos('$departamento')");

			//mysqli_close($prueba);

			if (!$result){
				return false;
			} else {
				return true;
			}
			
		}

		function eliminarSevriDepartamento($departamento){
			$con = new dtConnection;
			$prueba = $con->conect();
			$result = $prueba->query("CALL eliminarDepartamentoAgregado('$departamento')");

			//mysqli_close($prueba);

			if (!$result){
				return false;
			} else {
				return true;
			}
		}
		function insertarDepartamentos($departamento){

			include_once ("dtConnection.php");

			$con = new dtConnection;
			$conexion = $con->conect();

			$codigo=$departamento->getCodigoDepartamento();
			$nombre=$departamento->getNombreDepartamento();
			$fecha=$departamento->getFechaCreacion();
			
			$result=$conexion->query("CALL insertarDepartamento('$codigo','$nombre','$fecha')");

			mysqli_close($conexion);

			if(!$result){

				return false;

			}else{

				return true;
			}
	
				
		}

		function modificarDepartamento($departamento, $idDepartamento){

			include_once ("dtConnection.php");

			$con = new dtConnection;
			$conexion = $con->conect();

			$nombre=$departamento->getNombreDepartamento();
			$fecha=$departamento->getFechaCreacion();
			$codigo=$departamento->getCodigoDepartamento();
			$id=$idDepartamento;
    		
    		$result=$conexion->query("CALL modificarDepartamento('$id','$nombre','$fecha','$codigo')");



			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}

		}


		function eliminarDepartamento($idDepartamento){
			$con = new dtConnection;
			$prueba = $con->conect();

			$result = $prueba->query("CALL eliminarDepartamento('$idDepartamento')");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

	
		function getDepartamento($idDepartamento){
			include_once ("dtConnection.php");
			include_once("../../dominio/dDepartamento.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerDepartamentoPorId('$idDepartamento')";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$departamento = new dDepartamento;
				$departamento->setIdDepartamento($row[0]);
				$departamento->setCodigoDepartamento($row[1]);
				$departamento->setNombreDepartamento($row[2]);	
				$departamento->setFechaCreacion($row[3]);
				
				array_push($lista, $departamento);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getSevriDepartamentos(){

			$con=new dtConnection();
			$conexion=$con->conect();
			$query="CALL obtenerSevriDepartamentos()";
			$result=mysqli_query($conexion,$query);
			$lista=array();

			while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				
				$valores=array("idSevri"=>$row["IdSevri"],
								"idDepartamento"=>$row["IdDepartamento"]);
				array_push($lista, $valores);				
			}

			if(!$result){
				return false;
			}else{
				return $lista;
			}

		}

		function getDepartamentosUsuario($cedula){

			include_once ('dtConnection.php');
			include_once("../../dominio/dDepartamento.php");

			$con=new dtConnection();
			$conexion=$con->conect();
			$query="CALL obtenerDepartamentosUsuario('$cedula')";
			$resultado=mysqli_query($conexion,$query);
			$lista=array();
	
			while ($row=mysqli_fetch_array($resultado,MYSQLI_ASSOC)) {
				$departamento=new dDepartamento;

				$departamento->setIdDepartamento($row['Id']);
				$departamento->setCodigoDepartamento($row['Codigo']);
				$departamento->setNombreDepartamento($row['Nombre']);

				array_push($lista, $departamento);
			}

			mysqli_free_result($resultado);
			mysqli_close($conexion);

			if(!$resultado){
				return false;
			}else{
				return $lista;
			}

		}

		function getDepartamentosSeguimientos(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dDepartamento.php");
			$con=new dtConnection();
			$conexion=$con->conect();
			$query="CALL obtenerDepartamentosSeguimiento()";
			$resultado=mysqli_query($conexion,$query);
			$lista=array();

			while ($row=mysqli_fetch_array($resultado,MYSQLI_NUM)) {
				$departamento=new dDepartamento;
				$departamento->setIdDepartamento($row[0]);
				$departamento->setNombreDepartamento($row[1]);

				array_push($lista, $departamento);
			}

			mysqli_free_result($resultado);
			mysqli_close($conexion);

			if(!$resultado){
				return false;
			}else{
				return $lista;
			}
		}

	}	

?>