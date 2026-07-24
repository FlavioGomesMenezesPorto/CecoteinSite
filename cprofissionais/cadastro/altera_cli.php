<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Dados dos Clientes </title>
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
                <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-cliente.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-cliente.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-cliente.html");
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
				include '../funcoes/conecta.php';
				include '../funcoes/funcoes.php';
				mysql_select_db(BASE,$cn)or die(mysql_error());
			
            echo ('<div id="menu"> ');
               include '../funcoes/menu.php';
			echo('</div> ');
			?>
            		
            <?php
			
			$pesquisa = mysql_query("Select cpnjcpf_cli, apelido_cli, nome_cli, endereco_cli, bairro_cli, cidade_cli, estado_cli, cep_cli, inscrg_cli, email_cli, telefone1_cli, naturalidade_cli, sexo_cli, datanasc_cli, est_civ_cli from cliente where cpnjcpf_cli = '$id_cli'");
			
			$ver = mysql_fetch_row($pesquisa);
			
			echo('<div class="conteudo" align="left">
				<p align="right"><a href="../principais/principal.php"><input type="button" name="voltar" value="Voltar"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
                <form border="0" name="cadastro" action="../cadastro/altera_cad_cli.php" method="post" onsubmit="return verificacadcliente(this);return verificacpf(this);" enctype="multipart/form-data">
                	<center>
                        <table border="0">
                            <tr>
                               <td colspan="4"> <center> <img src="../imagens/dados_pessoais.png" width="250px" height="45px"></center> </td>
                            </tr>
                            <tr>
                                <td> <label for="nome"> <h2> Nome: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="nome" onKeypress="return soletras();" value="'.$ver[2].'"> </td>
                            </tr>
							<tr>
                                <td> <label for="apelido"> <h2> Apelido: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="apelido" onKeypress="return soletras();" value="'.$ver[1].'"> </td>
                            </tr>
                            <tr>
                                <td> <label for="cpf"> <h2> CPF/CNPJ: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="14" size="50" name="cpf" value="'.$ver[0].'"> </td>
                           </tr>
						   <tr>
                                <td> <label for="cpf"> <h2> RG / Incrição estadual: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="14" size="50" name="rg" value="'.$ver[8].'"> </td>
                           </tr>
                           <tr>
                                <td> <label for="nasc"> <h2> Data Nascimento: </h2> </label> </td>  ');
							$ver[13] = strtotime($ver[13]);	
							$ver[13] = date('d/m/Y', $ver[13]);
                          echo('<td colspan="3"> <input type="text" maxlength="11" size="50" name="nasc" value="'.$ver[13].'" onKeypress="mascara(this, \'##/##/####\')"> </td>
                           </tr>
                           <tr>
                                <td> <label for="endereco"> <h2> Endereço: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="endereco" value="'.$ver[3].'"> </td>
                           </tr>
                           <tr>
                                <td> <label for="bairro"> <h2> Bairro: </h2> </label> </td>
                                <td> <input type="text" maxlength="40" size="50" name="bairro" value="'.$ver[4].'"> </td>
                           </tr>
						   <tr>
                                <td> <label for="cep"> <h2> CEP: </h2> </label> </td>
                                <td> <input type="text" maxlength="40" size="31" name="cep" value="'.$ver[7].'"> </td>
                           </tr>
                           <tr>
                                <td> <label for="cidade"> <h2> Cidade: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="cidade" value="'.$ver[5].'"> </td>
                           </tr>
                           <tr>
                                <td> <label for="estado"> <h2> Estado: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="2" size="50" name="estado" value="'.$ver[6].'"> </td>
                           </tr>
						    <tr>
                                <td> <label for="naturalidade"> <h2> Naturalidade: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="40" size="50" name="natural" value="'.$ver[11].'"> </td>
                           </tr>
						   <tr>
                                <td> <label for="sexo"> <h2> Sexo: </h2> </label> </td>
                                <td colspan="3">   ');
								
								//Verifica qual radio cgoup esta marcado
								if ( $ver[12] == 'M' ) 
								{
								    echo(' <input type="radio" name="sexo" value="M" checked> Masculino 
                                           <input type="radio" name="sexo" value="F"> Feminino  ');
								}
								else
								{
									echo(' <input type="radio" name="sexo" value="M" > Masculino 
                                           <input type="radio" name="sexo" value="F" checked> Feminino  ');
								}
								echo('
                                </td>
                           </tr>
						   <tr>
                                <td> <label for="civil"> <h2> Estado civil: </h2> </label> </td>
                                <td colspan="3"> 
                                    <select name="civil">
									');
									//Verifica a opção selecionada 
									if ($ver[14] == 'S' )
									{ 
                                       echo('<option value="S" selected>Solteiro(a) </option>
											<option value="C"> Casado(a) </option>
											<option value="V"> Viúvo(a) </option>
											<option value="D"> Divorciado(a) </option>
											<option value="A"> Amasiado(a)</option>  ');
									}
									else
									{
										if ($ver[14] == 'C' )
										{
											echo('<option value="S">Solteiro(a) </option>
											<option value="C" selected> Casado(a) </option>
											<option value="V"> Viúvo(a) </option>
											<option value="D"> Divorciado(a) </option>
											<option value="A"> Amasiado(a)</option>  ');
										}
										else
										{
											if ($ver[14] == 'V' )
											{
												echo('<option value="S">Solteiro(a) </option>
												<option value="C"> Casado(a) </option>
												<option value="V" selected> Viúvo(a) </option>
												<option value="D"> Divorciado(a) </option>
												<option value="A"> Amasiado(a)</option>  ');
											}
											else
											{
												if ($ver[14] == 'D' )
												{
													echo('<option value="S">Solteiro(a) </option>
													<option value="C"> Casado(a) </option>
													<option value="V"> Viúvo(a) </option>
													<option value="D" selected> Divorciado(a) </option>
													<option value="A"> Amasiado(a)</option>  ');
												}
												else
												{
													echo('<option value="S">Solteiro(a) </option>
													<option value="C"> Casado(a) </option>
													<option value="V"> Viúvo(a) </option>
													<option value="D"> Divorciado(a) </option>
													<option value="A" selected> Amasiado(a)</option>  ');
												}
											}
										}
									}
                             echo(' </select>
                                </td>
                           </tr>
                           <tr>
                                <td> <label for="telefone"> <h2> Telefone: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="13" size="50" name="telefone" value="'.$ver[10].'" onKeypress="mascara_tel(this, \'(##)####-####\')"> </td>
                          </tr>
						  <tr>
                                <td> <label for="email"> <h2> Email: </h2> </label> </td>
                                <td colspan="3"> <input type="text" maxlength="60" size="50" name="email"  onBlur="TestandoEmailCad(this);" value="'.$ver[9].'"> </td>
                          </tr>
                          <tr>
                                <td colspan="4"> 
                            		<center>
									<br>
                                        <input type="submit" name="Cadastrar" value="Salvar">
                                        <input type="reset" name="apagar" value="Apagar">
										<a href="../cadastro/senha.php?"><input type="button" name="senha" value="Alterar Senha"></a>
										
                                	</center>
                            	</td>
                          </tr>
                       </table> 
                    </center>
				</form>	
            </div> <!-- Fecha a div Conteudo --> ');
			?>
    	</div> <!-- Fecha a div Principal -->
	</body>
</html>