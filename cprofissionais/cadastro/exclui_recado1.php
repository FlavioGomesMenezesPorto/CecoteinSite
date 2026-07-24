<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Excluir recado </title>
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
               <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object> -->
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
				
		   echo(' <div id="menu">');
		   
		   	include '../funcoes/menu.php';
           
		   echo(' </div> ');
		   
		   echo('<div id="corpo">
		   			<font face="Arial" size="+1" color="#FFFFFF"> ');
					
		   include '../funcoes/conecta.php';
		   
		   mysql_select_db(BASE,$cn)or die(mysql_error());
           date_default_timezone_set('UTC');
           
		   //-------------------
		   //Definindo variáveis
		   
		   $hora = $_POST["hora"];
	 	   $remet = $_POST["remet"];
		   $emp = $_POST["empresa"];
		   $dia = $_POST["dia"];
		   
		   $timestamp = strtotime($dia);
		   $dia = date('Y-m-d', $timestamp);
		   //------------------
		   
		   //echo("Delete from recados_pro where hora = '$hora' and remetente = '$remet' and empresa = '$emp'");
		   mysql_query("Delete from recados_pro where hora = '$hora' and remetente = '$remet' and empresa = '$emp' and dia = '$dia'") or die (mysql_error());
		     
		   if(mysql_affected_rows() == 1)
		   {
				echo ("<p align='center'> <img src='../imagens/confirma.png' width='60px' height='60px' align='middle'> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Recado excluído com sucesso <BR><br><BR> <a href='../principais/visualizar_recados.php'><input type='button' name='voltar' title='Voltar' value='Voltar'></a> </p>");
		   }
		   else
		   {
		        echo ("<p align='center'> <img src='../imagens/atencao.png' width='60px' height='60px' align='middle'>Não foi possivel excluir seu recado, por favor, tente novamente mais tarde.<BR><br><BR> <a href='../principais/visualizar_recados.php'><input type='button'  name='voltar' title='Voltar' value='Voltar'></a> </p>");
		    }
		   
		   echo('</div>');
         ?>   
            <!--<div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
