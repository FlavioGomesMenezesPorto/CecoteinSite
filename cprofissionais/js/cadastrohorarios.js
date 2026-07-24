function verificacadhorario(){
	if(cadastrohorario.nome.value==""){
		alert("Campo Nome está em branco favor preenche-lo");
		cadastrohorario.nome.focus();
		return false;
	}else{
				if(cadastrohorario.inicio.value==""){
					alert("Campo INICIO está em branco favor preenche-lo");
					cadastrohorario.inicio.focus();
					return false;
				}else{
						if(cadastrocliente.termino.value==""){
							alert("Campo TERMINO está em branco favor preenche-lo");
							cadastrohorario.endereco.focus();
							return false;
						}
				}

	}

}

function sonumeros(){
	tecla = event.keyCode;
	if (tecla >= 48 && tecla <= 57){
    	return true;
    }
	else{
		alert("Digite apenas números");
    	return false;
    }
}

function soletras(){
	tecla = event.keyCode;
	if (tecla >= 48 && tecla <= 57){
    	alert("Digite apenas letras");
    	return false;
    }
	else{
		return true;
    }
}

function verificacpf(){
	if (cadastrocliente.cpf.length<11){
    		alert("Insira cpf com 11 Digitos");
    		return false;
    	}else{
		return true;
		
    	}
}