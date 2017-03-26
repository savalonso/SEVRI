<?php 
class LogicaSevri{

	public function LogicaSevri(){

	}

	public function verificarListaParametros($listaParametros){
		$resultado = 1;
		if(is_null($listaParametros)){
			$resultado = 2;
		}else{
			$contador = 1;
			foreach ($listaParametros as $parametro) {
				if($parametro->getValorParametro() != $contador){
					$resultado = 3;
				}
				$contador++;
			}
		}
		return $resultado;
	}

	public function dividirParametros($lista, $desicion){
		$listaNueva = array();
		foreach ($lista as $parametro) {
			if(($desicion == 1) && (strcmp ($parametro->getNombreParametro() , "Impacto")==0)){
				array_push($listaNueva, $parametro);
			}else if(($desicion == 2) && (strcmp ($parametro->getNombreParametro() , "Probabilidad")==0)){
				array_push($listaNueva, $parametro);
			}else if(($desicion == 3) && (strcmp ($parametro->getNombreParametro() , "Calificacion")==0)){
				array_push($listaNueva, $parametro);
			}
		}
		asort($listaNueva);
		return $listaNueva;
	}

	public function verificarDepartamentos(){
		include_once('../data/dtDepartamento.php');
		$dataDepartamento = new dtDepartamento;
		$listaDepartamentos = $dataDepartamento->getDepartamentosSevriNuevo(1);
		if($listaDepartamentos == false){
			return false;
		}
		else{
			return true;
		}
	}

	public function verificarCategorias(){
		include_once('../data/dtCategoria.php');
		$dataCategoria = new dtCategoria;
		$listaCategorias = $dataCategoria->obtenerCategoriasSevriNuevo(1);
		if($listaCategorias == false){
			return false;
		}
		else{
			return true;
		}
	}

	public function verificarComplementos($idSevri){
		include_once("../data/dtParametro.php");
		include_once("../data/dtSevri.php");
		$resultado = 1;
		$mensaje = '';
		$dataParametro = new dtParametro;
		$dataSevri = new dtSevri;
		if($this->verificarCategorias() == true){
			if($this->verificarDepartamentos() == true){
				$listaParametros = $dataParametro->getParametrosSevriNuevo(1);
				if(is_null($listaParametros) == false){
					$listaImpacto = $this->dividirParametros($listaParametros, 1);
					$listaProbabilidad = $this->dividirParametros($listaParametros, 2);
					$listaCalificacion = $this->dividirParametros($listaParametros, 3);
				}else{
					$resultado = 2;
				}

				if($resultado == 1){
					$resultado = $this->verificarListaParametros($listaImpacto);
					if($resultado == 1){
						$resultado = $this->verificarListaParametros($listaProbabilidad);
						if($resultado == 1){
							$resultado = $this->verificarListaParametros($listaCalificacion);
							if($resultado == 2){
								$mensaje = 'El SEVRI no se puede activar porque:  No se agregaron parametros para la medida de calificacion';
							}else if($resultado == 3){
								$mensaje = ' El SEVRI no se puede activar porque:  Se agregaron valores repetidos, o faltan valores para la medida de calificacion';
							}else{
								if($dataSevri->activarSevri($idSevri)){
									$mensaje = 'El SEVRI se ha activado correctamente';
								}else{
									$mensaje = 'No se ha podido activar el SEVRI';
								}
							}
						}else if($resultado == 2){
							$mensaje = 'El SEVRI no se puede activar porque:  No se agregaron parametros para los valores de probabilidad';
						}else if($resultado == 3){
							$mensaje = 'El SEVRI no se puede activar porque:  Se agregaron valores repetidos, o falta valores para los datos de probabilidad';
						}
					}else if($resultado == 2){
						$mensaje = 'El SEVRI no se puede activar porque:  No se agregaron parametros para los valores de impacto';
					}else if($resultado == 3){
						$mensaje = 'El SEVRI no se puede activar porque:  Se agregaron valores repetidos, o faltan valores para los datos de impacto';
					}
				}else{
					$mensaje = 'El SEVRI no se puede activar porque:  No se ha agregado ningún parametro';
				}
			}else{
				$mensaje = 'El SEVRI no se puede activar porque:  No se ha agregado ninguna Categoría';
			}
		}else{
			$mensaje = 'El SEVRI no se puede activar porque:  No se ha agregado ningún Departamento';
		}
		return $mensaje;
	}

