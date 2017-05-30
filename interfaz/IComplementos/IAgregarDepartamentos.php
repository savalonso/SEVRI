<?php
    session_start();
    $tipo="";
    if(isset($_SESSION['tipo'])){
        $tipo=$_SESSION['tipo'];
    }else{
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
    if($tipo!='Administrador'){
        echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http:../index.php\">";
    }
    include ("../../controladora/ctrDatosSevri.php") ;
    $ctrDatos = new ctrDatosSevri;
    $listaDepartamentos = $ctrDatos->obtenerDepartamentos();
    $listaDepartamentosAgregados = $ctrDatos->obtenerDepartamentosSevriNuevo();
?>
<script>
    window.onload=ocultarBarra();
</script>
<?php 
    if($listaDepartamentos != null ){
?>
<div id="contenedorDepartamentos">
    <div class="row" id="contenedorTablaCategorias">
    <h3>Departamentos para agregar</h3>
        <div class="col s12 m8 l8">
            <div id="div1">
                <table class="responsive-table responsive striped" id="tbDepartamentos">
                    <thead>
                        <tr>
                            <th>C&oacutedigo Departamento</th>
                            <th>Nombre Departamento</th>
                            <th>Opci&oacuten 1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $encontrada = false;
                        foreach ($listaDepartamentos as $departamento) {
                            if($listaDepartamentosAgregados){
                                foreach ($listaDepartamentosAgregados as $depAgregado) {
                                    if(($encontrada == false) && ($departamento->getIdDepartamento()==$depAgregado->getIdDepartamento())){
                                        $encontrada = true;
                                    }
                                }
                            }
                            if($encontrada == true){
                                echo "<tr id=\"de".$departamento->getIdDepartamento()."\" style=\"display:none\">";
                                $encontrada = false;
                            }else{
                                echo "<tr id=\"de".$departamento->getIdDepartamento()."\" >";
                            }
                            
                                echo "<td>".$departamento->getCodigoDepartamento()."</td>";
                                echo "<td>".$departamento->getNombreDepartamento()."</td>";
                                echo "<td style=\"display: none\">".$departamento->getIdDepartamento()."</td>";
                                echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$departamento->getIdDepartamento()."','3')\"></td>";
                            echo "</tr>";
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <input type="button" onclick="cargarPagina('../interfaz/IDepartamento/IInsertarDepartamento.php')" value="Crear Departamentos" class="btn">
        </div>
    </div>

    <div class="row">
        <h3>Departamentos Agregados</h3>
        <div class="col s12 m8 l8">
            <div id="div1">
                <table class="responsive-table responsive striped" id="tbDepartamentosAgregadas">
                    <thead>
                        <tr>
                            <th>C&oacutedigo Departamento</th>
                            <th>Nombre Departamento</th>
                            <th>Opci&oacuten 1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($listaDepartamentosAgregados){
                            foreach ($listaDepartamentosAgregados as $depAgregado) {
                                echo "<tr id=\"de".$depAgregado->getIdDepartamento()."\">";
                                    echo "<td>".$depAgregado->getCodigoDepartamento()."</td>";
                                    echo "<td>".$depAgregado->getNombreDepartamento()."</td>";
                                    echo "<td style=\"display: none\">".$depAgregado->getIdDepartamento()."</td>";
                                    echo "<td> <input type=\"button\" value=\"Descartar\" class=\"btn btn-default\" onclick=\"quitarDepartamento(this, 'de".$depAgregado->getIdDepartamento()."','".$depAgregado->getIdDepartamento()."')\"></td>";
                                echo "</tr>";
                            }
                        }
                            ?>
                    </tbody>
                </table>
            <div id="div1">
        </div>
    </div>
</div>
<?php 
    }else{ ?>
        <h4>No se han creado departamentos</h4>
        <div class="col s12 m3 l3">
            <input type="button" onclick="cargarPagina('../interfaz/IDepartamento/IInsertarDepartamento.php')" value="Crear Departamentos" class="btn">
        </div>
   <?php } ?>
<script type="text/javascript" src="../js/jsTablas.js"></script>