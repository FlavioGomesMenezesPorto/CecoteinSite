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
                     <param name="movie" value="../menu/Menu-cliente.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-cliente.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-cliente.html");
				?>
            </div>
            <div class="conteudo">
				<?
                    include '../funcoes/conecta.php';
					include '../funcoes/funcoes.php';
					
					session_start();
                    mysql_select_db(BASE,$cn)or die(mysql_error());
                    
					if(isset($_COOKIE['cli']))
						$id_cli = $_COOKIE["cli"];
					else
						$id_cli = 0;
	
					
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
                    //$senha = $_POST["senha"];
					//$conf_senha = $_POST["conf_senha"];   
                    
                    mysql_query("Update cliente set cpnjcpf_cli = '$cpf', apelido_cli = '$apelido', nome_cli = '$nome', endereco_cli = '$endereco', bairro_cli = '$bairro', cidade_cli = '$cidade', estado_cli = '$estado', cep_cli = '$cep', inscrg_cli = '$rg', email_cli = '$email', telefone1_cli = '$telefone', naturalidade_cli = '$naturalidade', sexo_cli = '$sexo', datanasc_cli = '$nasc', est_civ_cli = '$civil' where cpnjcpf_cli = '$id_cli'")or die(mysql_error());
					
					if(mysql_affected_rows() == 1)
					{
						echo '<p align="center"> Registro efetuado com sucesso <BR> <a href="../cadastro/altera_cli.php?"> <img src="../imagens/botoes/voltar.png" name="voltar" title="Voltar" value="Voltar"> </a></p>';
					}
					else
					{
						echo ('<p align="center"> Não foi possível alterar os dados, por favor tente mais tarde!<br> <a href="../cadastro/altera_cli.php"> <img src="../imagens/botoes/voltar.png" name="voltar" title="Voltar" value="Voltar"> </a></p>');
					
					//sleep(7);
					//echo"<script>window.location = 'index.php ';
					}
					
                 ?>
                 
		     </div> <!-- Fecha a div Conteudo -->
           
          </div> <!-- Fecha a div Principal -->
  </body>
</html>
          