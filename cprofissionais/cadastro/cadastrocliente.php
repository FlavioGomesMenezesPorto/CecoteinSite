<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Cadastro de Clientes </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
		<script src="../js/cadastrocliente.js"></script>
        <script src="../funcoes/mascaras.js" ></script>
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
            <?php
				
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;
					
				session_start();
			
			include '../funcoes/funcoes.php';
			
            echo ('<div id="menu"> ');
               include '../funcoes/menu.php';
			echo('</div> ');
			?>
            		
            <div class="conteudo" align="left">
            	<p align="right"><a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </p>
               <!-- <form border="0" name="cadastro" action="../cadastro/cadastrocli.php" method="post" onsubmit="return verificacadcliente(this);return verificacpf(this);" > -->
               <form border="0" name="cadastrocliente" action="../cadastro/cadastrocli.php" method="post" >
                	<center>
                        <table border="0">
                            <tr>
                                <td colspan="4"> <center> <img src="../imagens/Cad_cliente.png" width="300px" height="40px"> </center> </td>
                            </tr>
                            <tr>
                                <td> <label for="nome"> <h2> Nome: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="nome" onKeypress="return soletras();"> </td>
                            </tr>
                            <tr>
                                <td> <label for="apelido"> <h2> Apelido: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="apelido" onKeypress="return soletras();"> </td>
                            </tr>
                            <tr>
                                <td> <label for="cpf"> <h2> CPF/CNPJ: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="18" size="50" name="cpf" title="Digite apenas números" alt="CPF/CNPJ - digite apenas números" > </td>
                           </tr>
                           <tr>
                                <td> <label for="rg"> <h2> RG / Inscrição estadual </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="20" size="50" name="rg"> </td>
                           </tr>
                           <tr>
                                <td> <label for="nasc"> <h2> Data Nascimento: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="10" size="50" name="nasc"  onKeypress="mascara(this, '##/##/####')"> </td>
                           </tr>
                           <tr>
                                <td> <label for="endereco"> <h2> Endereço: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="endereco"> </td>
                           </tr>
                           <tr>
                                <td> <label for="bairro"> <h2> Bairro: </h2> </label> </td>
                                <td> <input type="text" maxlength="40" size="50" name="bairro"> </td>
                           </tr>
                           <tr>
                                <td> <label for="cep"> <h2> CEP: </h2> </label> </td>
                                <td> <input type="text" maxlength="9" size="50" name="cep" onKeypress="mascara(this, '#####-###')"> </td>
                           </tr>
                           <tr>
                                <td> <label for="cidade"> <h2> Cidade: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="cidade"> </td>
                           </tr>
                           <tr>
                                <td> <label for="estado"> <h2> Estado: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="estado"> </td>
                           </tr>
                           <tr>
                                <td> <label for="naturalidade"> <h2> Naturalidade: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="natural"> </td>
                           </tr>
                           <tr>
                                <td> <label for="sexo"> <h2> Sexo: </h2> </label> </td>
                                <td colspan="3"> <input type="radio" name="sexo" value="M"> Masculino 
                                                 <input type="radio" name="sexo" value="F"> Feminino
                                                 <input type="radio" name="sexo" value="E"> Empresa 
                                </td>
                           </tr>
                           <tr>
                                <td> <label for="civil"> <h2> Estado civil: </h2> </label> </td>
                                <td colspan="3"> 
                                    <select name="civil">
                                        <option > Selecione seu estado civil</option>
                                        <option value="solteiro"> Solteiro(a) </option>
                                        <option value="casado"> Casado(a) </option>
                                        <option value="viuvo"> Viúvo(a) </option>
                                        <option value="divorciado"> Divorciado(a) </option>
                                        <option value="amasiado"> Amasiado(a)</option>
                                        <option value="empresa"> empresa(a)</option>
                                    </select>
                                </td>
                           </tr>
                           <tr>
                                <td> <label for="telefone"> <h2> Telefone: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="13" size="50" name="telefone"  onKeypress="mascara_tel(this, '(##)####-####')"> </td>
                          </tr>
                          <tr>
                                <td> <label for="email"> <h2> Email: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="60" size="50" name="email" id="mail" onBlur="TestandoEmailCad(this);"> </td>
                          </tr>
                          <tr>
                                <td> <label for="senha"> <h2> Senha: </h2> </label> </td>
                                <td colspan="3"> <input type="password" maxlength="40" size="50" name="senha"> </td>
                          </tr>
                          <tr>
                                <td> <label for="conf_senha"> <h2> Confirma senha: </h2> </label> </td>
                                <td colspan="3"> <input type="password" maxlength="40" size="50" name="conf_senha"> </td>
                          </tr>
                          <tr>
                                <td colspan="4"> <center> <input type="submit" name="Cadastrar" value="Cadastrar">
                                                          <input type="reset" name="apagar" value="Apagar">
                                                          
                                                 </center>
                                </td>
                            </tr>
                       </table>
                    </center>
				</form>	
            </div> <!-- Fecha a div Conteudo -->
    	</div> <!-- Fecha a div Principal -->
	</body>
</html>