function verificacadcliente(){
	if(cadastrocliente.nome.value==""){
		alert("Campo Nome está em branco favor preenche-lo");
		cadastrocliente.nome.focus();
		return false;
	}else{
				if(cadastrocliente.cpf.value==""){
					alert("Campo CPF está em branco favor preenche-lo");
					cadastrocliente.cpf.focus();
					return false;
				}else{
						if(cadastrocliente.endereco.value==""){
							alert("Campo Endereço está em branco favor preenche-lo");
							cadastrocliente.endereco.focus();
							return false;
						}else{
									if(cadastrocliente.numero.value==""){
										alert("Campo Numero está em branco favor preenche-lo");
										cadastrocliente.numero.focus();
										return false;
									}else{
											if(cadastrocliente.bairro.value==""){
												alert("Campo Bairro está em branco favor preenche-lo");
												cadastrocliente.bairro.focus();
												return false;
											}else{
														if(cadastrocliente.cidade.value==""){
															alert("Campo Cidade está em branco favor preenche-lo");
															cadastrocliente.cidade.focus();
															return false;
														}else{
																	if(cadastrocliente.senha.value==""){
																			alert("Campo Senha está em branco favor preenche-lo");
																			cadastrocliente.senha.focus();
																			return false;
																	}
														}
											}

									}
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