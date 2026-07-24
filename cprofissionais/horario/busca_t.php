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
					
					$nome = strtolower($nome);
					$cli = mysql_query("Select inicio_pro , data_pro, observacoes, id_pro from horarios_pro where observacoes like '%".$nome."%' and idprofissional_pro ='".$p."' order by data_pro");
					//	echo("Select inicio_pro , data_pro, obeservacoes, id_cliente_pro from horarios_pro where obeservacoes like '%".$nome."%' and id_profissionail_pro ='".$p."' order by data_pro");
					
					echo(' <img src="../imagens/horario.png" align="absmiddle" width="100" height="70"> &nbsp&nbsp&nbsp&nbsp&nbsp
						<font size="+1"> <font color="#00CCFF"> Horários que contém o texto: '.$nome.' </font>');
						
					echo(' <table cellpadding="5px" cellspacing="5px" align="center" width="600px"');
					echo('<tr> 
							<td> <font color="#EE2C2C"> Observações </font> </td>
							<td> <font color="#EE2C2C"> Data </font> </td>
							<td> <font color="#EE2C2C"> Hora </font> </td>
						  </tr> ');
					for ($z=0; $z<3; $z++) {
						if ($z==0){
							$nome = strtoupper($nome); // Converte tudo para maiusculo
						}
						if ($z==1){
							$nome = strtolower($nome); // Converte tudo para Minusculo
						}
						if ($z==2){
							$nome = ucfirst($nome); // Converte a orimeira letra da frase para maiusculo
						}
						$cli = mysql_query("Select inicio_pro , data_pro, observacoes, id_pro from horarios_pro where observacoes like '%".$nome."%' and idprofissional_pro ='".$p."' order by data_pro");

						while ($row = mysql_fetch_assoc($cli))
						{
							$cliente[$i] = $row['observacoes'];
							$cliente[$i+1] = $row['inicio_pro'];
							$cliente[$i+2] = $row['data_pro'];
							$cliente[$i+3] = $row['id_pro'];
								$i = $i + 4;
						}
						for ($x = 0; $x < $i ; $x++ )
						{
							//echo('testestes'.$cliente[$i+3]);
							echo('<tr> ');
								$converte = strtotime($cliente[$x+2]);
								$cliente[$x+2] = date('d-m-Y', $converte);
								echo('
										<td> <a href="../horario/visualizar_atendimento.php?&a='.$cliente[$x+3].'&r='.$p.'&d='.$sem.'&n='.$n.'"> '.$cliente[$x].' </a> </td>
										<td> '.$cliente[$x + 2].' </td>
										<td> '.$cliente[$x + 1].' </td>
										</a>
								  </tr>');
							$x = $x + 3;
						}
					}
					echo(' </table> ');
					echo("</font>");
					
					
					?>
                    </div>
</body>
</html>