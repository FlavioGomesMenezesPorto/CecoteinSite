<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Agendar </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex">
        <?php
	   //header('Content-Type: text/html; charset=utf-8');
	   header("Content-Type: text/html; charset=utf-8", true);
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
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-prof.html");
				?>
            </div>
            <?php
			if(isset($_COOKIE['pro'])){
				$id = $_COOKIE["pro"];
			
			
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
					//mysql_query("SET NAMES 'utf8'");
					//mysql_query('SET character_set_connection=utf8');
					//mysql_query('SET character_set_client=utf8');
					//mysql_query('SET character_set_results=utf8');
					
					$id_cli = $_POST["cliente"];
					//$id_cli = $_GET['valor'];

					$id     = $_GET["r"];
					$inicio = $_GET["i"];
					$data   = $_GET["d"];
					
					$i = 0;
					//$cli = mysql_query("Select id_cliente_pro, nome_pro, cidade_pro, cpf_pro from clientes_pro where nome_pro like '%".$id_cli."%'");
					$cli = mysql_query("Select cpnjcpf_cli , nome_cli, cidade_cli from cliente where nome_cli like '%".$id_cli."%' order by nome_cli");
					while ($row = mysql_fetch_assoc($cli))
					{
						$cliente[$i] = $row['nome_cli'];
						$cliente[$i+1] = $row['cpnjcpf_cli'];
						$cliente[$i+2] = $row['cidade_cli'];
						$i = $i + 3;
					}
					echo(' <img src="../imagens/horario.png" align="absmiddle" width="100" height="70"> &nbsp&nbsp&nbsp&nbsp&nbsp
					<font size="+1"> <font color="#00CCFF"> Selecione o cliente para o qual deseja marcar o horário: </font>');
					
					echo(' <table cellpadding="5px" cellspacing="5px" align="center" width="600px"');
					echo('<tr> 
							<td> <font color="#EE2C2C"> Cliente </font> </td>
							<td> <font color="#EE2C2C"> Cidade </font> </td>
							<td> <font color="#EE2C2C"> CPF/CNPJ </font> </td>
						  </tr> ');
					for ($x = 0; $x < $i ; $x++ )
					{
						echo('<tr> 
									<td> <a href="../horario/cad_horario_prof2.php?r='.$id.'&c='.$cliente[$x+1].'&i='.$inicio.'&d='.$data.'"> '.htmlspecialchars_decode($cliente[$x]).' </a> </td>
									<td> '.htmlspecialchars_decode(htmlentities($cliente[$x + 2])).' </td>
									<td> '.$cliente[$x + 1].' </td>
									</a>
							  </tr>');
						$x = $x + 2;
					}
					echo(' </table> ');
					echo("</font>");	
				}else{
					$id = 0;
				}
				?>           
                
            </div>
         </div>
	</body>
</html>