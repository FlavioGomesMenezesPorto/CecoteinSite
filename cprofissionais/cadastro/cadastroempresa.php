<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Cadastro de Profissionais </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
		<script src="../js/cadastroprofissional.js"></script>
	</head>	
	<!-- #################################################################################### -->
	<body>
		<div class="principal">
			 <div id="cabeca" >
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
				?>
            </div>	
            <div class="conteudo">
            	<p align="right"><a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </p>
            <?php
				session_start();
				include '../funcoes/funcoes.php';
			?>
                <form border="0" name="cadastroprofissional" action="../cadastro/cadastroemp.php" method="post" onsubmit="return verificacadprofissional(this);return verificacpf(this);"  enctype="multipart/form-data">
                    <table border="0">
                        <tr>
                            <td colspan="4"> <center> <img src="../imagens/cad_empresa.png" width="400px" height="45px"></center> </td>
                        </tr>
                        <tr>
                            <td> <label for="nome"> <font color="#FFFFFF"> Nome: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="nome" onKeypress="return soletras();"> </td>
                        </tr>
                        <tr>
                            <td> <label for="registro"> <font color="#FFFFFF"> Registro: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="registro"> </td>
                        </tr>
                        <tr>
                            <td> <label for="especialidade"> <font color="#FFFFFF"> Especialidade: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="especialidade" onKeypress="return soletras();"> </td>
                        </tr>
            		    <tr>
                            <td> <label for="categoria"> <font color="#FFFFFF"> Categoria: </font> </label> </td>
                            <td colspan="3"> 
                                <select name="categoria">
                                	<option > Selecione uma categoria</option>
                                    <option value="advogado"> Advogado </option>
                                    <option value="dentista"> Dentista </option>
                                    <option value="informatica"> Informática </option>
                                    <option value="medico"> Médico </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="cnpj"> <font color="#FFFFFF"> CNPJ: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="18" size="50" name="cnpj" onKeypress="mascara(this, '##.###.###/####-##')"> </td> 
                        </tr>
                        <tr>
                            <td> <label for="nasc"> <font color="#FFFFFF"> Data de criação: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="10" size="50" name="nasc" onKeypress="mascara(this, '##/##/####')"> </td>
            			</tr>
            			<tr>
                            <td> <label for="endereco"> <font color="#FFFFFF"> Endereço: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="endereco"> </td>
                        </tr>
                        <tr>
                            <td> <label for="numero"> <font color="#FFFFFF"> Número: </font> </label> </td>
                            <td> <input type="text" maxlength="8" size="5" name="numero" onKeypress="return sonumeros();"></td>
                            <td> <label for="bairro"> <font color="#FFFFFF"> Bairro: </font> </label> </td>
                            <td> <input type="text" maxlength="40" size="29" name="bairro"> </td>
                        </tr>
                        <tr>
                            <td> <label for="cidade"> <font color="#FFFFFF"> Cidade: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="cidade"> </td>
                        </tr>
                        <tr>
                            <td> <label for="estado"> <font color="#FFFFFF"> Estado: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="estado"> </td>
                        </tr>
                        <tr>
                            <td> <label for="telefone"> <font color="#FFFFFF"> Telefone: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="12" size="50" name="telefone" onKeypress="mascara_tel(this, \'(##)####-####\')"> </td>
                        </tr>
                        <tr>
                            <td> <label for="fotos"> <font color="#FFFFFF"> Foto-1: </font> </label> </td>
                            <td colspan="3"> <input type="file" name="foto1"><!-- <input type="file" id="foto" name="foto"> --></td>
                        </tr>
                        <tr>
                            <td> <label for="fotos"> <font color="#FFFFFF"> Foto-2: </font> </label> </td>
                            <td colspan="3"> <input name="foto2" type="file" id="foto2"/><!-- <input type="file" id="foto" name="foto"> --></td>
                        </tr>
                        <tr>
                            <td> <label for="fotos"> <font color="#FFFFFF"> Foto-3: </font> </label> </td>
                            <td colspan="3"> <input name="foto3" type="file" id="foto3"/><!-- <input type="file" id="foto" name="foto"> --></td>
                        </tr>
                        <tr>
                            <td> <label for="fotos"> <font color="#FFFFFF"> Foto-4: </font> </label> </td>
                            <td colspan="3"> <input name="foto4" type="file" id="foto4"/><!-- <input type="file" id="foto" name="foto"> --></td>
                        </tr>
                        <tr>
                            <td> <label for="senha"> <font color="#FFFFFF"> Senha: </font> </label> </td>
                            <td colspan="3"> <input type="password" maxlength="40" size="50" name="senha"> </td>
                        </tr>
                        <tr>
                            <td> <label for="senha"> <font color="#FFFFFF"> Confirma senha: </font> </label> </td>
                            <td colspan="3"> <input type="password" maxlength="40" size="50" name="conf_senha"> </td>
                        </tr>
                        <tr> 
                        	<td> <label for="observacao"> <font color="#FFFFFF"> Observações : </font> </label> </td>
                            <td colspan="3"> <textarea rows="8" cols="52" name="obs" id="obs" style="font-family:Arial;"> </textarea> </td>
                        </tr>
                        <tr>
                         	<br>
                            <td colspan="4"> 
                            	<center>
                                        <input type="submit" name="Cadastrar" value="Cadastrar">
                                        <input type="reset" name="apagar" value="Apagar">
                                        
                                </center>
                            </td>
                        </tr>
                	</table>
				</form>
            </div> <!-- Fecha a div Conteudo -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>