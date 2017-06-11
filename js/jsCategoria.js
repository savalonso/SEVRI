function insertarCategoria(){
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IInsertarCategoria"));
    if(document.getElementById('categoria').disabled==false){
      formData.append("subcategoria", 1);
    }else{
      formData.append("subcategoria", 0);
    }
    formData.append("opcion", 1);
    $.ajax({
    url : "../controladora/ctrCategoria.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });    
}
function confirmarModificacionEliminacionCategoria(idCategoria){
    document.getElementById('idCategoria').value = idCategoria;
}

function cancelarModificar(){
    document.getElementById('contenedorConfirmacion').style.display = 'none';
}
function eliminarCategoria(){
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IMostrarCategoria"));
    var id = document.getElementById("idCategoria").value;
    formData.append("opcion", 2);
    formData.append("idCategoria", id);
    $.ajax({
        url : "../controladora/ctrCategoria.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}
function modificarCategoria(){
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IModificarCategoria")); 
    var id = document.getElementById("id").value;
    formData.append("idCategoria", id);
    if(document.getElementById('categoria').disabled==false){
      formData.append("subcategoria", 1);
    }else{
      formData.append("subcategoria", 0);
    }
    formData.append("opcion", 3);
    $.ajax({
        url : "../controladora/ctrCategoria.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ICategoria/IMostrarCategoria.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    });
}
/*aqui se encuentra el paginador de las tablas*/
 $(document).ready(function(){

        $("#tbCategorias").paginationTdA({
            elemPerPage: 4
        });
    });
 $(document).ready(function(){
        $("#tbCategoriasAgregadas").paginationTdA({
            elemPerPage: 4
        });
    });
 $(document).ready(function(){
        $("#categoria").paginationTdA({
            elemPerPage: 4
        });
    });
 $(document).ready(function(){

        $("#subCategorias").paginationTdA({
            elemPerPage: 4
        });
    });

/*aqui finalisa*/
/*filtrado de tablas*/
$(document).ready(function () {
    (function ($) {

        $('#datosCategoria').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('#categoria1 tr').hide();
            $('#categoria1 tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));
      (function ($) {

        $('#datosSubCategoria').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('.subcategoria tr').hide();
            $('.subcategoria tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
/*funcion que levanta el modal*/

    $(document).ready(function(){
        $('.modal-trigger').leanModal();
    });



