<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Login </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/login.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body>
        <div class="principal">
        	<div id="cabeca" >
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu_teste.html");
				?>
                    
            </div>
            
<div class="login">
                   <?php
				   //Verifica se existe algum cookie se houver, o exclui	
					setcookie ("pro", "", time() - 3600,"/cprofissionais/");
					setcookie ("cli", "", time() - 3600,"/cprofissionais/");				   

				    // Verifica se tem alguma sessão aberta, se houver a destroi
					if ( isset($_SESSION['cliente']))
						session_destroy();
					if ( isset($_SESSION['prof']))
						session_destroy();
					if ( isset($_SESSION['emp']))
						session_destroy(); 
					
					include '../funcoes/funcoes.php';
                  ?>
				<div id="titulo" style="background-color: #66CDAA;"> <font color=\"#008B8B\"> <b> <center> LOGIN </center> </b> </font>
                </div>
                  <div id='conteudo'>
                      <form action='../login/logar1.php' name='login' method='post'>
                          <table>
                             <tr>
                              	<td>  </td>  <td>  </td>
                              </tr>
                              <tr>
                              	<td>  </td>  <td>  </td>
                              </tr>
                              <tr>
                              	<td>  </td>  <td>  </td>
                              </tr>
                             <tr>
                                  <td> <label for='cpf'> CPF/CNPJ: </label> </td>
                                  <td> <input type='text' name='cpf' maxlength="14" /> </td>
                              </tr>
                              <!--<tr>
                                  <td> <label for='cpf'> ou CNPJ: </label> </td>
                                  <td> <input type='text' name='cnpj' maxlength="18"/> </td>  
                              </tr> -->
                              <tr>
                              	<td>  </td>
                                <td>  </td>
                              </tr>
                              <tr>
                              	<td>  </td>  <td>  </td>
                              </tr>
                              <tr>
                                  <td> <label for='senha'> Senha: </label> </td>
                                  <td> <input type='password' name='senha' /> </td>
                              </tr>
                              <tr>
                              	<td>  </td>  <td>  </td>
                              </tr>
                              <tr>
                                  <td colspan='2'>
                                    <input type='submit' name='Enviar' value='enviar'>
                                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                      <!--<a href='cadastrocliente.php'> Cadastre-se </a> -->
                                  </td>
                              </tr>
                          </table>
                      </form>	
			      </div> <!-- Fecha a div Conteudo -->
             </div>
            <!-- Fecha a div Titulo --> 
              
            </div> <!-- Fecha a Div Login -->
        </div> <!-- Fecha a Div Principal -->
	</body>
</html>