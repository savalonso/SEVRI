function insertarAnalisis(){
    var formData = new FormData(document.getElementById("IAnalisisRiesgo"));
    formData.append("opcion", 1);
    $.ajax({
        url : "../controladora/ctrAnalisis.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IAnalisis/IMostrarAnalisisRiesgo.php');
        Materialize.toast(data, 7000,'blue darken-3');
    });
}

function obtenerValorFurmula(maximaProbabilidad, maximoImpacto){
    var resultado = 100 / ((maximoImpacto*maximaProbabilidad)/1);
    return resultado;
} 

function crearNivelRiesgo(maximaProbabilidad, maximoImpacto){
    var tabla = document.getElementById('tbNivelesRiesgoOcultos');
    var filas = "";
    var limite = "";
    var color = "";
    var descriptor = "";
    var limiteInicial = 0;
    var valorImpacto= document.getElementById('valorImpactoSeleccionado').value;
    var valorProbabilidad= document.getElementById('valorProbabilidadSeleccionado').value;
    var valorFormula = obtenerValorFurmula(maximaProbabilidad, maximoImpacto);
    var resultadoOperacion = Math.round((valorImpacto * valorProbabilidad)/1 * valorFormula);
    for(var i = 0; i < tabla.rows.length; i++){
        filas = tabla.rows[i].getElementsByTagName('td');
        limite = filas[0].innerHTML;
        if((i < (tabla.rows.length-1) && resultadoOperacion >= limiteInicial && resultadoOperacion <= (limite-1)) || (i == (tabla.rows.length - 1) && resultadoOperacion >= limiteInicial)){
            color = filas[3].innerHTML;
            descriptor = filas[1].innerHTML;
            document.getElementById('visualizadorNivelRiesgo').innerHTML = resultadoOperacion + ": " + descriptor;
            document.getElementById('visualizadorNivelRiesgo').style.background = color;
        }
        limiteInicial = limite;
    }
}

function paginaModificarAnalisis(IdAnalisis){     
    $('#contenedor').load("../../interfaz/IAnalisis/IModificarAnalisis.php?IdAnalisis="+IdAnalisis);
}

function modificarAnalisis(){
    var formData = new FormData(document.getElementById('IModificarAnalisis'));
    formData.append("opcion", 2);
    $.ajax({
        url : "../controladora/ctrAnalisis.php",
        type : "post",
        dataType : "html",
        data : formData,
        cache : false,
        contentType : false,
        processData : false
    }).done(function(data) {
        cargarPagina('../interfaz/IAnalisis/IMostrarAnalisisRiesgo.php');
        Materialize.toast(data, 7000,'blue darken-3');
    });
    }

    function eliminarAnalisis(idAnalisisForm){
        var idAnalisis = idAnalisisForm;
        var formData = new FormData(); 
        formData.append("opcion", 3);
        formData.append("idAnalisis", idAnalisis);
        $.ajax({
            url : "../controladora/ctrAnalisis.php",
            type : "post",
            dataType : "html",
            data : formData,
            cache : false,
            contentType : false,
            processData : false
        }).done(function(data) {
            cargarPagina('../interfaz/IAnalisis/IMostrarAnalisisRiesgo.php');
            Materialize.toast(data, 7000,'blue darken-3');
        });
    }