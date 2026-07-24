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
               <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 

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
		   
		$id = $_GET['id'];// id do cliente
		$hor  = $_GET['hor']; //id do horario
		$p = $_GET['id_p'];// id do profissional desmarcado
		$hora = $_GET["h"]; // hora marcada
		$data = $_GET["d"]; // data marcada
		   
		   //------------------
		   
		   echo(' <form action="../horario/deletar_horario.php" method="get" name="envia">
			   
			   <br><br><br>
			   
			   Deseja realmente excluir este horário? 
			   
			   <input type="hidden" name="hor" value="'.$hor.'"/>
			   <input type="hidden" name="id" value="'.$id.'"/>
			   <input type="hidden" name="id_p" value="'.$p.'"/>
			   <input type="hidden" name="h" value="'.$hora.'"/>
			   <input type="hidden" name="d" value="'.$data.'"/>
			   <br><br> 
			   
			   <input type="submit" name="sim" value="Sim"> &nbsp&nbsp&nbsp&nbsp&nbsp
			   <a href="../horario/visualizar_atendimento.php?r='.$p.'&a='.$hor.'&d='.$data.'"><input type="button" name="nao" value="Não"></a>
		   </form>
		   ');
		   
		   echo('</div>');
         ?>   
          <!--  <div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
