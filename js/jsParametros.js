
function insertarParametros(){
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IcrearParametros")); 
    formData.append("opcion", 1);
    $.ajax({
    url : "../controladora/ctrParametros.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IParametros/ImostrarParametros.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    }); 
}

function modificarParametro(){
    document.getElementById('barraCargando').style.display="";
    var idParametro = document.getElementById('idParametro').value;
    var formData = new FormData(document.getElementById("modificarParametro")); 
    formData.append("opcion", 2);
    formData.append("codigoParametro", idParametro);
    $.ajax({
    url : "../controladora/ctrParametros.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IParametros/ImostrarParametros.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    }); 
}

function eliminarParametro(){
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData();
    var idParametro = document.getElementById('idParametro').value;
    formData.append("idParametro", idParametro); 
    formData.append("opcion", 3);
    $.ajax({
    url : "../controladora/ctrParametros.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IParametros/ImostrarParametros.php');
        Materialize.toast(data, 7000,'blue darken-3');
        document.getElementById('barraCargando').style.display="none";
    }); 
}

function confirmarEliminacion(idParametro){
    document.getElementById('idParametro').value = idParametro;
}

function ocultarDiv(){
    document.getElementById('divModificarParametros').style.display = 'none';
}

function cambiarColor($color){
    document.getElementById('divColor').style.background=$color;
}

function invocarDivModificar(button,idParametro, color){
    var row = button.parentNode.parentNode;
    var cells = row.querySelectorAll('td:not(:last-of-type)');

    document.getElementById('descriptor').value = cells[2].innerText;
    document.getElementById('descriptor').placeholder = "dato: " + cells[2].innerText;

    document.getElementById('descripcion').value = cells[3].innerText;
    document.getElementById('descripcion').placeholder = "dato: " + cells[3].innerText;

    document.getElementById('valor').value = cells[1].innerText;
    document.getElementById('valor').placeholder = "dato: " + cells[1].innerText;

    var tipoParametro = cells[0].innerText;
    document.getElementById('idParametro').value = idParametro;
    encontrarSeleccionado('Tparametro', tipoParametro);
    marcarColor('color', color);
    $( document ).ready(function(){
        $('select').material_select();
    });
    document.getElementById('divModificarParametros').style.display = '';
}

function encontrarSeleccionado(idSelect, valor){
    var select = document.getElementById(idSelect);
    for (var i = select.length - 1; i >= 0; i--) {
        if(select[i].innerText  == valor){
            select[i].selected = true;
        }
    }
}

function marcarColor(idSelect, valor){
    var select = document.getElementById(idSelect);
    for (var i = select.length - 1; i >= 0; i--) {
        if(select[i].value  == valor){
            select[i].selected = true;
            cambiarColor(valor);
        }
    }
}
/*aqui se encuentra el paginador de las tablas*/
 
 $(document).ready(function(){
        $("#impacto").paginationTdA({
            elemPerPage: 4
        });
    });
  $(document).ready(function(){
        $("#probabilidad").paginationTdA({
            elemPerPage: 4
        });
    });
  $(document).ready(function(){
        $("#calificacion").paginationTdA({
            elemPerPage: 4
        });
    });
/*aqui finalisa*/