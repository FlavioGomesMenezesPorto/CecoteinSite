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
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../Menu.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu_teste.html");
				?>
            </div>
            <div class="conteudo">
				<?
                    include '../funcoes/conecta.php';
					include '../funcoes/funcoes.php';
					
					session_start();
                    mysql_select_db(BASE,$cn)or die(mysql_error());
                    
                    $nome = $_POST["nome"];
                    $apelido = $_POST["apelido"];
					$cpf = $_POST["cpf"];
                    $rg = $_POST["rg"];
					$nasc = $_POST["nasc"];
                    $endereco = $_POST["endereco"];
                    //$numero = $_POST["numero"];
                    $bairro = $_POST["bairro"];
                    $cep = $_POST["cep"];
					$cidade = $_POST["cidade"];
                    $estado = $_POST["estado"];
                    $naturalidade = $_POST["natural"];
					$sexo = $_POST["sexo"];
					$civil = $_POST["civil"];
					$telefone = $_POST["telefone"];
					$email = $_POST["email"];
                    $senha = $_POST["senha"];
					$conf_senha = $_POST["conf_senha"];
                    
					//$foto = $_FILES["foto"];
                    
					$confere = mysql_query("SELECT * FROM cliente where cpnjcpf_cli = '$cpf'")or die(mysql_error());
                    
                    if(!mysql_num_rows($confere))
					{// se não tiver, ele insere o dado.
                        
						if ($senha == $conf_senha )
						{
							//echo("entrou no if vet[1] <br>");
							mysql_query("INSERT INTO cliente( cpnjcpf_cli, apelido_cli, nome_cli, endereco_cli, bairro_cli, cidade_cli, estado_cli, cep_cli, inscrg_cli, email_cli, senha_cli, telefone1_cli, naturalidade_cli, sexo_cli, 
datanasc_cli, est_civ_cli) VALUES ('$cpf', '$apelido', '$nome', '$endereco', '$bairro', '$cidade', '$estado', '$cep', '$rg', '$email', '$senha', '$telefone', '$naturalidade', '$sexo', '$nasc', '$civil')")or die(mysql_error());
							if(mysql_affected_rows() == 1)
							{
								echo '<p align="center"> Registro efetuado com sucesso <BR> <a href="../principais/index.php"> <img src="../imagens/botoes/voltar.png" name="voltar" title="Voltar" value="Voltar"> </a></p>';
							}
							else
							{
								echo '<p align="center"> Não foi possível efetuar o cadastro, tente novamente mais tarde <BR> <a href="../principais/index.php"> <img src="../imagens/botoes/voltar.png" name="voltar" title="Voltar" value="Voltar"> </a></p>';
							}
						}
						else
						{
							echo('<br><br> As senhas digitadas não são iguais, por favor, tente novamente! <br>
							<a href="javascript:history.back(1);"><input type="button"name="voltar" value="Voltar"></a>');
						}
					}
					else
					{
						echo ('<p align="center"> CPF Já Cadastrado no Sitemas. <BR><a href="javascript:history.back(1);"><img src="../imagens/botoes/voltar.png" name="voltar" title="Voltar" value="Voltar"> </a></p>');
					
					}

                 ?>
                 
		     </div> <!-- Fecha a div Conteudo -->
           
          </div> <!-- Fecha a div Principal -->
  </body>
</html>
          