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
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
				?>
            </div>
            <div class="conteudo">
				<?php
					include '../funcoes/conecta.php';
					include '../funcoes/funcoes.php';
					
					if(isset($_COOKIE['pro']))
						$id = $_COOKIE["pro"];
					else
						$id = 0;
					
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
					$obs = $_POST["obs"];
					//$foto = 0;
					$cont = 0;
					
					mysql_query("UPDATE cadastro_profissionais set nome_pro = '$nome', registro_pro = '$registro',  especialidade_pro = '$especialidade', categoria_pro = '$categoria', endereco_pro = '$endereco', numero_pro = '$numero', bairro_pro = '$bairro', cidade_pro = '$cidade', estado_pro = '$estado', telefone_pro = '$telefone', nasc_pro = '$nasc', cnpj = '$cnpj', observacao_pro = '$obs' where id_pro = '$id'")or die(mysql_error());
						
					if (mysql_affected_rows() != 0)	
						echo ("<p align='center'> Alteração efetuada com sucesso <BR> <br><br> <a href='../principais/empresa_princ.php?'><input type='button' name='voltar' title='Voltar' value='Voltar'></a> </p>");
					
					else
					{
						echo ("<p align='center'> Não foi possivel efetuar o cadastro, por favor, tente novamente mais tarde. <BR><br><BR> <a href='../principais/empresa_princ.php'><input type='button' name='voltar' title='Voltar' value='Voltar'></a> </p>");
					}
				?>
               
		    </div> <!-- Fecha a div Conteudo -->
      </div> <!-- Fecha a div Principal -->
  </body>
</html>


          