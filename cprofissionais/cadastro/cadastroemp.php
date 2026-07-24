<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Cadastro de clientes </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
		<div class="principal">

            <div id="cabeca" >
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                <!-- <object width="1500px" height="65px">
                     <param name="movie" value="Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
				?>
            </div>
            <div class="conteudo">
				<?php
					include '../funcoes/conecta.php';
					include '../funcoes/funcoes.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
					
					session_start();
					
					$nome = $_POST["nome"];
					$registro = $_POST["registro"];
					$especialidade = $_POST["especialidade"];
					$categoria = $_POST["categoria"];
					$cnpj = $_POST["cnpj"];
					$nasc = $_POST["nasc"];
					$endereco = $_POST["endereco"];
					$numero = $_POST["numero"];
					$bairro = $_POST["bairro"];
					$cidade = $_POST["cidade"];
					$estado = $_POST["estado"];
					$telefone = $_POST["telefone"];
					$senha = $_POST["senha"];
					$conf_senha = $_POST["conf_senha"];
					$obs = $_POST["obs"];
					
					$foto1 = $_FILES["foto1"];
					$foto2 = $_FILES["foto2"];
					$foto3 = $_FILES["foto3"];
					$foto4 = $_FILES["foto4"];
					
					$cont = 0;
					
					$confere = mysql_query("SELECT * FROM cadastro_profissionais where cnpj = '$cnpj'")or die(mysql_error());
					
					//echo(mysql_num_rows($confere).' : confere <br>');
					
					if(mysql_num_rows($confere) == 0)
					{ // se não tiver dados, ele insere o dado.
						
						if ($senha == $conf_senha )
						{
							//echo("entrou no if senha <br>");
							if ( !isset($foto1))
							{
								//echo("entrou no if empty <br>");
								$foto1 = VerificaFotoEmp("foto1");
							}
							else
							{
								//echo("entrou no else empty <br>");
								$foto1[0] = '';
								$foto1[1] = 1;
							}
							
							if ( !isset($foto2))
							{
								//echo("entrou no if empty <br>");
								$foto2 = VerificaFotoEmp("foto2");
							}
							else
							{
								//echo("entrou no else empty <br>");
								$foto2[0] = '';
								$foto2[1] = 1;
							}
							
							if ( !isset($foto3))
							{
								//echo("entrou no if empty <br>");
								$foto3 = VerificaFotoEmp("foto3");
							}
							else
							{
								//echo("entrou no else empty <br>");
								$foto3[0] = '';
								$foto3[1] = 1;
							}
							
							if ( !isset($foto4))
							{
								//echo("entrou no if empty <br>");
								$foto4 = VerificaFotoEmp("foto4");
							}
							else
							{
								//echo("entrou no else empty <br>");
								$foto4[0] = '';
								$foto4[1] = 1;
							}
						
							if (($foto1[1] == 1) && ($foto2[1] == 1) && ($foto3[1] == 1) && ($foto4[1] == 1))
							{
								$teste = $cnpj;
								mysql_query("INSERT INTO cadastro_profissionais
								(nome_pro, registro_pro, especialidade_pro, categoria_pro, endereco_pro, numero_pro, bairro_pro, cidade_pro, estado_pro, telefone_pro, senha_pro, nasc_pro, cnpj, observacao_pro, tipo, foto_pro, foto2_pro, foto3_pro, foto4_pro) 
								VALUES ('$nome', '$registro', '$especialidade', '$categoria', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$telefone', '$senha', '$nasc', '$teste', '$obs', 'empresa', '$foto1[0]', '$foto2[0]', '$foto3[0]', '$foto4[0]')")or die(mysql_error());
								
								if(mysql_affected_rows() == 1)
								{
									echo ("<p align='center'> Registro efetuado com sucesso <BR><br><BR> <a href='../principais/index.php'><input type='button' name='voltar' title='Voltar' value='Voltar'></a> </p>");
								}
								else
								{
									echo ("<p align='center'> Não foi possivel efetuar o cadastro, por favor, tente novamente mais tarde.<BR><br><BR> <a href='../principais/index.php'><input type='button'  name='voltar' title='Voltar' value='Voltar'></a> </p>");
								}
							}
						}
						else
						{
							echo('<br><br> As senhas digitadas não são iguais, por favor, tente novamente! <BR><br><BR>
							<a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a>');
						}
					}
					else
					{
						echo ("<p align='center'> CPF Já Cadastrado no Sitema. <BR><br><BR> <a href='javascript:history.back(1);'><input type='button'  name='voltar' title='Voltar' value='Voltar'></a> </p>");
					}
							
				?>
               
		    </div> <!-- Fecha a div Conteudo -->
      </div> <!-- Fecha a div Principal -->
  </body>
</html>


          