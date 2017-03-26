function insertarCategoria(){
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
    });    
}
function confirmarModificacionEliminacionCategoria(idCategoria){
    document.getElementById('idCategoria').value = idCategoria;
}

function cancelarModificar(){
    document.getElementById('contenedorConfirmacion').style.display = 'none';
}
function eliminarCategoria(){
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
    });
}
function modificarCategoria(){
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
        alert(data);
    });
}