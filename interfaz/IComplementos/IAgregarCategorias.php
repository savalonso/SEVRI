<?php 
    include ("../../controladora/ctrDatosSevri.php") ;
    $ctrDatos = new ctrDatosSevri;
    $listaCategoriasActivas = $ctrDatos->obtenerCategoriasSevriNuevo();
    $listaCategorias = $ctrDatos->obtenerCategorias();
?>
<script>
    window.onload=ocultarBarra();
</script>
<?php 
    if($listaCategorias != null ){
?>
<div id="contenedorCategorias">
    <div class="row" id="contenedorTablaCategorias">
    <h3>Categor&iacuteas para agregar</h3>
    <div class="row">
        <div class="col s12 m8 l8">
            <div id="div1">
                <table class="responsive-table responsive striped" id="tbCategorias">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripci&oacuten</th>
                            <th>Opci&oacuten 1</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php 
                        $encontrada = false;
                        foreach ($listaCategorias as $categoria) {
                            if($listaCategoriasActivas){
                                foreach ($listaCategoriasActivas as $categoriaAct) {
                                    if(($encontrada == false) && ($categoria->getIdCategoria()==$categoriaAct->getIdCategoria())){
                                        $encontrada = true;
                                    }
                                }
                            }
                            if($encontrada == true){
                                echo "<tr id=\"ca".$categoria->getIdCategoria()."\" style=\"display:none\">";
                                $encontrada = false;
                            }else{
                                echo "<tr id=\"ca".$categoria->getIdCategoria()."\" >";
                            }
                            
                                echo "<td>".$categoria->getNombreCategoria()."</td>";
                                echo "<td>".$categoria->getDescripcion()."</td>";
                                echo "<td style=\"display: none\">".$categoria->getIdCategoria()."</td>";
                                echo "<td> <input type=\"button\" value=\"Agregar\" class=\"btn btn-default\" onclick=\"add(this, '".$categoria->getIdCategoria()."','2')\"></td>";
                            echo "</tr>";
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col s12 m3 l3">
            <input type="button" onclick="cargarPagina('../interfaz/ICategoria/IInsertarCategoria.php')" value="Crear Categorías" class="btn">
        </div>
    </div>

    <div class="row">
        <h3>Categor&iacuteas Agregadas</h3>
        <div class="col s12 m8 l8">
            <div id="div1">
                <table class="responsive-table responsive striped" id="tbCategoriasAgregadas">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripci&oacuten</th>
                            <th>Opci&oacuten 1</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php 
                        if($listaCategoriasActivas){
                            foreach ($listaCategoriasActivas as $categoriaAct) {
                                echo "<tr id=\"ca".$categoriaAct->getIdCategoria()."\">";
                                    echo "<td>".$categoriaAct->getNombreCategoria()."</td>";
                                    echo "<td>".$categoriaAct->getDescripcion()."</td>";
                                    echo "<td style=\"display: none\">".$categoriaAct->getIdCategoria()."</td>";
                                    echo "<td> <input type=\"button\" value=\"Descartar\" class=\"btn btn-default\" onclick=\"quitarCategoria(this, 'ca".$categoriaAct->getIdCategoria()."','".$categoriaAct->getIdCategoria()."')\"></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
    }else{ ?>
        <h4>No se han creado categor&iacuteas</h4>
        <div class="col s12 m3 l3">
            <input type="button" onclick="cargarPagina('../interfaz/ICategoria/IInsertarCategoria.php')" value="Crear Categorías" class="btn">
        </div>
   <?php } ?>
<script type="text/javascript" src="../js/jsTablas.js"></script>