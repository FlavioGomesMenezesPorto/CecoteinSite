<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Agendar </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
        <script type="text/javascript">
			function submitform()
			{
				if(document.myform.onsubmit &&
				!document.myform.onsubmit())
				{
					return;
				}
			 document.myform.submit();
			}
		</script>
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
					$id_cli = $_POST["nome"];
					
					$nome = $_POST['nome'];
					$end = $_POST['end'];
					$bairro = $_POST['bairro'];
					$cidade = $_POST['cidade'];
					$estado = $_POST['estado'];
					$tel = $_POST['tel'];
					$obs = $_POST['obs']; 
					$id_hor = $_POST['id_hor'];
					$id = $_POST["id"];
					
					//$semana = $_POST['semana'];
					$semana = !empty($_POST["semana"])?$_POST["semana"]:"";
					$hora = $_POST['hora'];
					$data = $_POST['data'];

					$x = 0;
					$i = 0;
					//$cli = mysql_query("Select id_cliente_pro, nome_pro, cidade_pro, cpf_pro from clientes_pro where nome_pro like '%".$id_cli."%'");
					$cli = mysql_query("Select cpnjcpf_cli, nome_cli, cidade_cli, endereco_cli, bairro_cli, estado_cli, telefone1_cli from cliente where nome_cli like '%".$id_cli."%' order by nome_cli");
					
					/*echo("Select cpnjcpf_cli, nome_cli, cidade_cli, endereco_cli, bairro_cli, estado_cli, telefone1_cli from cliente where nome_cli like '%".$id_cli."%' order by nome_cli");*/
					while ($row = mysql_fetch_assoc($cli))
					{
						$cliente[$i] = $row['nome_cli'];
						$cliente[$i+1] = $row['cpnjcpf_cli'];
						$cliente[$i+2] = $row['cidade_cli'];
						$cliente[$i+3] = $row['endereco_cli'];
						$cliente[$i+4] = $row['bairro_cli'];
						$cliente[$i+5] = $row['estado_cli'];
						$cliente[$i+6] = $row['telefone1_cli'];
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
					echo('<form name="myform" id="myform" action="altera_horario.php" method="post">');
					
						echo('<input type="hidden" name="data" value="'.$data.'"> <!-- data -->
						<input type="hidden" name="id" value="'.$id.'">  <!-- id profissional -->
						<input type="hidden" name="hora" value="'.$hora.'"> <!-- hora -->
						<input type="hidden" name="obs" value="'.$obs.'">  <!-- obs -->
						<input type="hidden" name="id_hor" value="'.$id_hor.'">'); //id da tabela

					for ($x = 0; $x < $i ; $x++ )
					{
						echo('<tr> 
						<td> 
									<a href="altera_horario.php?id_cli='.$cliente[$x + 1].'&data='.$data.'&id='.$id.'&id_hor='.$id_hor.'&hora='.$hora.'&obs='.$obs.'&nome='.$cliente[$x].'&bairro='.$cliente[$x + 4].'&cidade='.$cliente[$x + 2].'&end='.$cliente[$x + 3].'&estado='.$cliente[$x + 5].'&tel='.$cliente[$x + 6].'"> 
									'.$cliente[$x].' </a></td><!--NOME-->
									<td> '.$cliente[$x + 2].' </td> <!--CIDADE-->
									<td> '.$cliente[$x + 1].' </td> <!--CPF/CNPJ-->
									</a>
							  </tr>');
						
						echo('
						
						');
						$x = $x + 2;
					echo('</form>');
					//<input type="hidden" name="nome" 	value="'.$cliente[$x].'"> <!-- NOME -->	
					//<input type="hidden" name="id_cli"  value="'.$cliente[$x + 1].'"> <!-- CPF/CNPJ -->
					//<input type="hidden" name="bairro" 	value="'.$cliente[$x + 4].'"> <!-- BAIRRO -->
					//<input type="hidden" name="cidade" 	value="'.$cliente[$x + 2].'"> <!-- CIDADE -->
					//<input type="hidden" name="end" 	value="'.$cliente[$x + 3].'"> <!-- ENDERECO -->
					//<input type="hidden" name="estado" 	value="'.$cliente[$x + 5].'"> <!-- ESTADO -->
					//<input type="hidden" name="tel" 	value="'.$cliente[$x + 6].'"> <!-- TELEFONE -->
					}
					echo(' </table> ');
					echo("</font>");	
				?>           
                
            </div>
         </div>
	</body>
</html>