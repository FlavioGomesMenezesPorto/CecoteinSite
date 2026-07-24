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
		   
		   $hora = $_GET["h"];
	 	   $remet = $_GET["r"];
		   $emp = $_GET["e"];
		   $dia = $_GET["d"];
		   //------------------
		   
		   echo(' <form action="../cadastro/exclui_recado1.php" method="post" name="envia">
			   
			   <br><br><br>
			   
			   Deseja realmente excluir este recado? 
			   
			   <input type="hidden" name="hora" value="'.$hora.'">
			   <input type="hidden" name="remet" value="'.$remet.'">
			   <input type="hidden" name="empresa" value="'.$emp.'">
			   <input type="hidden" name="dia" value="'.$dia.'">
			   <br><br> 
			   
			   <input type="submit" name="sim" value="Sim"> &nbsp&nbsp&nbsp&nbsp&nbsp
			   <a href="../principais/visualizar_recados.php"><input type="button" name="nao" value="Não"></a>
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
