function agregarNivelesRiesgo(){
	
	var nivelesRiesgoJSON = JSON.stringify(crearLiNivRiesgoInsertar());
	var formData = new FormData();
    formData.append("opcion", 1);
    formData.append("nivelesRiesgoJSON", nivelesRiesgoJSON);
    $.ajax({
        url : "../controladora/ctrNivelRiesgo.php",
        type : "post",
        dataType : "",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
    	cargarPagina('../interfaz/INivelRiesgo/IMostrarNivelRisgoAuxiliar.php');
    	Materialize.toast(data, 7000,'blue darken-3');
    });
}

function modificarNivelesRiesgo(){
	
	var nivelesRiesgoJSON = JSON.stringify(crearLiNivRiesgoModificar());
	var formData = new FormData();
    formData.append("opcion", 4);
    formData.append("nivelesRiesgoJSON", nivelesRiesgoJSON);
    $.ajax({
        url : "../controladora/ctrNivelRiesgo.php",
        type : "post",
        dataType : "",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
    	cargarPagina('../interfaz/INivelRiesgo/IMostrarNivelRisgoAuxiliar.php');
    	Materialize.toast(data, 7000,'blue darken-3');
    });
}

function eliminarNivelRiesgo(){
	var formData = new FormData();
	var idDivision = document.getElementById('idDivision').value;
    formData.append("opcion", 5);
    formData.append("idDivision", idDivision);
    $.ajax({
        url : "../controladora/ctrNivelRiesgo.php",
        type : "post",
        dataType : "",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
    	cargarPagina('../interfaz/INivelRiesgo/IMostrarNivelRisgoAuxiliar.php');
    	Materialize.toast(data, 7000,'blue darken-3');
    });
}

function pasarIdParaEliminarNivel(id){
	document.getElementById('idDivision').value = id;
}

function crearLiNivRiesgoInsertar(){
	var cantidadFilas = document.getElementById('tablaInsertarDivisiones').rows.length-1;
	var porcentajeInicial = 0;
	var porcentajeFinal = 0;
	var idElementos;
	var nivelesRiesgo = new Array();
	for (var i = 0; i < cantidadFilas; i++) {
		var descriptor;
		var descripcion;
		var color;
		var limite;

		if(i == 0){
			porcentajeFinal = (100/cantidadFilas);
		}else{
			porcentajeInicial = porcentajeFinal;
			porcentajeFinal = (100/cantidadFilas) + porcentajeInicial;
		}

		limite = Math.round(porcentajeFinal);
		idElementos = "input1"+i;
		descriptor = document.getElementById(idElementos).value;

		idElementos = "input2"+i;
		descripcion = document.getElementById(idElementos).value;

		idElementos = "input3"+i;
		color = document.getElementById(idElementos).value;

		var nivelRiesgo = new Object();
		nivelRiesgo.descriptor = descriptor;
		nivelRiesgo.descripcion = descripcion;
		nivelRiesgo.colorAsociado = color;
		nivelRiesgo.limite = limite;
		nivelesRiesgo[i] = nivelRiesgo;
	}
	return nivelesRiesgo;
}

function crearLiNivRiesgoModificar(){
	var cantidadFilas = document.getElementById('tablaModificarDivisiones').rows.length-1;
	var idElementos;
	var nivelesRiesgo = new Array();
	for (var i = 0; i < cantidadFilas; i++) {
		var descriptor;
		var descripcion;
		var color;
		var id;

		idElementos = "input01"+i;
		descriptor = document.getElementById(idElementos).value;

		idElementos = "input02"+i;
		descripcion = document.getElementById(idElementos).value;

		idElementos = "input03"+i;
		color = document.getElementById(idElementos).value;

		idElementos = "inputId"+i;
		id = document.getElementById(idElementos).value;

		var nivelRiesgo = new Object();
		nivelRiesgo.descriptor = descriptor;
		nivelRiesgo.descripcion = descripcion;
		nivelRiesgo.colorAsociado = color;
		nivelRiesgo.idNivel = id;
		nivelesRiesgo[i] = nivelRiesgo;
	}
	return nivelesRiesgo;
}

function crearEliminarFilas(){
	var divisiones = document.getElementById('divisiones').value;
	var porcentajeInicial = 0;
	var porcentajeFinal = 0;

	for(var x = document.getElementById('tablaInsertarDivisiones').rows.length-1; x > 0; x--){
		document.getElementById('tablaInsertarDivisiones').deleteRow(x);
	}
	for(var i = 0; i < divisiones; i++){
		if(i == 0){
			porcentajeFinal = (100/divisiones);
			crearTr("0", Math.round(porcentajeFinal), "selectColor"+i, "divColor"+i, i);
		}else{
			porcentajeInicial = porcentajeFinal;
			porcentajeFinal = (100/divisiones) + porcentajeInicial;
			crearTr(Math.round(porcentajeInicial), Math.round(porcentajeFinal), "selectColor"+i, "divColor"+i, i);
		}
	}
	$( document ).ready(function(){
        $('select').material_select();
    });
}

function seleccionarColor(){
	alert("Id del select");
    //document.getElementById('divColor').style.background=$color;
}