	public function desactivarSevri($idSevri){
		include_once("../data/dtSevri.php");
		$dataSevri = new dtSevri;
		$mensaje = '';
		$resultado = $dataSevri->desactivarSevri($idSevri);
		if($resultado){
			$mensaje = 'EL SEVRI se ha desactivado correctamente';
		}else{
			$mensaje = 'No se ha podido desactivar el SEVRI';
		}
		return $mensaje;
	}

	public function insertarSevri($sevri){
		include_once("../data/dtSevri.php");
		$correcto = true;
		$mensaje = '';
		$dataSevri = new dtSevri;
		$listaSevri = $dataSevri->getListaSevri(2);
		foreach ($listaSevri as $sevriCreado) {
			if($correcto && $sevriCreado->getEsNuevo() == 1){
				$correcto = false;
			}
		}
		if($correcto){
			$resultado = $dataSevri->insertarSevri($sevri);
			if($resultado){
				$mensaje = 'CORRECTO!! EL SEVRI se ha creado correctamente';
			}else{
				$mensaje = 'ERROR!! No se ha podido crear el SEVRI';
			}
		}else{
			$mensaje = 'Lo sentimos no se puede crear el sevri porque ya existe otro sevri en el cual no se ha efectuado ningun proceso.';
		}
		return $mensaje;
	}

	public function insertarParametro($parametro){
		include_once("../data/dtParametro.php");

		$dtparametro = new dtParametro();

		$resultado = $dtparametro->insertarParametros($parametro);
		$mensaje = '';

		if(!$resultado){
			$mensaje = 'Lo sentimos no se ha podido ingresar el parametro';
		}else{
			$mensaje =  'El parametro se ha ingresado correctamente';
		}
		return $mensaje;
	}

	public function modificarParametro($parametro){
		include_once("../data/dtParametro.php");

		$dtparametro = new dtParametro();

		$resultado = $dtparametro->modificarParametro($parametro);
		$mensaje = '';
		if(!$resultado){
			$mensaje = 'Lo sentimos no se ha podido modificar el parametro';
		}else{
			$mensaje = 'El parametro se ha modificado correctamente';
		}
		return $mensaje;
	}

	public function eliminarParametro($idParametro){
		include_once("../data/dtParametro.php");

		$dtparametro = new dtParametro();

		$resultado = $dtparametro->eliminarParametro($idParametro);
		$mensaje = '';
		if(!$resultado){
			$mensaje = 'Lo sentimos no se ha podido eliminar el parametro';
		}else{
			$mensaje = 'El parametro se ha eliminado correctamente';
		}
		return $mensaje;
	}

	public function traerParametros(){
			include_once('../data/dtParametro.php');
			$dataParametro = new dtParametro();
			$lista = $dataParametro->getParametros();

			if(!$lista){
				return false;
			}else{
				return $lista;
			}
	}

	function obtenerParametrosfiltrados(){
		include_once('../../data/dtParametro.php');
			$dataParametro = new dtParametro();
			$listaParametros = $dataParametro->getParametros();
			$sevriParametros = $dataParametro->getSevriParametros();
 			$vinculados = array();
 			$encontrado = false;

 			// en el primer for se sacan los parametros que estan vinculados

		        for ($i=0; $i < count($listaParametros) ; $i++) { 

			         for ($j=0; $j < count($sevriParametros) ; $j++) { 
			         	$temp = $sevriParametros[$j];
			         	if ($listaParametros[$i]->getIdParametro() == $temp['idParametro']) {
			              array_push($vinculados,$listaParametros[$i]);
			              $j = count($sevriParametros);
			            }
			         }
		        }
		    // en el segundo for se se comparan los vinculados con todos los parametros y se sacan los que no se encuentran vinculados
		         for ($i=0; $i < count($listaParametros) ; $i++) { 

			         for ($j=0; $j < count($vinculados) ; $j++) { 
			         	
			         	if ($listaParametros[$i]->getIdParametro() == $vinculados[$j]->getIdParametro()) {
			             	$encontrado = true;
			            }
			         }
			         if($encontrado == false){
			         	$listaParametros[$i]->setEsModificable(true);
			         }else{
			         	$listaParametros[$i]->setEsModificable(false);
			         	$encontrado = false;
			         }
		        }

			if(!$listaParametros){
				return false;
			}else{
				return $listaParametros;
			}
	}
}

?>