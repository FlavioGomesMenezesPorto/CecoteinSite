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
		   
		   $mes = $_POST["mes"];
		   $id = $_POST["id"];
		   
		   //------------------
		   if ($id <> 0){		 
		   echo('<form action="../cadastro/altera_recado1.php" method="post" name="mens">
		   		 <table style="text-align:left" align="center">
				 <tr>
				 	<td> <br> </td>
				 </tr>
				 <tr>
				 	<td> Mensagem a ser alterada: </td>
				 </tr>
				 <tr>
				 	<td> <br> </td> 
				 </tr>
				 <tr>
				 	<td> 
				 		<textarea name="mensagem" cols="60" rows="6" style="font-family:Arial"> '.$mes.' </textarea>
				 		<input type="hidden" name="id" value="'.$id.'">
					</td>
				</tr>
				<tr>
					<td>
				 		<input type="submit" value="Salvar" name="salvar">
					</td>
				</tr>
				</form>
				');
		   echo('</div>');
		   } else {
			   echo ("Não  tem sessão !");
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/login.php?r=$id_pro&d=$data&i=$inicio'>");
		   }
         ?>   
           <!-- <div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
