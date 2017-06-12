
function insertarSevri(){
    //document.getElementById('btnCrearSevri').disabled = true;
    desabilitarBotonesModEli();
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById("IcrearSevri")); 
    formData.append("opcion", 1);
    $.ajax({
    url : "../controladora/ctrSevri.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/ISevri/IMostrarSevri.php');
        Materialize.toast(data, 7000,'blue darken-3');
        ocultarBarra();
    });    
}

function activarSevri(idSevri){
  document.getElementById('barraCargando').style.display="";
  var formData = new FormData();
  formData.append("idSevri", idSevri); 
  formData.append("opcion", 13);
  $.ajax({
  url : "../controladora/ctrSevri.php",
  type : "post",
  dataType : "html",
  data : formData,
  cache : false,
  contentType : false,
  processData : false
  }).done(function(data) {
      cargarPagina('../interfaz/ISevri/IMostrarSevri.php');
      Materialize.toast(data, 7000,'blue darken-3');
      ocultarBarra();
      mostrarOpcionProcesos();
  });    
}
function mostrarOpcionProcesos(){//esta funcion muestra del header la opcion de procesos
  document.getElementById('opcionProcesos').style.display = "";
  document.getElementById('opcionProcesos2').style.display = "";
}

function desactivarSevri(idSevri){
  document.getElementById('barraCargando').style.display="";
  var formData = new FormData();
  formData.append("idSevri", idSevri); 
  formData.append("opcion", 14);
  $.ajax({
  url : "../controladora/ctrSevri.php",
  type : "post",
  dataType : "html",
  data : formData,
  cache : false,
  contentType : false,
  processData : false
  }).done(function(data) {
      cargarPagina('../interfaz/ISevri/IMostrarSevri.php');
      Materialize.toast(data, 7000,'blue darken-3');
      ocultarBarra();
      ocultarOpcionProcesos();
  });    
}
function ocultarOpcionProcesos(){//esta funcion oculta del header la opcion de procesos
   document.getElementById('opcionProcesos').style.display = "none";
   document.getElementById('opcionProcesos2').style.display = "none";
}

function ocultarTodos(){
    document.getElementById('contenedorTablaProbabilidad').style.display='none';
    document.getElementById('contenedorTablaImpacto').style.display='none';
    document.getElementById('contenedorTablaCalificacion').style.display='none';
}

function mostarTabla(id){
  ocultarTodos();
  document.getElementById(id).style.display='';
}

function incluirExcluirElementos(idOrigen, idDestino) {
    var comboOrigen = document.getElementById(idOrigen);
    var comboDestino = document.getElementById(idDestino);
    var nuevaOpcion = new Option(comboOrigen[comboOrigen.selectedIndex].text,comboOrigen[comboOrigen.selectedIndex].value,"","");
    var a = comboDestino.length;
    comboOrigen.options[comboOrigen.options.selectedIndex] = null;
    comboDestino[a] = nuevaOpcion;
    alert(comboDestino[a].value);
    comboDestino[a].selected = true;
}

function paginaModificarSevri(IdSevri){ 
 $('#contenedor').load("../interfaz/ISevri/IModificarSevri.php?IdSevri="+IdSevri);
}

function cargarPagina (url) {
    document.getElementById('barraCargando').style.display="";
    $('#contenedor').load(url);
}
function cargarPaginaHistorial (url) {
    document.getElementById('barraCargando').style.display="";
    $('#contenedorAdministracion').load(url);
}
function cargarPaginaHistorialS (url) {
    document.getElementById('barraCargando').style.display="";
    $('#contenedorSeguimiento').load(url);
}

function cargarPaginaConfiguraciones (url, radioButton) {
    var inputRadioSeleccionado = document.getElementById('idRadioSeleccionado');
    if (inputRadioSeleccionado.value != radioButton.id) {
      inputRadioSeleccionado.value = radioButton.id;
      document.getElementById('barraCargando').style.display="";
      $('#contenedorPaginaConfiguraciones').load(url);
    }
}

function ocultarBarra(){
    document.getElementById('barraCargando').style.display="none";
}

function confirmaActualizar(){
    var div = document.getElementById('confirmarActualizar');
    var divMensaje = document.getElementById('mensaje1');
    divMensaje.innerHTML = '¿Est&aacute seguro que desea realizar est&aacute operaci&oacuten?';
    div.style.display = '';
    divMensaje.style.display = '';
}

