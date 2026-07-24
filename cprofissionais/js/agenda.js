function obs(){
	if(agenda.obs.value==""){
		alert("Campo Observação está em branco favor preenche-lo");
		agenda.obs.focus();
		return false;
	}
}