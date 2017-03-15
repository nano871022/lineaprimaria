function onFormulario(objeto){
   if(objeto.tagName.toUpperCase() == "BODY"){
		return null;
	}
   if(objeto.tagName.toUpperCase() == "FORM"){
		objeto.submit();
	}else{
		onFormulario(objeto.parentElement);
	}
}
