$(document).ready(function(){
	$("#inicioSesion").validate({
        rules: {
            usuario: { required: true, minlength: 9, maxlength: 15},
            clave: { required: true,minlength: 8, maxlength: 15}
        },
        messages: {
            usuario: "Extención minima de 9 digitos y maxima de 15",
            clave: "Extención minima de 8 digitos y maxima de 15"
        },
        submitHandler: function(form){
           if(usurioExiste()){
           	  form.submit();
           }else{
           	 Materialize.toast("El usuario o la contraseña son incorrectos", 7000,'blue darken-3');
           }
        }
	});	
});

function usurioExiste(){
    //document.getElementById('barraCargando').style.display="";
     var nombre = "";
     var apellido = "";
     var tipo = "";
     var existe2=false;
    var formData = new FormData(document.getElementById("inicioSesion")); 
    formData.append("opcion",6);
    $.ajax({
    url : "controladora/ctrUsuarios.php",
    type : "post",
    dataType : "html",
    async:false,
    data : formData,
    cache : false,
    contentType : false,
    processData : false
    }).done(function(data) {
     var dataJson = eval('(' + data + ')');
     if(dataJson['existe'] == true){
	   	 nombre = dataJson['nombre'];
	     apellido = dataJson['apellido'];
	     tipo = dataJson['tipo'];
	     existe2 = dataJson['existe'];   
     }
     if(existe2){
     	var MNombre= document.getElementById('nombre');
     	var MApellido=document.getElementById('apellido');
     	var MTipo=document.getElementById('tipo');
     	MNombre.value = nombre;
     	MApellido.value=apellido;
		MTipo.value=tipo;
     }
       
    }); 

    return existe2; 
}
