<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home Cliente</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/pagprincipal.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body>
		<div class="principal">
			<div class="menu" >
                <div id="cabeca" >
                    
                    <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
                </div>
                
               <!-- <div id="flash" >
                     <object width="1500px" height="65px">
                         <param name="movie" value="../menu/Menu-cliente.swf">
                         <param name="wmode" value="transparent" />
                         <embed wmode="transparent" src="../menu/Menu-cliente.swf" width="900px" height="60px" />
                    </object>-->
                    <?php
					include ("../funcoes/menu-cliente.html");
				?>
                </div>
                
			</div> <!-- Fecha a div Menu -->
			<!-- ##########################################################FIM MENU######################################## -->
           
	        <!-- ****************************** A partir daqui ira mudar a div -->
            <div class="conteudo">
            	<p align="right"><a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar" ></a> </p>
				<center> <img src="../imagens/horarios_marcados.png" width="290px" height="35px" title="Horários marcados" alt="Horários Marcados" name="horarios_marcados" > </center>
                <br>
				<?php
				    session_start();
					include '../funcoes/conecta.php';
					include '../funcoes/somaHora.php';
					include '../funcoes/funcoes.php';
					
                    mysql_select_db(BASE,$cn)or die(mysql_error());
                    date_default_timezone_set('UTC');
					
					if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
					else
						$id_cli = 0;
						
					$x = 0;
					$i = 0;
					
					
					$agora = date('Y-m-d');
					$teste = ("Select idprofissional_pro, inicio_pro, data_pro, id_pro from horarios_pro where id_cliente_pro = $id_cli and data_pro >= '$agora'");
					$pesquisa = mysql_query($teste) or die(mysql_error());

					while ($row = mysql_fetch_assoc($pesquisa))
					{
						$horario[$i][0] = $row['idprofissional_pro'];
						$horario[$i][1] = $row['inicio_pro'];
						$horario[$i][2] = $row['data_pro'];
						$timestamp = strtotime($horario[$i][2]);
						$horario[$i][2] = date('d-m-Y', $timestamp);
						$horario[$i][3] = $row['id_pro'];
						$i = $i + 1;
					}
					
					while ( $x < $i )
					{
						$id = $horario[$x][0];
						$profissionais[$x] = mysql_query("Select nome_pro, empresa from cadastro_profissionais where id_pro = '$id'") or die(mysql_error());
						$x = $x + 1;
					}
					if ($i == 0 )
					{
						echo('<center>
								<img src="../imagens/atencao.png" width="60px" height="60px" align="middle" border="0">
								<font size="+2"> Nenhum horário com a data a partir de hoje encontrado! </font>
							  </center>');
					}
					else
					{
						echo('<table border="0" cellpadding="2" cellspacing="10">
								<tr>
									<td> <font color="#CD3333"> <b> Profissional </b> </font> </td>
									<td> <font color="#CD3333"> <b> Empresa </b> </font> </td> 
									<td> <font color="#CD3333"> <b> Horário marcado </b> </font> </td>
									<td> <font color="#CD3333"> <b> Data do agendamento </b> </font> </td>
								</tr>');
								
						for ( $y = 0 ; $y < $x ; $y++ )
						{
							while( $row = mysql_fetch_assoc($profissionais[$y]) )
							{
								// $horario[$y][0] é o id do profissional
								echo('<tr>
										<td> <a href="../horario/desmarca_horario.php?r='.$horario[$y][0].'&h='.$horario[$y][1].'&i='.$horario[$y][3].'&d='.$horario[$y][2].'">'.$row['nome_pro'].'</a> </td>
										<td> '.$row['empresa'].' </td>
										<td> '.$horario[$y][1].' </td>
										<td> '.$horario[$y][2].' </td>
									  </tr> ');
								
							}
						}
						echo("</table>");
					}
					
				?>

            	</div> <!-- Fecha a div Corpo -->
			</div>
		</div>	 <!-- Fecha a div Principal -->
	</body>
</html>