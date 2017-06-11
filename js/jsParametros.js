
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

function validarNumero(input){
    if (input.value <= 0) {
        input.value = "";
    }
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

/*filtrado de tablas*/
$(document).ready(function () {
    (function ($) {

        $('#buscarParametroProbabilidad').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('#buscarP1 tr').hide();
            $('#buscarP1 tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

    (function ($) {

        $('#buscarParametroImpacto').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('#buscarImpacto tr').hide();
            $('#buscarImpacto tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

     (function ($) {

        $('#buscarCalificacionMedida').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('#buscarCalificacion tr').hide();
            $('#buscarCalificacion tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));
});
/*fin filtrado*/
//function que evita que se envie varias veces el formulario


// clase de validacion 
var statSend = false;
$(document).ready(function() {
        $('.tooltipped').tooltip({delay: 50}); // mensaje tooltip
        $("#IcrearParametros").validate({
            rules: {
                Tparametro: { required: true },
                descriptor: {  required: true, minlength: 4 , maxlength: 20 },
                descripcion: {  required: true, minlength: 20 , maxlength: 1000 },
                valor: {required: true, maxlength: 1, minlength: 1},
                color: { required: true }
            },
            messages: {
                Tparametro: "Debe seleccionar el tipo de parametro.",
                descriptor: "Debe introducir un descriptor con un tamaño minimo de 4 caracteres y un maximo de 20 caracteres.",
                descripcion: "Debe introducir un descripcion con un tamaño minimo de 20 caracteres y un maximo de 1000 caracteres.",
                valor: "Debe introducir un valor numerico que solo represente un caracter y que sea mayor a 0.",
                color: "Debe seleccionar el color del parametro."

            },
            submitHandler: function(form){
             if(document.getElementById('Tparametro').value==0){
                    Materialize.toast("Debe seleccionar un tipo de parametro", 7000,'blue darken-3');
             }else if(document.getElementById('color').value==0){
                    Materialize.toast("Debe seleccionar el color del parametro", 7000,'blue darken-3');
             }else{
                    if (!statSend) {
                        statSend = true;
                        insertarParametros();
                    } else {
                        Materialize.toast("Ya se esta creando el parámetro", 7000,'blue darken-3');
                    }
                }
            }
        });
    });

//function que oculta el tooltip
function ocultarTooltip(){
  var tooltip= document.getElementById('boton');
  tooltip.style.display="prueba";
}
