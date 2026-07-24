// JavaScript Document

// função de adicionar máscaras

function mascara(src, mask)
{
	var i = src.value.length;
	var saida = mask.substring(0,1);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida)
	{
		src.value += texto.substring(0,1);
	}
}

function mascara_tel(src, mask)
{
	var i = src.value.length;
	var saida = mask.substring(1,2);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida)
	{
		src.value += texto.substring(0,1);
	}
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
    if(mascaraInteiro(cpf)==false){
        event.returnValue = false;
    }    
    return formataCampo(cpf, '999.999.999-99', event);
}

//valida numero inteiro com mascara
function mascaraInteiro(){
    if (event.keyCode < 48 || event.keyCode > 57){
        event.returnValue = false;
        return false;
    }
    return true;
}

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) { 
    var boleanoMascara; 
    
    var Digitato = evento.keyCode;
    exp = /\-|\.|\/|\(|\)| /g
    campoSoNumeros = campo.value.toString().replace( exp, "" ); 
   
    var posicaoCampo = 0;     
    var NovoValorCampo="";
    var TamanhoMascara = campoSoNumeros.length;; 
    
    if (Digitato != 8) { // backspace 
        for(i=0; i<= TamanhoMascara; i++) { 
            boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
                                || (Mascara.charAt(i) == "/")) 
            boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
                                || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
            if (boleanoMascara) { 
                NovoValorCampo += Mascara.charAt(i); 
                  TamanhoMascara++;
            }else { 
                NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
                posicaoCampo++; 
              }            
          }     
        campo.value = NovoValorCampo;
          return true; 
    }else { 
        return true; 
    }
}

//validação do campo CPF
function ValidarCPF(Objcpf){
    var cpf = Objcpf.value;
	 if(cpf==""){
		alert("Por favor digite um CPF");
		return false;
	}
    exp = /\.|\-/g
    cpf = cpf.toString().replace( exp, "" ); 
    var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
    var soma1=0, soma2=0;
    var vlr =11;
    
    for(i=0;i<9;i++){
        soma1+=eval(cpf.charAt(i)*(vlr-1));
        soma2+=eval(cpf.charAt(i)*vlr);
        vlr--;
    }    
    soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
    soma2=(((soma2+(2*soma1))*10)%11);
    
    var digitoGerado=(soma1*10)+soma2;
    if(digitoGerado!=digitoDigitado)
        alert('CPF Invalido!');  
	//document.formContato.CPF.SetFocus();  
	       
}


//adiciona mascara de data
function MascaraData(data){
    if(mascaraInteiro(data)==false){
        event.returnValue = false;
    }    
    return formataCampo(data, '##-##-####', event);
}

//valida cep
function MascaraCep(cep){
        if(mascaraInteiro(cep)==false){
        event.returnValue = false;
    }    
    return formataCampo(cep, '99.999-999', event);
}

function ValidaEmail(email){

    exp =/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/
    if(!exp.test(email.value))
        return false;             

}

//Função que valida email 
function  TestandoEmail( string )
{
	 var indice = 0;
	 var ponto = 0;
	 //alert('Entrou na função!');
	 
	 indice = string.value. lastIndexOf("@");
	 ponto = string.value. lastIndexOf(".");
	 
	 //alert(indice);
	 if ((indice == -1 ) || (ponto == -1 ))
	 {
		alert(' Campo email inválido, por favor digite-o novamente!');
		//alert(document.getElementById(mail));
		document.formContato.mail.focus();
	 }
	 else
	 {
	 	if ( indice > ponto )
		{
		   alert(' Campo email inválido, por favor digite-o novamente!');
		   //alert(document.getElementById(mail));
		   document.formContato.mail.focus();
	    }
	}
}

//Função que valida email - para cadastro 
function  TestandoEmailCad( string )
{
	 var indice = 0;
	 var ponto = 0;
	 //alert('Entrou na função!');
	 indice = string.value. lastIndexOf("@");
	 ponto = string.value. lastIndexOf(".");
	 //alert(indice);
	 if ((indice == -1 ) || (ponto == -1 ))
	 {
		alert(' Campo email inválido, por favor digite-o novamente!');
		//alert(document.getElementById(email));
		document.cadastrocliente.mail.focus();
	 }
	 else
	 {
	 	if ( indice > ponto )
		{
		   alert(' Campo email inválido, por favor digite-o novamente!');
		   //alert(document.getElementById(mail));
		   document.cadastrocliente.mail.focus();
	    }
	}
		
}