function cancelarActualizar(){
    var div = document.getElementById('confirmarActualizar');
    var divFormulario = document.getElementById('contenedorFormulario');
    var divMensaje = document.getElementById('mensaje1');
    divMensaje.style.display = 'none';
    div.style.display = 'none';
    divFormulario.style.display = "none";
}

function actualizarSevri(){
    desabilitarBotonesModEli();
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(document.getElementById('actualizarSevri')); 
    var id = document.getElementById("id").value;
    formData.append("opcion", 5);
    formData.append("id",id);
    $.ajax({
    url : "../controladora/ctrSevri.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
    cargarPagina('../interfaz/ISevri/IMostrarSevri.php');
    Materialize.toast(data, 7000,'blue darken-3');
    ocultarBarra();
    });    
}

function eliminarSevri(){
    desabilitarBotonesModEli();
    document.getElementById('barraCargando').style.display="";
    var formData = new FormData(); 
    var id = document.getElementById("idSevri").value;
    formData.append("opcion", 6);
    formData.append("idSevri",id);
    $.ajax({
      url : "../controladora/ctrSevri.php",
      type : "post",
      dataType : "html",
      data : formData,
      cache : false,
      contentType : false,
      processData : false
    }).done(function(data) {
       cargarPagina('../interfaz/ISevri/IMostrarSevri.php');
       Materialize.toast(data, 7000,'blue darken-3');
       ocultarBarra();
    });    
}

function confirmarEliminacion(idSevri){
    document.getElementById('contenedorConfirmacion').style.display = '';
    document.getElementById('mensajeConfirmacion').innerHTML='¿Est&aacute seguro que desea realizar esta operaci&oacuten?'
    document.getElementById('idSevri').value = idSevri;
}

function cancelarEliminar(){
    document.getElementById('contenedorConfirmacion').style.display = 'none';
}

function desactivarFila(posicion){
    document.getElementById(posicion).style.display  = 'none';
}

function activarFila(posicion){
    document.getElementById(posicion).style.display  = '';
}


/*Metodo que se encarga de vincular o desvicular los parametros, categorias y departamentos al sevri
los valores que recibe son los siguientes:
id= el id del elemento que se quiere vincular o desvincular del sevri
opcion=el metodo que tiene que llamar ctrSevri dependiendo del tipo de elemento a eliminar y acción a realizar
idCulumna=la columna que se quiere mostrar y solo se utiliza si  la desición es 4 o mayor
desicion=para saber a cual tabla se deben agregar los objetos
fila= toda la fila que se quiere agregar a la otra tabla
posicion=la posicion del elemento que se va eliminar, tambien se utiliza para saber la tabla en caso de que se quiera eliminar
nombre=nombre del objeto o lugar donde se van a insertar los datos y solo se utiliza si es en la tabla parametros
*/
function agregarEliminarParametroSevri(id, opcion, idColumna, desicion, fila, posicion, nombre){
  document.getElementById('barraCargando').style.display="";
  var formData = new FormData(); 
  formData.append("opcion", opcion);
  formData.append("id", id);
  var seInserto = "";
  $.ajax({
    url : "../controladora/ctrSevri.php",
    type : "post",
    dataType : "html",
    data : formData,
    cache : false,
    contentType : false,
    processData : false
  }).done(function(data) {
    ocultarBarra();
    var respuesta = eval(data);
    for(var i in respuesta){
      seInserto = respuesta[i].inserto;
      var mensaje = respuesta[i].mensaje;
    }
    Materialize.toast(mensaje, 7000,'blue darken-3');
    if(seInserto == 1){
      if(desicion == 1){
        agregarATablaParametros(fila,posicion,nombre);
      }else if(desicion == 2){
        agregarATablaCategorias(fila, posicion);
      }else if(desicion == 3){
        agregarATablaDepartamentos(fila, posicion);
      }else{
        document.getElementById(idColumna).style.display = '';
        switch(posicion){
          case 1:
            document.querySelector('#tbParametrosAgregados tbody').removeChild(fila);
            break;
          case 2:
            document.querySelector('#tbCategoriasAgregadas tbody').removeChild(fila);
            break;
          case 3:
            document.querySelector('#tbDepartamentosAgregadas tbody').removeChild(fila);
            break;
        }
      }
    }
  });
  return seInserto; 
}

