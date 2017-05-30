function actualizarTablaAgregar(){
	var idSevri = document.getElementById("sevri").value;
	var idDepa = document.getElementById("departamento").value;
	var tabla = document.getElementById("tabla");

	if(tabla!=null){
		if(idSevri == 0 && idDepa != 0){//combo depa seleccionado
			for(j=1;j<tabla.rows.length;j++){
					if(document.getElementById("tr"+j).cells[1].childNodes[0].nodeValue==idDepa){
						document.getElementById("tr"+j).style.display = "";
					}else{
						document.getElementById("tr"+j).style.display = "none";
					}
				}
		}else if(idSevri != 0 && idDepa == 0){//combo sevri seleccionado
			for(j=1;j<tabla.rows.length;j++){
	   			if(document.getElementById("tr"+j).cells[0].childNodes[0].nodeValue==idSevri){
	   				document.getElementById("tr"+j).style.display = "";
	   			}else{
	   				document.getElementById("tr"+j).style.display = "none";
	   			}
	   		}
		}else if(idSevri != 0 && idDepa != 0){//ambos combos seleccionados
			for(j=1;j<tabla.rows.length;j++){
	   			if(document.getElementById("tr"+j).cells[0].childNodes[0].nodeValue==idSevri && document.getElementById("tr"+j).cells[1].childNodes[0].nodeValue==idDepa){
	   				document.getElementById("tr"+j).style.display = "";
	   			}else{
	   				document.getElementById("tr"+j).style.display = "none";
	   			}
			}
		}else if(idSevri == 0 && idDepa == 0){//ambos des desleccionados
			for(j=1;j<tabla.rows.length;j++){
					document.getElementById("tr"+j).style.display = "none";
				}
		}
	}
}