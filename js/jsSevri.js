function recorrerSelect(){
   // var select = document.getElementById('selectDepartamentos');
    $("#selectDepartamentos option:selected").each(function(){
        alert('opcion '+$(this).text()+' valor '+ $(this).attr('value'))
    });
}

function insertarSevri(){

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
  });    
}

function desactivarSevri(idSevri){
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
  });    
}

function agregarParametros(desicion, formulario, tabla){
    var formData = new FormData(document.getElementById(formulario)); 
    if(desicion == 1){
        var parametros = recorrerTabla(4, tabla);
        formData.append("cantidadParametros", parametros.length);
        for (var i = 0; i < parametros.length; i++) {
           formData.append("parametros"+i, parametros[i]);
        }
        formData.append("opcion", 2);
    }
    else if(desicion == 2){
        var categorias = recorrerTabla(2, tabla);
        formData.append("cantidadCategorias", categorias.length);
        for (var i = 0; i < categorias.length; i++) {
           formData.append("categorias"+i, categorias[i]);
        }
        formData.append("opcion", 3);
    }
    else{
        formData.append("opcion", 4);
    }
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
    });     
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
    });    
}

function eliminarSevri(){
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

function agregarEliminarParametroSevri(id, opcion, idColumna, desicion, fila, posicion, nombre){

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
  document.querySelector('#tbCategoriasAgregadas tbody').removeChild(row);

  var cells = row.querySelectorAll('td:not(:last-of-type)');
  var idFila = cells[3].innerText;
  var idCategoria = cells[2].innerText;

  agregarEliminarParametroSevri(idCategoria,10, idFila, 4);
}

function removerDepartamentos() {
  var row = this.parentNode.parentNode;
  document.querySelector('#tbDepartamentosAgregadas tbody').removeChild(row);

  var cells = row.querySelectorAll('td:not(:last-of-type)');
  var idFila = cells[3].innerText;
  var idDepartamento = cells[2].innerText;

  agregarEliminarParametroSevri(idDepartamento,12, idFila, 4);
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
/*aqui se encuentra el paginador de las tablas*/
 $(document).ready(function(){
        $("#MostrarSevri").paginationTdA({
            elemPerPage: 4
        });
    });
/*aqui finalisa*/