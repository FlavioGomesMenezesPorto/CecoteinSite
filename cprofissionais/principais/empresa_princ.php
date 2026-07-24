<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/home.css" type="text/css" rel="stylesheet">
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
            
            <?php
				
				include '../funcoes/conecta.php';
				mysql_select_db(BASE,$cn)or die(mysql_error());
				mysql_set_charset('utf8');
				
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;
					
				session_start();
				
			
				echo ('<div id="menu">');
					include '../funcoes/menu.php';
				echo(' </div> ');
				
				$pesquisa = mysql_query("SELECT nome_pro FROM cadastro_profissionais WHERE id_pro = '$id'") or die(mysql_error());
				$nome = mysql_fetch_row($pesquisa);
			?>
			<div id="corpo">
               <form name='escolha'>
                  <p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>
                   <?php 
                  
				  echo('<font size="+1"> Seja bem-vindo(a), profissional da empresa '.htmlspecialchars_decode($nome[0]).'. <br><br>
				  
				  O que deseja fazer? <br><br> ');
				  
				   echo('<a href="../cadastro/cadastroprofissional.php"><img src="../imagens/botoes/profissionais.png" width="230px" height="35 px" title="Cadastro de profissionais" alt="Cadastro de Profissionais"></a>  ');
                				   
				   echo ('<a href="../cadastro/altera_emp.php"><img src="../imagens/botoes/alterar.png" width="150px" height="35px" title="Alterar dados" alt="Alterar dados"></a> '); 
				   
				   echo ('<a href="../principais/emp_prof.php"><img src="../imagens/botoes/visualizar_prof.png" width="230px" height="35px" title="Visualizar perfil dos profissionais" alt="Visualizar perfil dos profissionais"></a> '); 
				   
				   ?>         
                  
              </form>
            </div> <!-- Fecha a div Corpo -->
           <!-- <div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
