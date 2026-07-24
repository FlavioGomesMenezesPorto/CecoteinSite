<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Alterar recado </title>
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
               <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 

            </div>
            
            <div id="flash" >
              <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>--><?php
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
				
		   echo(' <div id="menu">');
		   
		   	include '../funcoes/menu.php';
           
		   echo(' </div> ');
		   
		   echo('<div id="corpo">
		   			<font face="Arial" size="+1" color="#FFFFFF"> ');
					
		   include '../funcoes/conecta.php';
		   include '../funcoes/funcoes.php';
		   
		   mysql_select_db(BASE,$cn)or die(mysql_error());
           date_default_timezone_set('UTC');
           
		   //-------------------
		   //Definindo variáveis
		   
		   $mes = $_POST["mensagem"];
		   $id_r = $_POST["id"];
		   
		   //------------------
		   
		   // troca o apóstrofe pelas aspas duplas na mensagem
		   $mes = substitui_str($mes);

		   $insere = mysql_query("Update recados_pro set mensagem = '$mes' where id = '$id_r'") or die(mysql_error());
		   
		   if (mysql_affected_rows() == 1)
		   {
				  echo('<br> <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<font size="+2"> Recado alterado com sucesso! <br> 
				  
				  <a href="../principais/visualizar_recados.php" style="text-decoration:none;"><input type="button" name="voltar" value="Voltar"></a>
				   ');
		   }
		   else
		   {
			   	echo("<br> <img src='../imagens/atencao.png' width='60px' height='60px' align='middle'>
						<font size='+2'>Não foi possível alterar o recado, tente novamente mais tarde!
				
				<form name='envia' action='../cadastro/altera_recado.php' method='post'>
					<input type='hidden' value=".$mes." name='mes'>
					<input type='hidden' value=".$id." name='id'>
					<input type='submit' name='voltar' value='Voltar'>
				</form>
				");
		   }
		   
         ?>   
          <!--  <div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
