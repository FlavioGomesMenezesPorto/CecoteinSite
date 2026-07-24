<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Como Funciona </title>
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
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-prof.html");
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
			
            echo ('<div id="menu">');
			
				include '../funcoes/menu.php';
				
            echo (' </div> ');
			
			echo(' <div id="corpo" >');
			
			$funciona = $_POST["funciona"];
			
     		include '../funcoes/funcoes.php';
			include '../funcoes/conecta.php';
			mysql_select_db(BASE,$cn)or die(mysql_error());
			
			$funciona = substitui_str($funciona);
			
			$salva = mysql_query("Update param_pro set funciona = '$funciona' ");
			
			$pesquisa = mysql_query("Select * from param_pro where funciona = '$funciona'");
			
			echo("<br><br><br><br>");
			if (mysql_num_rows($pesquisa) == 1)
			{
				echo (' <img src="../imagens/confirma.png" width="60px" height="60px" title="Confirmado" name="Confirmado" value="confirmado" align="absmiddle"> &nbsp&nbsp&nbsp&nbsp&nbsp
				Dados alterados com sucesso! 
				<br><br> <a href="../admin.php"><input type="button" value="Voltar" name="voltar">');
			}
			else
			{
				echo(' <img src="../imagens/atencao.png" width="60px" height="60px" title="Confirmado" name="Confirmado" value="confirmado" align="absmiddle"> &nbsp&nbsp&nbsp&nbsp&nbsp
				Não foi possível alterar o texto!  
				<br><br> <a href="../funciona.php"><input type="button" value="Voltar" name="voltar">');
			}
			
			echo("</div>");			
           ?>
           
            <!--<div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
