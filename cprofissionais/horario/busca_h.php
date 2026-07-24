<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Agendar </title>
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
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-prof.html");
				?>
            </div>
            <?php
			if(isset($_COOKIE['pro']))
				$id = $_COOKIE["pro"];
			else
				$id = 0;
			
			if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;
					
            echo ('<div id="menu"> ');
				include '../funcoes/menu.php';
			echo('</div> ');
			?>
			<div class="conteudo">
            	<br>
               
				<?php
					session_start();
					include '../funcoes/conecta.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
                    //date_default_timezone_set('UTC');
					$p = $_GET['p'];
					//$sem = $_GET['s'];
					$sem = $_POST['dt'];
					$nome = $_POST['cnpjcpf'];
					$n = $_GET['n'];
					$i = 0;
					$cli = mysql_query("Select cpnjcpf_cli , nome_cli, cidade_cli from cliente where nome_cli like '%".$nome."%' order by nome_cli");
					while ($row = mysql_fetch_assoc($cli))
					{
						$cliente[$i] = $row['nome_cli'];
						$cliente[$i+1] = $row['cpnjcpf_cli'];
						$cliente[$i+2] = $row['cidade_cli'];
						$i = $i + 3;
					}
					echo(' <img src="../imagens/horario.png" align="absmiddle" width="100" height="70"> &nbsp&nbsp&nbsp&nbsp&nbsp
					<font size="+1"> <font color="#00CCFF"> Selecione o cliente para o qual deseja ver no dia:'.$sem.' </font>');
					
					echo(' <table cellpadding="5px" cellspacing="5px" align="center" width="600px"');
					echo('<tr> 
							<td> <font color="#EE2C2C"> Cliente </font> </td>
							<td> <font color="#EE2C2C"> Cidade </font> </td>
							<td> <font color="#EE2C2C"> CPF/CNPJ </font> </td>
						  </tr> ');
					for ($x = 0; $x < $i ; $x++ )
					{
						echo('<tr> 
									<td> <a href="../horario/busca_h1.php?&c='.$cliente[$x+1].'&s='.$sem.'&p='.$p.'&n='.$n.'"> '.$cliente[$x].' </a> </td>
									<td> '.$cliente[$x + 2].' </td>
									<td> '.$cliente[$x + 1].' </td>
									</a>
							  </tr>');
						$x = $x + 2;
					}
					echo(' </table> ');
					echo("</font>");
					
					
					?>
                    </div>
</body>
</html>