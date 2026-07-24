function verificacadprofissional(){
	if(cadastroprofissional.nome.value==""){
		alert("Campo Nome está em branco favor preenche-lo");
		cadastroprofissional.nome.focus();
		return false;
	}else{
				if(cadastroprofissional.cpf.value==""){
					alert("Campo CPF está em branco favor preenche-lo");
					cadastroprofissional.cpf.focus();
					return false;
				}else{
						if(cadastroprofissional.endereco.value==""){
							alert("Campo Endereço está em branco favor preenche-lo");
							cadastroprofissional.endereco.focus();
							return false;
						}else{
									if(cadastroprofissional.numero.value==""){
										alert("Campo Numero está em branco favor preenche-lo");
										cadastroprofissional.numero.focus();
										return false;
									}else{
											if(cadastroprofissional.bairro.value==""){
												alert("Campo Bairro está em branco favor preenche-lo");
												cadastroprofissional.bairro.focus();
												return false;
											}else{
														if(cadastroprofissional.cidade.value==""){
															alert("Campo Cidade está em branco favor preenche-lo");
															cadastroprofissional.cidade.focus();
															return false;
														}else{
																	if(cadastroprofissional.senha.value==""){
																			alert("Campo Senha está em branco favor preenche-lo");
																			cadastroprofissional.senha.focus();
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
	if (cadastroprofissional.cpf.length<11){
    		alert("Insira cpf com 11 Digitos");
    		return false;
    	}else{
		return true;
		
    	}
}