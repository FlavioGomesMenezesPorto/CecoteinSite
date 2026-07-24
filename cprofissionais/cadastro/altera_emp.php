<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Dados Pessoais </title>
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
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
				?>
            </div>	
            <div class="conteudo">
            	<a href="../principais/empresa_princ.php"><input type="button" name="voltar" value="Voltar"></a>
            <?php
				session_start();
				include '../funcoes/conecta.php';
				include '../funcoes/funcoes.php';
				mysql_select_db(BASE,$cn)or die(mysql_error());
				
				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;;
				
				$pesquisa = mysql_query("Select nome_pro, registro_pro, especialidade_pro, categoria_pro, endereco_pro, numero_pro, bairro_pro, cidade_pro, estado_pro, telefone_pro, senha_pro, foto_pro, foto2_pro, foto3_pro, foto4_pro, nasc_pro,  cnpj, observacao_pro, tipo, empresa from cadastro_profissionais where id_pro = '$id'");
			  $ver = mysql_fetch_row($pesquisa);
			  	
			
            echo('    <form border="0" name="cadastroprofissional" action="altera_cad_emp.php" method="post" onsubmit="return verificacadprofissional(this);return verificacpf(this);"  enctype="multipart/form-data">
                    <table border="0">
                        <tr>
                            <td colspan="4"> <center> <img src="../imagens/dados_pessoais.png" width="250px" height="45px"></center> </td>
                        </tr>
                        <tr>
                            <td> <label for="nome"> <font color="#FFFFFF"> Nome: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="nome" onKeypress="return soletras();" value="'.$ver[0].'"></td>
                        </tr>
                        <tr>
                            <td> <label for="registro"> <font color="#FFFFFF"> Registro: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="registro" value="'.$ver[1].'"></td>
                        </tr>
                        <tr>
                            <td> <label for="especialidade"> <font color="#FFFFFF"> Especialidade: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="especialidade" onKeypress="return soletras();" value="'.$ver[2].'"> </td>
                        </tr>
            		    <tr>
                            <td> <label for="categoria"> <font color="#FFFFFF"> Categoria: </font> </label> </td>
                            <td colspan="3"> 
                                <select name="categoria">
                                	<option > '.$ver[3].' </option>
                                    <option value="advogado"> Advogado </option>
                                    <option value="dentista"> Dentista </option>
                                    <option value="informatica"> Informática </option>
                                    <option value="medico"> Médico </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="cnpj"> <font color="#FFFFFF"> CNPJ: </font> </label> </td>
                            <td colspan="3"> <input type="text" value="'.$ver[16].'" maxlength="18" size="50" name="cnpj" onKeypress="mascara(this, \'##.###.###/####-##\')" > </td> 
                        </tr>
                        <tr>
                            <td> <label for="nasc"> <font color="#FFFFFF"> Data de criação: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="11" size="50" name="nasc" value="'.$ver[15].'" onKeypress="mascara(this, \'##/##/####\')"> </td>
            			</tr>
            			<tr>
                            <td> <label for="endereco"> <font color="#FFFFFF"> Endereço: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="endereco" value="'.$ver[4].'"> </td>
                        </tr>
                        <tr>
                            <td> <label for="numero"> <font color="#FFFFFF"> Número: </font> </label> </td>
                            <td> <input type="text" maxlength="8" size="5" name="numero" onKeypress="return sonumeros();" value="'.$ver[5].'"></td>
                            <td> <label for="bairro"> <font color="#FFFFFF"> Bairro: </font> </label> </td>
                            <td> <input type="text" maxlength="40" size="29" name="bairro" value="'.$ver[6].'"> </td>
                        </tr>
                        <tr>
                            <td> <label for="cidade"> <font color="#FFFFFF"> Cidade: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="cidade" value="'.$ver[7].'"> </td>
                        </tr>
                        <tr>
                            <td> <label for="estado"> <font color="#FFFFFF"> Estado: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="40" size="50" name="estado" value="'.$ver[8].'"> </td>
                        </tr>
                        <tr>
                            <td> <label for="telefone"> <font color="#FFFFFF"> Telefone: </font> </label> </td>
                            <td colspan="3"> <input type="text" maxlength="13" size="50" name="telefone" onKeypress="mascara_tel(this, \'(##)####-####\')" value="'.$ver[9].'"> </td>
                        </tr>
                        <tr>
                            <td> <label for="fotos"> <font color="#FFFFFF"> Foto-1: </font> </label> </td>
                            <td colspan="3"> ');
							if ($ver[11] == '')
							{
								echo (' <img src="../imagens/nophoto.jpg" width="95px" height="80">');
							}
							else
							{
								echo('<img src="'.$ver[11].'" width="95px" height="80">');
							} 
							echo(' &nbsp&nbsp&nbsp&nbsp
                           <a href="../cadastro/altera_foto1.php?f=1"><input type="button" name="foto1" value="Alterar foto"></a> </td>
                        </tr>
                        <tr>
                            <td> <label for="fotos"> <font color="#FFFFFF"> Foto-2: </font> </label> </td>
                            <td colspan="3"> ');
							if ($ver[12] == '')
							{
								echo (' <img src="../imagens/nophoto.jpg" width="95px" height="80">');
							}
							else
							{
								echo('<img src="'.$ver[12].'" width="95px" height="80">');
							} 
							echo(' &nbsp&nbsp&nbsp&nbsp
                           <a href="../cadastro/altera_foto1.php?f=2"><input type="button" name="foto2" value="Alterar foto"></a> </td>
                        </tr>
                        <tr>
                            <td> <label for="fotos"> <font color="#FFFFFF"> Foto-3: </font> </label> </td>
                            <td colspan="3">');
							if ($ver[13] == '')
							{
								echo (' <img src="../imagens/nophoto.jpg" width="95px" height="80">');
							}
							else
							{
								echo('<img src="'.$ver[13].'" width="95px" height="80">');
							} 
							echo(' &nbsp&nbsp&nbsp&nbsp
                           <a href="../cadastro/altera_foto1.php?f=3"><input type="button" name="foto3" value="Alterar foto"></a> </td>
                        </tr>
                        <tr>
                            <td> <label for="fotos"> <font color="#FFFFFF"> Foto-4: </font> </label> </td>
                            <td colspan="3"> ');
							if ($ver[14] == '')
							{
								echo (' <img src="../imagens/nophoto.jpg" width="95px" height="80">');
							}
							else
							{
								echo('<img src="'.$ver[14].'" width="95px" height="80">');
							} 
							echo(' &nbsp&nbsp&nbsp&nbsp
                           <a href="../cadastro/altera_foto1.php?f=4"><input type="button" name="foto4" value="Alterar foto"></a> </td>
                        </tr>
                        <tr> 
                        	<td> <label for="observacao"> <font color="#FFFFFF"> Observações : </font> </label> </td>
                            <td colspan="3"> <textarea rows="8" cols="52" name="obs" id="obs" style="font-family:Arial;">'.$ver[17].' </textarea> </td>
                        </tr>
                        <tr>
                         	<br>
                            <td colspan="4"> 
                            	<center>
                                        <input type="submit" name="Cadastrar" value="Salvar">
                                        <input type="reset" name="apagar" value="Apagar">
										<a href="../cadastro/senha.php"><input type="button" name="senha" value="Alterar Senha"></a>
										
                                </center>
                            </td>
                        </tr>
                	</table>
				</form> ');
				?>
            </div> <!-- Fecha a div Conteudo -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>