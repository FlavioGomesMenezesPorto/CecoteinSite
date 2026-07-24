<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Adquira sua agenda </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/lista.css" type="text/css" rel="stylesheet">
        <script src="../funcoes/mascaras.js"> </script>
	</head>	
    <!-- #################################################################################### -->
	<body>
        <div class="principal">
            <div id="cabeca" >
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a>
            </div>
            
            <div id="flash" >
                  <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu_teste.html");
				?>
            </div>	
            <?php 
				session_start();
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;
			?>
            
            <div id="menu">
            	<?php include '../funcoes/menu.php' ?>
            </div>
             <?php //include '../funcoes/funcoes.php' ?>
            <div id="corpo"	>
            	<p align="right"><a href="javascript:history.back(1);"> <input type="button" value="Voltar" style="margin-bottom:5; margin:5 0 0 0; vertical-align: top"></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </p>
                <center>
                    <form action="../principais/adquira_envia.php" method="post" name="formContato">
                      <br>
                       <table name="pedido" align="right" cellspacing="2" cellpadding="2">
                            <tr>
                            	 <td colspan="2" style="background-color: #66CDAA ;color: #008B8B;"> <b> Formulário para pedido do site Cprofissionais </b> </font> </td>
                                 <td> </td>
                            </tr>
                            <tr> 
                               <td>	<b> <font color="#FFFFFF">  Nome: </font> </b> </td>
                               <td> <input type="text" name="nome" size="74" > </td>
                            </tr>
                            <tr>
                               <td>  <b> <font color="#FFFFFF"> RG ou inscrição: </font> </b> </td>
                               <td> <input type="text" name="rg" size="25" > <b> <font color="#FFFFFF"> CPF/CNPJ: </font> </b> <input type="text" name="cpf" id="CPF" size="27" maxlength="14" onBlur="ValidarCPF( this );"  onKeypress="mascara(this, '###.###.###-##')"> </td>
                             </tr>
                             <tr>
                               <td>  <b> <font color="#FFFFFF"> Razão Social: </font>  </b></td>
                               <td> <input type="text" name="razao" size="74" > </td>
                             </tr>
                             <tr> 
                                <td>  <b> <font color="#FFFFFF"> &nbsp Logradouro: &nbsp </font> </b> </td>
                                <td> <input type="text" name="logradouro" size="74" >	</td>
                             </tr>
                             <tr>
                                 <td>  <b> <font color="#FFFFFF"> Bairro: </font> </b> </td>
                                 <td> <input type="text" name="bairro" size="74" > </td>
                             </tr>
                             <tr>
                                 <td> <b> <font color="#FFFFFF"> Cidade: </font> </b> </td>
                                 <td> <input type="text" name="cidade" size="74" > </td>
                             </tr>
                             <tr>
                                  <td>  <b> <font color="#FFFFFF"> UF: </font> </b> </td>
                                  <td> <input type="text" name="uf" size="28" > <b> <font color="#FFFFFF">&nbspCEP:&nbsp </font> </b>  <input type="text" name="cep" size="30" maxlength="9" onKeyPress="mascara( this , '#####-###')"></td>          
                             </tr>
                             <tr>
                                <td>  <b> <font color="#FFFFFF"> Email: </font> </b></td> 
                                <td><input type="text" name="email" id="mail" size="74" onBlur="TestandoEmail(this);"> </td>
                             </tr>
                             <tr>
                                <td>  <b> <font color="#FFFFFF"> Telefone: </font> </b> </td>
                                <td> <input type="text" name="tel" size="28" maxlength="13" onKeypress="mascara_tel(this,'(##)####-####')"> <b> <font color="#FFFFFF"> Celular: </font> </b> <input type="text" name="cel" maxlength="13" size="28" onKeypress="mascara_tel(this, '(##)####-####')"> </td>
                            </tr>
                            <tr>
                               <td> <b> <font color="#FFFFFF"> Mensagem: </font> </b> </td>
                               <td> <textarea rows="6" cols="76" name="mensagem" style="font-family:Arial"></textarea> </td>
                           </tr>
<!-- LUIZ 09/12/21 -->
                          <tr>
                            <td colspan="2">
                              <font color="#FFFFFF">Para proseguir, digite os caracteres da imagem: </font>
                            </td>
                          </tr>
                          <tr>
                            <td><p> </p></td>
                          </tr>
                          <tr>
                            <td colspan="" style="width: 50%"> 
                              <img src="/cprofissionais/imagens/cap.bmp" width="100%"> 
                            </td>
                            <td colspan="" align="center"> 
                              <input type="text" name="captcha" id="captcha" size="12" required>
                              <input type="button" onclick="validaCaptcha()" name="btnConfereCaptcha" value="Conferir">
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" style="font-size: 16px; display: none;" id="msgErroCaptcha">
                              <font color="#FF0000">Texto incorreto, tente novamente</font>
                            </td>
                          </tr>
                          <script type="text/javascript">
                                  var captcha = document.getElementById("captcha");

                                  function validaCaptcha(){
                                    if (captcha.value == "w68hp" || captcha.value == "W68HP") {
                                      document.getElementById("btnEnviar").disabled = false;
                                      document.getElementById("msgErroCaptcha").style.color = "00FF00";
                                      document.getElementById("msgErroCaptcha").innerHTML = "Texto correto, clique em enviar";
                                      document.getElementById("msgErroCaptcha").style.display = "block";
                                    } 
                                    else {
                                      captcha.value = "";
                                      captcha.focus();
                                      document.getElementById("msgErroCaptcha").style.display = "block";
                                      
                                    }
                                  }

                                </script>
                          <tr>
                            <td><p> </p></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>
                              <div>
                                <input type="submit" name="enviar" id="btnEnviar" value="Enviar" disabled="true">
                                <input type="reset" name"Cancelar" value="Cancelar">
                              </div></td>
                          </tr>
<!-- LUIZ 09/12/21 FIM
                           <tr>
                             <td> </td>
                             <td>  <center> 
                             	<input type="submit" name="enviar" value="Enviar" style="margin-bottom:5; margin:5 0 0 0; vertical-align: top"> 
                                <input type="reset" name"limpar" value="Limpar" style="margin-bottom:5; margin:5 0 0 0; vertical-align: top">  </center> </td>
                                
                           </tr>
-->                           
                           <tr>
                                <td style="background-color: #66CDAA;color: #008B8B;"> <b> Destino </b> </td>
                                <td style="background-color: #66CDAA;color: #008B8B;"> <b> mauricio@[REDACTED_DB_USERNAME].com.br </b> </td>
                            </tr>
                          </table>
                    </form>
		    	</center>
            </div> <!-- Fecha a div Conteudo -->
        </div> <!-- Fecha a div Principal -->
	</body>
</html>