function remove() {
  var row = this.parentNode.parentNode;
  document.querySelector('#tbParametrosAgregados tbody').removeChild(row);

  var cells = row.querySelectorAll('td:not(:last-of-type)');
  var idElemento = cells[5].innerText;

  agregarEliminarParametroSevri(idElemento, 8, idElemento, 4);
}

/*En el siguiente metodo se desvinculan los parametros de la version del sevri que sea nueva
recibe el boton para así poder tener una referencia del elemento y el id del parametro que se quiere
eliminar o desvincular de la verisón del sevri*/
function removerParametros(boton, idElemento) {
  var row = boton.parentNode.parentNode;
  agregarEliminarParametroSevri(idElemento, 8, idElemento, 4, row, 1);
}

function quitarCategoria(boton, idFila, idCategoria) {
  var row = boton.parentNode.parentNode;
  agregarEliminarParametroSevri(idCategoria,10, idFila, 4, row, 2);
}

function quitarDepartamento(boton, idFila, idDepartamento) {
  var row = boton.parentNode.parentNode;
  agregarEliminarParametroSevri(idDepartamento,12, idFila, 4, row, 3);
}

function removerCategorias() {
  var row = this.parentNode.parentNode;

  var cells = row.querySelectorAll('td:not(:last-of-type)');
  var idFila = cells[3].innerText;
  var idCategoria = cells[2].innerText;

  agregarEliminarParametroSevri(idCategoria,10, idFila, 4, row, 2);
}

function removerDepartamentos() {
  var row = this.parentNode.parentNode;

  var cells = row.querySelectorAll('td:not(:last-of-type)');
  var idFila = cells[3].innerText;
  var idDepartamento = cells[2].innerText;

  agregarEliminarParametroSevri(idDepartamento,12, idFila, 4, row, 3);
}

function add(button, idElemento, opcion, nombre) {
  var row = button.parentNode.parentNode;
  var cells = row.querySelectorAll('td:not(:last-of-type)');
  if(opcion == 1){
    agregarEliminarParametroSevri(idElemento, 7, 0, 1, cells, idElemento, nombre);
  }
  else if(opcion == 2){
    agregarEliminarParametroSevri(idElemento,9, 0, 2, cells, 'ca'+idElemento, "");
  }
  else if(opcion == 3){
    agregarEliminarParametroSevri(idElemento,11, 0, 3, cells, 'de'+idElemento, "");
  }
}

function agregarATablaParametros(cells, posicion, nombre) {
   var valor = cells[0].innerText;
   var descriptor = cells[1].innerText;
   var descripcion = cells[2].innerText;
   var id = cells[3].innerText;

  desactivarFila(posicion);
  var newRow = document.createElement('tr');

  newRow.appendChild(createCell(valor));
  newRow.appendChild(createCell(descriptor));
  newRow.appendChild(createCell(descripcion));
  newRow.appendChild(createCell(nombre));
  newRow.appendChild(createCell(id)).style.display = "none";
  newRow.appendChild(createCell(posicion)).style.display = "none";
  var cellRemoveBtn = createCell();
  cellRemoveBtn.appendChild(createRemoveBtn(1));
  newRow.appendChild(cellRemoveBtn);
  document.querySelector('#tbParametrosAgregados tbody').appendChild(newRow);
}

function agregarATablaCategorias(cells, posicion) {
  var nombre = cells[0].innerText;
  var descripcion = cells[1].innerText;
  var id = cells[2].innerText;

  desactivarFila(posicion);
  var newRow = document.createElement('tr');

  newRow.appendChild(createCell(nombre));
  newRow.appendChild(createCell(descripcion));
  newRow.appendChild(createCell(id)).style.display = "none";
  newRow.appendChild(createCell(posicion)).style.display = "none";
  var cellRemoveBtn = createCell();
  cellRemoveBtn.appendChild(createRemoveBtn(2));
  newRow.appendChild(cellRemoveBtn);
  document.querySelector('#tbCategoriasAgregadas tbody').appendChild(newRow);
}