function ValidaCivil(CIVIL){
	
	var cont=0,i;
		
	for (i=0;i<=5;i++){
	
		if (document.formulario.CIVIL[i].checked){
			cont=cont+1;	
					
	    }
		
		}	 
		if (cont==0){
			alert("Escolhe uma opcao.");
			return false;
		}  
}

function ValidaDocumento(){
	
	var i,cont1=0;
		
	for (i=0;i<=3;i++){
		
		if (document.formulario.documento[i].checked)
			cont1=cont1+1;		
		
		
		}
		if (cont1==0){
			alert("Ecolhe ao menos uma opcao.");
			return false;
	}	   
}

function TestaData(data)
{
	//alert('entrou na função');
	var dt = '0' ;
	var index = 0;
	var ano = '0';
	var limite = 0;
	var dia = '0';
	var now = '0';
	
	//var data = new date("December 25, 1995 23:15:00");
	//var now = data.getFullYear();  //retorna o ano da data atual
		
	index = data.value.indexOf('-');
	dt = data.value.substr(index+1, 2);
	index = data.value.lastIndexOf('-');
	ano = data.value.substr(index+1,4);
	dt = parseInt(dt, 10); // converte a variável dt para inteiro
	ano = parseInt(ano, 10); // converte a variável ano para inteiro
    //now = parseInt(now, 10);
	
	var dia = new Date();  
	now = dia.getFullYear();  //retorna o ano da data atual
	limite = now + 20; // controla até quantos anos no futuro o usuário poderá ir
	
	if (( dt > 12 ) || ( dt < 1 ))
	{
		alert('Data inválida!');
		document.data.dt.focus();
	}
	else
	{
		if (( ano > limite ) || ( ano < 1970 ))	
		{
			alert('Data não suportada pelo banco de dados!');
			document.data.dt.focus();
		}  
	}	
}


function TestaData1(data)
{
	//alert('entrou na função');
	var dt = '0' ;
	var index = 0;
	var ano = '0';
	var limite = 0;
	var dia = '0';
	var now = '0';
	
	//var data = new date("December 25, 1995 23:15:00");
	//var now = data.getFullYear();  //retorna o ano da data atual
		
	index = data.value.indexOf('/');
	dt = data.value.substr(index+1, 2);
	index = data.value.lastIndexOf('/');
	ano = data.value.substr(index+1,4);
	dt = parseInt(dt, 10); // converte a variável dt para inteiro
	ano = parseInt(ano, 10); // converte a variável ano para inteiro
    //now = parseInt(now, 10);
	var dia = new Date();  
	now = dia.getFullYear();  //retorna o ano da data atual
	limite = now - 150;
	
	if (( dt > 12 ) || ( dt < 1 ))
	{
		alert('Data inválida!');
		document.cadastroprofissional.nasc.focus();
	}
	else
	{
		if (( ano >= now ) || ( ano < limite ))
		{
			alert('Data inválida!');
			document.cadastroprofissional.nasc.focus();
		}  
	}
}

function ValidaNaturalidade(NATURALIDADE){
	
	if(document.formulario.NATURALIDADE.value==''){
		return false;
	}	
}

function ValidaNome(NOME){
	if((document.formulario.NOME.value=="") || (document.formulario.NOME.value==" ")){
		return false;
	}
}
//chama todas as funções 
function acionador_funcoes(){
 
if (ValidarCPF(formulario.CPF)==false){
  return false;}  
  
 if ( ValidaNome(formulario.NOME) == false){
   alert("Digite um nome!");
   return false;}
    
 if (ValidaNaturalidade(formulario.NATURALIDADE) == false){
   alert("Selecione um Estado.");
   return false;}
 
 if (formulario.NASCIMENTO.value == ""){
	alert("Por Favor digite uma data!");
	return false;}
   
 if (ValidaCivil(formulario.CIVIL) == false){
   return false;}

  if (ValidaDocumento() == false){
   return false;}
   
   if (ValidaEmail(formulario.Email) == false){
   alert('Email Invalida!');
   return false;}  

  return true;
  
}
