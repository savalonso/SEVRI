<?php 
	class dtCategoria {
		
		function dtCategoria(){}
		function eliminarSevriCategoria($idCategoria){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL eliminarSevriCategoria($idCategoria)");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}
			
		}
		function insertarSevriCategoria($idCategoria){
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL insertarSevriCategorias('$idCategoria')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}
		}
		function insertarCategoria($Categoria){
			include_once ('dtConnection.php');
			include_once ("../dominio/dCategoria.php");
			$con = new dtConnection;
			$prueba = $con->conect();
			$nombreCategoria = $Categoria->getNombreCategoria();
			$descripcionCategoria = $Categoria->getDescripcion();
			$hijoDe = $Categoria->getHijoDe();

			$result = $prueba->query("CALL insertarCategoria('$nombreCategoria', '$descripcionCategoria', $hijoDe)");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

		function modificarCategoria($Categoria){
			include_once ('dtConnection.php');
			include_once ("../dominio/dCategoria.php");
			$con = new dtConnection;
			$prueba = $con->conect();

			$idCategoria = $Categoria->getIdCategoria();
			$nombreCategoria = $Categoria->getNombreCategoria();
			$descripcionCategoria = $Categoria->getDescripcion();
			$hijoDe = $Categoria->getHijoDe();
			$result = $prueba->query("CALL modificarCategoria($idCategoria,'$nombreCategoria', '$descripcionCategoria', $hijoDe)");
			if (!$result){
				return false;
			} else {
				return true;
			}
		}

		function getCategorias(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dCategoria.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerCategorias(0)";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$categoria = new dCategoria;
					
				$categoria->setNombreCategoria($row['Nombre']);
				$categoria->setIdCategoria($row['Id']);	
				$categoria->setDescripcion($row['Descripcion']);						
				$categoria->setHijoDe($row['HijoDe']);

				array_push($lista, $categoria);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function getTodasLasCategorias(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dCategoria.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerCategoriasActivas()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$categoria = new dCategoria;
					
				$categoria->setNombreCategoria($row['Nombre']);
				$categoria->setIdCategoria($row['Id']);	
				$categoria->setDescripcion($row['Descripcion']);
				$categoria->setHijoDe($row['HijoDe']);						

				array_push($lista, $categoria);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function obtenerCategoriasActivas(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dCategoria.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerCategoriasSevriActivo()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$categoria = new dCategoria;
					
				$categoria->setNombreCategoria($row['Nombre']);
				$categoria->setIdCategoria($row['Id']);	
				$categoria->setDescripcion($row['Descripcion']);
				$categoria->setHijoDe($row['HijoDe']);						

				array_push($lista, $categoria);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		function obtenerCategoriasSevriNuevo($desicion){
			include_once ('dtConnection.php');
			if($desicion == 1){
				include_once("../dominio/dCategoria.php");
			}else{
				include_once("../../dominio/dCategoria.php");
			}
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerCategoriasSevriNuevo()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$categoria = new dCategoria;
					
				$categoria->setNombreCategoria($row['Nombre']);
				$categoria->setIdCategoria($row['Id']);	
				$categoria->setDescripcion($row['Descripcion']);
				$categoria->setHijoDe($row['HijoDe']);						

				array_push($lista, $categoria);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function getCategoria($idCategoria){
			include_once ('dtConnection.php');
			include_once("../../dominio/dCategoria.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerCategoria('$idCategoria')";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			
				$categoria = new dCategoria;
				$categoria->setIdCategoria($row[0]);
				$categoria->setNombreCategoria($row[1]);
				$categoria->setDescripcion($row[2]);	
				$categoria->setHijoDe($row[3]);
				
				array_push($lista, $categoria);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);
			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}
		function getListaCategoriaDE(){
			include_once ('dtConnection.php');
			include_once("../../dominio/dCategoria.php");
			$con = new dtConnection();
			$conexion = $con->conect();
			$query = "CALL obtenerCategoriasDE()";
			$lista = array();
			$result = mysqli_query($conexion, $query);
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$categoria = new dCategoria;
					
				$categoria->setNombreCategoria($row['Nombre']);
				$categoria->setIdCategoria($row['Id']);	
				$categoria->setDescripcion($row['Descripcion']);
				$categoria->setHijoDe($row['HijoDe']);
				$categoria->setCantHijos($row['cantHijos']);
				$categoria->setCantRiesgos($row['cantRiesgos']);					

				array_push($lista, $categoria);
			}
			mysqli_free_result($result);
			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return $lista;
			}
		}

		/*function insertarSevriCategoria($categorias){
			$con = new dtConnection;
			$conexion = $con->conect();
			$query = "CALL obtenerIdSevriActivo()";

			$result = mysqli_query($conexion, $query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$id = $row['Id'];
			$conexion = $con->crearConexionPDO();
			try {
        	 	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	 		$conexion->beginTransaction();
	 	 		
				foreach ($categorias as $categoria) {
	                $conexion->exec("INSERT INTO tbsevricategoria VALUES('".$id."', '".$categoria."');");
				}				  

				$conexion->commit();
				return true;
            } catch (Exception $e) {
            	$conexion->rollback();
            	return false;
            }
			
		}*/
		function eliminarCategoria($idCategoia){
			include_once ('dtConnection.php');
			$con = new dtConnection;
			$conexion = $con->conect();

			$result = $conexion->query("CALL eliminarCategoria('$idCategoia')");

			mysqli_close($conexion);

			if (!$result){
				return false;
			} else {
				return true;
			}
		}
	}	

?>