function agregarATablaDepartamentos(cells, posicion) {
  var codigo = cells[0].innerText;
  var nombre = cells[1].innerText;
  var id = cells[2].innerText;

  desactivarFila(posicion);
  var newRow = document.createElement('tr');

  newRow.appendChild(createCell(codigo));
  newRow.appendChild(createCell(nombre));
  newRow.appendChild(createCell(id)).style.display = "none";
  newRow.appendChild(createCell(posicion)).style.display = "none";
  var cellRemoveBtn = createCell();
  cellRemoveBtn.appendChild(createRemoveBtn(3));
  newRow.appendChild(cellRemoveBtn);
  document.querySelector('#tbDepartamentosAgregadas tbody').appendChild(newRow); 
   
}


function createRemoveBtn(opcion) {
    var btnRemove = document.createElement('button');
    if(opcion == 1){
        btnRemove.onclick = remove;
    }else if(opcion == 2){
        btnRemove.onclick = removerCategorias;
    }else{
        btnRemove.onclick = removerDepartamentos;
    }
    btnRemove.innerText = 'Descartar';
    btnRemove.className = 'btn btn-default';
    return btnRemove;
}

function createCell(text) {
    var td = document.createElement('td');
    if(text) {
        td.innerText = text;
    }
    return td;
}

function recorrerTabla(posicion, tabla){
    var tabla = document.getElementById(tabla);
    var filas = "";
    var id = "";
    var parametros = new Array();
    for(var i = 1; i < tabla.rows.length; i++){
        filas = tabla.rows[i].getElementsByTagName('td');
        id = filas[posicion].innerHTML;
        parametros[i-1] = id;
    }
    return parametros;
}

function escogerTipoReporte(tipoReporte){
  document.getElementById('opcion').value = tipoReporte;
}


/*
* con el siguiente metodo se obtienen todos los botones submit que insertan
* modifican y eliminan para que cuando se hace click sobre los mismos se desabiliten
* También se obtienen los botones que invocan modales para confirmar acciones
* para que los mismos se desabiliten cuando se confirma la acción. 
*/
function desabilitarBotonesModEli(){
  var botones = $(".btnAccionCrud");
  //se recorren los botones porque no se obtiene solo uno. 
  for (var i = botones.length - 1; i >= 0; i--) {
    botones[i].disabled = true;
    alert(botones[i].value);
  }
  var botones2 = $(".btnModal");
  for (var i = botones2.length - 1; i >= 0; i--) {
    botones2[i].className = "waves-effect waves-light btn modal-trigger activeHref";
    alert(botones2[i].value);
  }
}

/*aqui se encuentra el paginador de las tablas*/
 $(document).ready(function(){
        $("#MostrarSevri").paginationTdA({
            elemPerPage: 4
        });
    });

/*aqui finalisa*/
/*filtrado de tablas*/
$(document).ready(function () {
    (function ($) {

        $('#datosSevri').keyup(function () {
            
            var rex = new RegExp($(this).val(), 'i');
            $('.buscar tr').hide();
            $('.buscar tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
/*fin filtrado*/

//function que oculta el tooltip
function ocultarTooltip(){
  var tooltip= document.getElementById('boton');
  tooltip.style.display="none";
}

// validacion del formulario de insertar SEVRI
$(document).ready(function() {
      $("#IcrearSevri").validate({
          rules: {
              nombre: { required: true, minlength: 13, maxlength: 100},
              fecha: { required: true}
          },
          messages: {
              nombre: "Se debe ingresar un nombre con un mínimo de 13 caracteres y máximo de 100.",
              fecha: "Se debe seleccionar una fecha mayor o igual a la fecha actual."
          },
          submitHandler: function(form){
             insertarSevri();
          }
      });
  });
   $(document).ready(function() {
       Materialize.updateTextFields();
   });
   $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
   });

//validacion de modificar SEVRI 
$(document).ready(function() {
      $("#actualizarSevri").validate({
          rules: {
              nombre: { required: true, minlength: 5, maxlength: 100},
              fecha: { required: true}
          },
          messages: {
              nombre: "Se debe ingresar un nombre con un mínimo de 13 caracteres y máximo de 100.",
              fecha: "Se debe seleccionar una fecha mayor o igual a la fecha actual."
          },
          submitHandler: function(form){
             actualizarSevri();
          }
      });
    });
    
    $(document).ready(function(){
        $('.modal-trigger').leanModal();
      });