function crearTr(porcentajeInicial, porcentajeFinal, idSelect, idDiv, idInput){
	var nuevaFila = document.createElement('tr');
	nuevaFila.appendChild(crearTd(porcentajeInicial));
	nuevaFila.appendChild(crearTd(porcentajeFinal));

	var input1 = crearTd(false);
	input1.appendChild(crearInput("input1"+idInput));
	nuevaFila.appendChild(input1);

	var input2 = crearTd(false);
	input2.appendChild(crearInput("input2"+idInput));
	nuevaFila.appendChild(input2);

	var input3 = crearTd(false);
	input3.appendChild(crearInputColor("input3"+idInput));
	nuevaFila.appendChild(input3);

	document.querySelector('#tablaInsertarDivisiones tbody').appendChild(nuevaFila);
}


function crearTd(valor){
	var td = document.createElement('td');
	if(valor) {
		td.innerText = valor + "%";
	}
	return td;
}

function crearInput(idInput){
	var input = document.createElement('input');
	input.type = 'text';
	input.id = idInput;
	input.className= "datoInput";
	return input;
}

function crearInputColor(idInput){
	var input = document.createElement('input');
	input.type = 'color';
	input.id = idInput;
	input.className= "datoInput";
	return input;
}

function cargarGuiAgregarNivelRiesgo(idDivicion){
	if(idDivicion != 0){
		$('#mostrarDatos').load("../interfaz/INivelRiesgo/IAgregarNivelRiesgo.php?idDivicion="+idDivicion);
	}
}
// metodo jqwery que valida si hay campos vacios en el insertar.
 function validarFormularioInsertar(){
 	var vacio = false;
	       $("#tablaInsertarDivisiones").find(".datoInput").each(function () {
	                valor = $(this).val();    
	                if (valor == '') {  
	                   vacio = true;                  
	                   return false;
	                }         
	        });
	       if(vacio){
	       		 Materialize.toast("Hay espacios en blanco que deben ser llenados", 7000,'blue darken-3');
	       }else{
	       		agregarNivelesRiesgo();
	       }
 }
 // metodo jqwery que valida si hay campos vacios en el modificar.
 function validarFormularioModificar(){
 
 	var vacio = false;
	       $("#tablaModificarDivisiones").find(".datoInput").each(function () {
	                valor = $(this).val();  
	                if (valor == '') {  
	                   vacio = true;                  
	                   return false;
	                }         
	        });
	       if(vacio){
	       		 Materialize.toast("Hay espacios en blanco que deben ser llenados", 7000,'blue darken-3');
	       }else{
	       		modificarNivelesRiesgo();
	       }
 }      
function AgregarNivelRiesgo(valor){
	var formData = new FormData(); 
    formData.append("opcion", 2);
    formData.append("id", valor);
    $.ajax({
        url : "../controladora/ctrNivelRiesgo.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        var respuesta = eval(data);
        var seInserto;
        var mensaje;

        for(var i in respuesta){
          seInserto = respuesta[i].inserto;
          mensaje = respuesta[i].mensaje;
        }
        Materialize.toast(mensaje, 7000,'blue darken-3');
        if(seInserto == 1){
        	pasarTablaAgregado(valor);
        	document.getElementById('btnAgregarNivel').disabled = true;
        }
    });
}

function pasarTablaAgregado(idDivicion){
	var nombre= $("#nRiesgo option:selected").text();
	var tr = document.createElement('tr');

	var td1 = document.createElement('td');
	td1.innerText = idDivicion;

	var td2 = document.createElement('td');
	td2.innerText = nombre;

	var td3 = document.createElement('td');
	td3.appendChild(crearBotonDescartar(idDivicion));

	tr.appendChild(td1).style.display = 'none';
	tr.appendChild(td2);
	tr.appendChild(td3);
	document.querySelector('#tbNivelRiesgoAgregado tbody').appendChild(tr);
}

function crearBotonDescartar(idDivicion){
	var btn = document.createElement('button');
	btn.innerText='Descartar';
	btn.className = 'btn';
	btn.onclick = descartarNivelRiesgo;
	return btn;
}

function descartarNivelRiesgo(idDivicion){
	var idElemento;
	 if(idDivicion > 0){
	 	idElemento = idDivicion;
	 }else{
	 	var row = this.parentNode.parentNode;
	 	var cells = row.querySelectorAll('td:not(:last-of-type)');
	 	idElemento = cells[0].innerText;
	 }
  	var formData = new FormData(); 
    formData.append("opcion", 3);
    formData.append("id", idElemento);
    $.ajax({
        url : "../controladora/ctrNivelRiesgo.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        var respuesta = eval(data);
        var seElimino;
        var mensaje;

        for(var i in respuesta){
          seElimino = respuesta[i].elimino;
          mensaje = respuesta[i].mensaje;
        }
        Materialize.toast(mensaje, 7000,'blue darken-3');
        if(seElimino == 1){	
	 		document.getElementById('tbNivelRiesgoAgregado').deleteRow(1);
	 		document.getElementById('btnAgregarNivel').disabled = false;
        }
    });
}

function cargarGuiMostrarNivelRiesgo(idDivicion){
	if(idDivicion != 0){
		$('#mostrarDatos2').load("../interfaz/INivelRiesgo/IMostrarNivelRiesgo.php?id="+idDivicion);
	}
}

function invocarDivModificarNivel(){
	document.getElementById('contenedorFormModificarNiveles').style.display = '';
}