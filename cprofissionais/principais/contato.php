<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Fale Conosco </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/lista.css" type="text/css" rel="stylesheet">
        <script src="../funcoes/mascaras.js" ></script>
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
            
            <div id="corpo"	>
            	<p align="right"><a href="javascript:history.back(1);"> <input type="button" value="Voltar" style="margin-bottom:5; margin:5 0 0 0; vertical-align: top"></a></p>
                <center>
                    <form action="../principais/envia.php" method="post" name="formContato">
                      <br>
                        <table>
                            <tr> 
                                <td colspan="2" style="background-color: #66CDAA ;color: #008B8B;"> <b> Formulário para envio de e-mail </b> </font> </td>
                                <td> </td>	
                            </tr>
                            <tr>
                                <td> <font color="#FFFFFF"> Assunto: </font> </td>
                                <td><input type="text" name="assunto" size="51" maxlength="40"> </td>
                            </tr>
                            <tr>
                                <td> <font color="#FFFFFF"> Nome: </font> </td> 
                                <td><input type="text" name="nome" size="51" maxlength="40"></td>
                            </tr>
                            <tr>
                                <td> <font color="#FFFFFF">  E-mail: </font> </td>
                                <td><input type="text" name="email" id="mail" size="51" onBlur="TestandoEmail(this);"></td>
                            </tr>
                            <tr>
                                <td><font color="#FFFFFF"> Mensagem :</font> </td>
                                <td> <textarea rows="6" cols="53"  name="mensagem" style="font-family:Arial"></textarea></td>
                            </tr>												
							
							
							<tr>
								<td colspan="2">
								  <b><font color="#FFFFFF"> Para proseguir, digite os caracteres da imagem: </font> </b>
								</td>
							</tr>
							<tr>
								<td align="right" colspan="" width="50%"> 
								  <img src="/cprofissionais/imagens/cap.bmp" width="80%"> 
								</td>
								<td align="center" colspan=""> 
								  <input type="text" name="captcha" id="captcha" size="12" required>
								  <input type="button" onclick="validaCaptcha()" name="btnConfereCaptcha" value="Conferir">
								</td>
							</tr>

							<tr >
								<td colspan="2" style="font-size: 16px; display: none;" id="msgErroCaptcha">
								  <font color="#FF0000"> Texto incorreto </font>
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
							 <td> </td>
								<td>  <center>
								<input type="submit" name="enviar"   value="Enviar"   style="margin-bottom:5; margin:5 0 0 0; vertical-align: top" disabled="true" id="btnEnviar"> 
								<input type="reset"  name="cancelar" value="Cancelar" style="margin-bottom:5; margin:5 0 0 0; vertical-align: top"> 
								</center> </td>
							</tr>

                            <tr>
                                <td style="background-color: #66CDAA;color: #008B8B;"> <b> Destino </b> </td>
                                <td style="background-color: #66CDAA;color: #008B8B;"> <b> mauricio@[REDACTED_DB_USERNAME].com.br </b> </td>
                            </tr>
                        </table>
                    </form>
					<?php 
					/*	if($_GET['enviado']==1)
						{
							echo"<table width=\"435\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
								<tr>
									<td width=\"449\" bgcolor=\"#E9EDEF\"> 
									    <center> <font color=\"#000000\"> 
											Mensagem enviada com sucesso! 
										</font> </center>
									</td>
								</tr>
							</table>";
						}
						if($_GET['enviado']== 2)
						{
						   echo"<table width=\"435\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
									<tr>
										<td bgcolor=\"#E9EDEF\">
											<center> <font color=\"#000000\"> 
												Erro! Tente novamente mais tarde! 
											</center> </font>
										</td>
									</tr>
								</table> ";
						} 
				*/	?>
            	</center>
            </div> <!-- Fecha a div Conteudo -->
        </div> <!-- Fecha a div Principal -->
	</body>
</html>