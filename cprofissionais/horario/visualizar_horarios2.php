<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Horários </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
        <script src="../funcoes/mascaras.js" ></script>
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
		<div class="principal">

            <div id="cabeca" >
                
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                <!---<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
				header('Content-Type: text/html; charset=utf-8');
					include ("../funcoes/menu-prof.html");
				?>
            </div>
            <div class="principal" style="top: 183px; text-align:center">
            	<p align="right"> <a href="../principais/prof_princ.php"><input type="button" name="voltar" value="Voltar"></a> </p>
           	   <font color="#FFFFFF"><center>
            	<?php
                    session_start();
                    include '../funcoes/conecta.php';
					include '../funcoes/somaHora.php';
					include '../funcoes/funcoes.php';
					
                    mysql_select_db(BASE,$cn)or die(mysql_error());
                    date_default_timezone_set('UTC');
					
                   if(isset($_COOKIE['pro']))
						$id = $_COOKIE["pro"];
					else
						$id = 0;
					
					$dia_1 = date('d-m-Y');	// Salva data atual
					$id_pro = !empty($_GET["p"])?$_GET["p"]:$id;
					$sem = !empty($_POST["dt"])?$_POST["dt"]:$dia_1; // Salva o valor da data passada por post
					$flag = 0;
					$d = 0;
					$cont = 0;
					$aux = 0;
					$menor = '';
					
					echo('<img src="../imagens/visualizar_horarios.png" > <br><Br>');
					
					mysql_select_db(BASE,$cn)or die(mysql_error());
					
					$pesquisa = mysql_query("Select tipo, nome_pro from cadastro_profissionais where id_pro = '$id_pro'") or die (mysql_error());
					$tipo = mysql_fetch_row($pesquisa);
					
					if ($tipo[0] == 'empresa') 
					{
						echo('<br><Br><br> Não é possível visualizar os horários da empresa, visualize-os por <a href="../principais/emp_prof.php"><font color="#FF0000">profissional</font></a>');
					}
					else
					{
						$pesquisa = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id_pro'")or die(mysql_error());
						 
						$horario1 = mysql_fetch_row($pesquisa);
						if ( $horario1[0] == '')
						{
							echo(' <br><br><br><img src="../imagens/atencao.png" width="60px" height="60px" align="middle">   &nbsp&nbsp&nbsp&nbsp&nbsp Não foi possível encontrar os horários! ');
						}
						else
						{
							$resultado = somahora($horario1[0],$horario1[2]);
							
							//echo ($horario[0].'   Mostrando horario 0');
							//echo('<br>');
							//echo($horario[2]. '  Mostrando horario 2');
							//echo('<br>');
							//echo($resultado. ' Mostrando resultado' );
							//echo('<br>');
							
							$x = 0;
							$de = 0;
							$ate = 1;
							$tem = 2;
							$aux = 0;
							$ct = 0;  // Controla os valores por períodos do dia
							
							$i = 2; //intervalo
							//$menor = $horario1[2]; //define a menor hora como a primeira para fins de comparação
							//echo($menor.'  : menor - primeiro <br><br>');
							
							//$c = 0; //hora de início
							//$hmenor = $horario1[0];  //define a menor hora como a primeira para fins de comparação
							//echo($hmenor.'  : hmenor - primeiro <br><br>');
							
							//$f = 1 ; //hora final
							//$maior = $horario1[1]; //define a maior hora como a primeira para fins de comparação
							//echo($maior.'  : maior  - primeiro <br><br>');
							
							$i = 0;
							// while ( $i <= 83 )
							/*while ( $i <= 20 )  // Procura o menor horário por período
							{
								//Passa os horários de string para time
								echo($horario1[$i].' horário inicial   '.$horario1[$i+1].' horario final    '.$i.'   : i <br><br>');
								if (( $horario1[$i] <> '00:00:00') && ( $horario1[$i+2] <> '00:00:00'))
								{ //  horário inicial                   //intervalo
									echo($i.'  : i <br><br>');
									if ($menor == '')
									{
										$menor = $horario1[$i+2];  // menor intervalo
										$hmenor = $horario1[$i];   //menor horário inicial
 										$maior = $horario1[$i+1];  //maior horário final
										echo($menor.'  : menor - primeiro <br><br>');
										echo($hmenor.'  : hmenor - primeiro <br><br>');
										echo($maior.'  : maior  - primeiro <br><br>');
									}
									$hor1 = strtotime($horario1[$i+2]);
									echo($hor1.'   : hor 1 <br><br> ');
									$hor2 = strtotime($menor); 
									echo($hor2.'   : hor 2 <br><br> ');
									//Define o menor intervalo de atendimento
									if (( $hor1 < $hor2 ) && ( $hor1 != 0 ))
										$menor = $horario1[$i+2];
								}
								
								//Passa os horários de string para time
								if (( $horario1[$i] <> '00:00:00') && ( $hmenor <> '00:00:00'))
								{
									$hor3 = strtotime($horario1[$i]);
									$hor4 = strtotime($hmenor); 
									//Define qual é o menor horário de início
									if ($hor3 < $hor4 )
										$hmenor = $horario1[$i];
								}
															
								//Passa os horários de string para time
								if (( $horario1[$i+1] <> '00:00:00') && ( $maior <> '00:00:00'))
								{
									$hor5 = strtotime($horario1[$i+1]);
									$hor6 = strtotime($maior); 
									//Define qual é o maior horário de fim
									if ($hor5 > $hor6 )
										$maior =  $horario1[$i+1];
								}
								//$f = $f + 3;
								$i = $i + 3;
								echo($menor.'  : menor <br><br> ');
							} // Fecha o while -- achou os valores chave
							
							$hlateral[0] = $hmenor;
							$i = 0;
							//Monta a grade de horários lateral
							while( $hlateral[$i] <= $maior )
							{
								echo(somahora($hlateral[$i],$menor).' somahora('.$hlateral[$i].','.$menor.'<br><BR>');
								$i = $i + 1;
								$hlateral[$i] = somahora($hlateral[$i-1],$menor);	
								//$i = $i + 1; // i vai ser considerado a quantidade de horários de atendimento
								echo($hlateral[$i-1].'   : hlateral <br><br>');
							}
							
							$hor1 = $hlateral[$i];
							$hor2 = $maior;
							if ($hor1 >= $hor2)
							{// para não deixar os horários maiores
								$hlateral[$i] = '';	
								$i = $i - 1;
								echo($hlateral[$i-1].'   : hlateral <br><br>');
							} */
							
							//$ultimo[0] = 0;
							
							/* for( $aux = 0 ; $aux <= $i ; $aux++ )
							{   //Procura quantos registros tem antes do meio-dia
								$hor1 = strtotime($hlateral[$aux]);
								$hor2 = strtotime('6:00:00');
								$hor3 = strtotime('12:00:00');
								if (($hor1 <= $hor3) && ($hor1 > $hor2))
									$ct = $ct + 1;
							} */
							
							$hl = 0;
							//Calculo dos valores chave da manhã
							$retorno1 = calculaInt(0,20);
							$hlateral1 = $retorno1[3];
							$ct1 = 0;
							while( $hlateral1[$ct1] <> '' )
							{
								$hlateral[$hl] = $hlateral1[$ct1];
								echo($hlateral[$hl].' :  hlteral1  <br><br>');
								$ct1 = $ct1 + 1;
								$hl = $hl + 1;
							}
							echo($hl.'   : hl 1 <br><Br>');
							//Calculo dos valores chave da tarde
							$retorno2 = calculaInt(21,41);
							$hlateral2 = $retorno2[3];
							$ct2 = 0;
							while( $hlateral2[$ct2] <> '' )
							{
								echo($hlateral[$hl-1].' :  hlteral2  <br><br>');
								echo($hl.'   : hl 1 <br><Br>');
								echo($ct2.'   : ct2 <br><Br>');
								$hlateral[$hl] = $hlateral2[$ct2];
								echo($hlateral[$hl].' :  hlteral2  <br><br>');
								$ct2 = $ct2 + 1;
								$hl = $hl + 1;
							}
							
							//Calculo dos valores chave da noite
							$retorno3 = calculaInt(42,62);
							$hlateral3 = $retorno3[3];
							$ct3 = 0;
							while( $hlateral3[$ct3] <> '' )
							{
								$hlatera[$hl] = $hlateral3[$ct3];
								echo($hlateral[$hl].' :  hlteral3  <br><br>');
								$hl = $hl + 1;
								$ct3 = $ct3 + 1;
							}
								
							//Calculo dos valores chave da manhã
							$retorno4 = calculaInt(63,83);
							$hlateral4 = $retorno4[3];
							$ct4 = 0;
							while( $hlateral4[$ct4] <> '' )
							{
								$hlatera[$hl] = $hlateral4[$ct4];
								echo($hlateral[$hl].' :  hlteral4  <br><br>');
								$hl = $hl + 1;
								$ct4 = $ct4 + 1;
							}
															
							echo($i.'  valor de i antes do while  <br><br>');
							
							//$hl = 0; //indice do vetor lateral principal
							//Verifica os horários por dia 
							while ( ( $de <= 18 ) && ( $ate <= 19 ) && ( $tem <= 20 ) )
							{
								//echo ("<br>".$hor[$de]."   Mostrando horário ".$de." <br><br>");
								//echo ("<br>".$hor[$ate]."   Mostrando horário ".$ate." <br><br>");
								//echo ("<br>".$hor[$tem]."   Mostrando horário ".$tem." <br><br>");
								//if ($horario1[$de] && $horario1[$ate] != '00:00:00')
								//{
								
								//Se houver horários disponíveis
								$ct = 0;
								//Conta quantos registros tem no vetor $hlateral1
																
								/* for( $aux = 0 ; $aux <= $i ; $aux++ )
								{   //Procura quantos registros tem antes do meio-dia
									$hor1 = strtotime($hlateral1[$aux]);
									$hor2 = strtotime('6:00:00');
									$hor3 = strtotime('12:00:00');
									if (($hor1 <= $hor3) && ($hor1 > $hor2))
										$ct = $ct + 1;
								} */
								
								echo($de.'  : de <br><br>');
								$aux = 0;
								//Montando as respostas dos dias - antes do meio-dia
								$resultado = $horario1[$de];
								echo($hlateral1[$aux].'  : hlateral <br><br>');
								echo($resultado.'  : resultado <br><br>');
								echo($ct1.'  : ct <br><br>');
								
								//Verifica se os horários são iguais a resposta
								for ($aux = 0 ; $aux < $ct1 ; $aux++ )
								{ 
									echo('A <br><br><br>'); 
									if ( $resultado = $hlateral1[$aux] )
									{   echo('B <br><br><br>');
										// Se for igual manda a resposta
										$resposta[$x][$d] = $resultado;
										echo($resposta[$x][$d].'   : Mostrando resposta <br>');
										$resultado = somahora($resposta[$x][$d], $horario1[$tem]);
										echo($horario1[$tem].'  : horario[tem] <br><br>');
										$x = $x + 1;
									}
									else
									{	echo('C <br><br><br>');
										//senão, manda vazio pra resposta
										$resposta[$x][$d] = '';
										$x = $x + 1;	
									}
								}

								//Montando os resultados de depois do meio-deia
								/*for( $aux = $x + 1 ; $aux <= $i ; $aux++ )
								{   
									echo('D <br><br><br>');
									//Procura quantos registros tem depois do meio-dia e antes das 18:00
									$hor1 = strtotime($hlateral[$aux]);
									$hor2 = strtotime('12:00:00');
									$hor3 = strtotime('18:00:00');
									if (($hor1 <= $hor3) && ($hor1 > $hor2))
										$ct = $ct + 1;
									echo('D <br><br><br>');
								}*/
								$resultado = $horario1[$de+21];
								for ($aux = 0 ; $aux < $ct2 ; $aux++ )
								{   echo('E <br><br><br>');
									if ( $resultado = $hlateral2[$aux] )
									{   echo('F <br><br><br>');
										// Se for igual manda a resposta
										$resposta[$x][$d] = $resultado;
										echo($resposta[$x][$d].'   : Mostrando resposta <br><br>');
										$resultado = somahora($resposta[$x][$d], $horario1[$tem+21]);
										$x = $x + 1;
									}
									else
									{	echo('G <br><br><br>');
									//senão, manda vazio pra resposta
										$resposta[$x][$d] = '';
										$x = $x + 1;	
									}
								}
								
								//Montando os resultados de depois das seis da tarde
								/*for( $aux = $x + 1 ; $aux <= $i ; $aux++ )
								{   echo('H <br><br><br>');
									//Procura quantos registros tem depois das 18:00 e antes das 24:00
									$hor1 = strtotime($hlateral[$aux]);
									$hor2 = strtotime('18:00:00');
									$hor3 = strtotime('24:00:00');
									if (($hor1 <= $hor3) && ($hor1 > $hor2))
										$ct = $ct + 1;
								} */
								
								//Montando as respostas dos dias - depois das 18:00 e antes das 24:00
								$resultado = $horario1[$de+42];
								for ($aux = 0 ; $aux < $ct3 ; $aux++ )
								{   echo('I <br><br><br>');
									if ( $resultado = $hlateral3[$aux] )
									{   echo('J <br><br><br>');
										// Se for igual manda a resposta
										$resposta[$x][$d] = $resultado;
										echo($resposta[$x][$d].'   : Mostrando resposta <br><br>');
										$resultado = somahora($resposta[$x][$d], $horario1[$tem+42]);
										$x = $x + 1;
									}
									else
									{	echo('K <br><br><br>');
										//senão, manda vazio pra resposta
										$resposta[$x][$d] = '';
										$x = $x + 1;	
									}
								}
								
								//Montando os resultados até as seis da manhã
								for( $aux = $x + 1 ; $aux <= $i ; $aux++ )
								{   echo('L <br><br><br>');
									//Procura quantos registros até as seis da manhã
									$hor1 = strtotime($hlateral4[$aux]);
									$hor2 = strtotime('6:00:00');
									$hor3 = strtotime('00:00:00');
									if (($hor1 <= $hor3) && ($hor1 > $hor2))
										$ct = $ct + 1;
								}
								//Montando as respostas dos dias - até as seis da manhã
								$resultado = $horario1[$de+63];
								for ($aux = 0 ; $aux < $ct4 ; $aux++ )
								{   echo('M <br><br><br>');
									if ( $resultado = $hlateral[$aux] )
									{   echo('N <br><br><br>');
										// Se for igual manda a resposta
										$resposta[$x][$d] = $resultado;
										echo($resposta[$x][$d].'   : Mostrando resposta <br><br>');
										$resultado = somahora($resposta[$x][$d], $horario1[$tem+63]);
										$x = $x + 1;
									}
									else
									{	echo('O <br><br><br>');
										//senão, manda vazio pra resposta
										$resposta[$x][$d] = '';
										$x = $x + 1;	
									}
								}
								echo('P <br><br><br>');
								$de = $de + 3;
								$ate = $ate + 3;
								$tem = $tem + 3;
								$d = $d + 1;  // Marca que mudou o dia
								$x = 0;
							}
									
									//$resposta[$x][$d] = $horario1[$de]; //Recebe o primeiro horário
									//echo ($x.'   Mostrando X  <br> ');
									//echo($d.' : d');
									//echo($resposta[$x][$d].'   Mostrando resposta <br>');
									//$x = $x + 1;
									//echo ($hor[$ate].' hora[ate] <br>');
									
									//while ( $resposta[$x][$d] < $horario1[$ate] )
									//{// enquanto o horário for menor que o limite
									
										//echo($resposta[$x][$d].'   Mostrando resultado[' .$x. '][ '.$d.' ] <br>');
									//	$x = $x + 1;  
									//	$resposta[$x][$d] = somahora($resposta[$x-1][$d],$horario1[$tem]);
									//}
									
									//echo($resposta[$x][$d].'   Mostrando resposta '.$x.' ultimo :  '.$ultimo[$d].'<br>');
									//$x = $x + 1;
									//echo ($hor[$ate].' hora[ate] <br>');
									//if ($resposta[$x][$d] > $horario1[$ate])
									//{
									//	$resposta[$x][$d]= '';
										
										//echo($resposta[$x][$d].'   Mostrando resultado[' .$x. '][ '.$d.' ] <br>');
									//}
									//$ultimo[$d] = $x;
									//echo($d.' d <br>');
									//echo($ultimo[$d] = $x.' : $ultimo[' .$d. '] = ' .$x); 
								//}
								//echo($d.'  : d <br><br>');
								//if ( $d >= 1 )
								//{
									//if (( $ultimo[$d-1]) < ($ultimo[$d]))
									//{
									//	for ($x = 0 ; $x < $ultimo[$d] ; $x++ )
									//		$resposta[$x][$d-1] = ' ';	
									//}
								//} 
								// Vai para o mesmo horário do próximo dia
								//$de = $de + 3;
								//$ate = $ate + 3;
								//$tem = $tem + 3;
								////$d = $d + 1;  // Marca que mudou o dia
								//$x = 0;
								//if ( $de > 22)  // Se está no último horário da manha
								//{
								//	if (($d == 6) && ( $horario1[$de] == '00:00:00' ))
								//		$x = $ultimo[$d-1];
									//else
									//	$x = $ultimo[$d];
								//}
								
								// Se o mesmo horário no proximo dia for igual a 0, vai para o próximo dia
								//if ($horario1[$de] && $horario1[$ate] == '00:00:00') 
								//{
								//	$de = $de + 3;
								//	$ate = $ate + 3;
								//	$tem = $tem + 3;
									//$x = $ultimo[$d-1];
									//$d = 0;
								//}
							//} 
							//$ultimo[6] = -1;
							//$d = $d + 1;	
							//$x = 0;
							//for ($d = 0 ; $d < 7 ; $d++)
							//{
								
								//echo($d. ', '.$x.' : d e x <br>');
							//	if ( $x < $ultimo[1])
							//	{
									//echo($d. ', '.$x.' : d e x <br>');
							//		if ( $x > $ultimo[$d])
							//			$resposta[$x][$d] = ' ';
							//	//	
									//echo($ultimo[$d]. ' : ultimo <br>');
							//		if ($d == 6)
								//	{
								//		$x = $x + 1;
								//		$d = -1;
								//	}
							//	}
																		
							//}
							$tempo = strtotime($sem);
							
							$semana = date('l',$tempo);
							$data[0] = date('Y-m-d',$tempo);
							$dt[0] = date('d-m-Y',$tempo);
							
							//Gravando datas
							$timestamp = strtotime($sem.'+1 days');
							$data[1] = date('Y-m-d', $timestamp);
							$dt[1] = date('d-m-Y', $timestamp);
							//echo ($data[1].'   : Mostrando data[1] <br>');
							
							$timestamp = strtotime($sem.'+2 days');				
							$data[2] = date('Y-m-d', $timestamp);
							$dt[2] = date('d-m-Y', $timestamp);
							//echo ($data[2].'   : Mostrando data[2] <br>');
							
							$timestamp = strtotime($sem.'+3 days');				
							$data[3] = date('Y-m-d', $timestamp);
							$dt[3] = date('d-m-Y', $timestamp);
							//echo ($data[3].'   : Mostrando data[3] <br>');
							
							$timestamp = strtotime($sem.'+4 days');				
							$data[4] = date('Y-m-d', $timestamp);
							$dt[4] = date('d-m-Y', $timestamp);
							//echo ($data[4].'   : Mostrando data[4] <br>');
							
							$timestamp = strtotime($sem.'+5 days');				
							$data[5] = date('Y-m-d', $timestamp);
							$dt[5] = date('d-m-Y',$timestamp);
							//echo ($data[5].'   : Mostrando data[5] <br>');
							
							$timestamp = strtotime($sem.'+6 days');				
							$data[6] = date('Y-m-d', $timestamp);
							$dt[6] = date('d-m-Y', $timestamp);
							//echo ($data[6].'   : Mostrando data[6] <br>');
							
							//Gravando dias da semana
							$dia_semana[0] = 'Segunda-feira';
							$dia_semana[1] = 'Terça-feira';
							$dia_semana[2] = 'Quarta-feira';
							$dia_semana[3] = 'Quinta-feira';
							$dia_semana[4] = 'Sexta-feira';
							$dia_semana[5] = 'Sábado';
							$dia_semana[6] = 'Domingo';
							
							if (($semana == 'Monday') || ($semana == 'Segunda-feira'))
							{
								$dia_semana[0] = 'Segunda-feira';
								$dia_semana[1] = 'Terça-feira';
								$dia_semana[2] = 'Quarta-feira';
								$dia_semana[3] = 'Quinta-feira';
								$dia_semana[4] = 'Sexta-feira';
								$dia_semana[5] = 'Sábado';
								$dia_semana[6] = 'Domingo';		
							}
							
							if (($semana == 'Tuesday') || ($semana == 'Terça-feira'))
							{
								$dia_semana[6] = 'Segunda-feira';
								$dia_semana[0] = 'Terça-feira';
								$dia_semana[1] = 'Quarta-feira';
								$dia_semana[2] = 'Quinta-feira';
								$dia_semana[3] = 'Sexta-feira';
								$dia_semana[4] = 'Sábado';
								$dia_semana[5] = 'Domingo';		
							}
							
							if (($semana == 'Wednesday') || ($semana == 'quarta-feira'))
							{
								$dia_semana[5] = 'Segunda-feira';
								$dia_semana[6] = 'Terça-feira';
								$dia_semana[0] = 'Quarta-feira';
								$dia_semana[1] = 'Quinta-feira';
								$dia_semana[2] = 'Sexta-feira';
								$dia_semana[3] = 'Sábado';
								$dia_semana[4] = 'Domingo';		
							}
							
							if (($semana == "Thursday") || ($semana == 'Quinta-feira'))
							{
								$dia_semana[4] = 'Segunda-feira';
								$dia_semana[5] = 'Terça-feira';
								$dia_semana[6] = 'Quarta-feira';
								$dia_semana[0] = 'Quinta-feira';
								$dia_semana[1] = 'Sexta-feira';
								$dia_semana[2] = 'Sábado';
								$dia_semana[3] = 'Domingo';		
							}
							
							if (($semana == 'Friday') || ($semana == 'Sexta-feira'))
							{
								$dia_semana[3] = 'Segunda-feira';
								$dia_semana[4] = 'Terça-feira';
								$dia_semana[5] = 'Quarta-feira';
								$dia_semana[6] = 'Quinta-feira';
								$dia_semana[0] = 'Sexta-feira';
								$dia_semana[1] = 'Sábado';
								$dia_semana[2] = 'Domingo';		
							}
							
							if (($semana == 'Saturday') || ($semana == 'Sábado'))
							{
								$dia_semana[2] = 'Segunda-feira';
								$dia_semana[3] = 'Terça-feira';
								$dia_semana[4] = 'Quarta-feira';
								$dia_semana[5] = 'Quinta-feira';
								$dia_semana[6] = 'Sexta-feira';
								$dia_semana[0] = 'Sábado';
								$dia_semana[1] = 'Domingo';		
							}
							
							if (($semana == 'Sunday') || ($semana == 'Domingo'))
							{
								$dia_semana[1] = 'Segunda-feira';
								$dia_semana[2] = 'Terça-feira';
								$dia_semana[3] = 'Quarta-feira';
								$dia_semana[4] = 'Quinta-feira';
								$dia_semana[5] = 'Sexta-feira';
								$dia_semana[6] = 'Sábado';
								$dia_semana[0] = 'Domingo';		
							}
			
							echo('			<form action="VerificaHorario1.php" method="post" name="horario">
											<table name="horario" border="2" bordercolor="#66CDAA" cellspacing="0" cellpadding="4" 	 style="width:800px;">								
												<tr> 
													<td align="center" rowspan="2"> Hora </td>
													<td align="center"> '.$dia_semana[0].' </td>
													<td align="center"> '.$dia_semana[1].' </td>
													<td align="center"> '.$dia_semana[2].' </td>
													<td align="center"> '.$dia_semana[3].' </td>
													<td align="center"> '.$dia_semana[4].' </td>
													<td align="center"> '.$dia_semana[5].' </td>
													<td align="center"> '.$dia_semana[6].' </td>
												 </tr> 
												 <tr>
													<td align="center"> '.$dt[0].'</td> 
													<td align="center"> '.$dt[1].'</td>
													<td align="center"> '.$dt[2].'</td>
													<td align="center"> '.$dt[3].'</td>
													<td align="center"> '.$dt[4].'</td>
													<td align="center"> '.$dt[5].'</td>
													<td align="center"> '.$dt[6].'</td> 
												</tr> ');
							$horario = 0;
							//$i = 0;	
							//echo($ultimo[1].' ultimo<br><Br>');
							
							// Verifica qual dia da semana tem os horários completos
							
							$aux = 0;
							
							//hl é o indice dos horários laterais	
							for ( $aux1 = 0 ; $aux1 < $hl ; $aux1++ )
							{   //montar linha por linha da tabela
								echo (' <tr>
											<td align="center"> '.$hlateral[$aux1].' </td> 
											<td align="center">');
										
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = '".$resposta[$i][$aux]."' and data_pro = '".$data[0]."'<br><br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[0]."'") or die (mysql_error());
										$horario = mysql_num_rows($teste);
										echo($horario.' horario <br><br> ');
										
										//echo($dia_semana[0]);
										
										//Recebe o dia da semana correspondente 
										$aux = MostraDia($dia_semana[0]);
										
										$dia = Verifica_dia($dia_semana[0]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										//echo('<br>'.$i.' : i <br><br>');
										//echo('<br>'.$aux.' : d <br><br>');
										//echo(':'.$resposta[$i][$aux].'   : Resposta<br><br>');
										if ($resposta[$aux1][$aux] < '12:00')
										{
											/* echo($resposta[$i].' resposta <br><br>');
											echo($data[0]. 'data <br><br>');
											echo($id_pro.' id_pro <br><br>');
											echo('function testeID($hora, $data, $id)');  */
											//echo verificaID($resposta[$i],$data[0], $id_pro);
											
											$id_hor = verificaID($resposta[$aux1][$aux], $data[0], $id_pro);
											//echo($horario1[$m].' horario 1 <br> '); 
											//if ( $horario1[$m] != '00:00:00' )
											if ( $resposta[$aux1][$aux] != '' )
											{
												if ( $horario == 0 )
													echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[0].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
													<td align="center">');
												else
													echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
														   <td align="center">');
											}
											else
												echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
										}
										else
										{
											if (($resposta[$aux1][$aux] >= '12:00' )&& ( $resposta[$aux1][$aux] <'18:00'))
											{
												if ( $horario1[$t] != '00:00:00' )
												{
													$id_hor = verificaID($resposta[$aux1][$aux],$data[0], $id_pro);
													if ( $horario == 0 )
														echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[0].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
														<td align="center">');
													else
														echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px">></a> </td>
															   <td align="center">');
												}
												else
													echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
											}
											else
											{
												if (($resposta[$aux1][$aux] >= '18:00' ) && ( $resposta[$aux1][$aux] <= '24:00' ))
												{
													$id_hor = verificaID($resposta[$aux1][$aux],$data[0], $id_pro);
													if($horario1[$n] != '00:00:00' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[0].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
												else
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[0], $id_pro);
													if ($horario1[$d] != '00:00:00' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[0].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
											}
											//$i = $i + 1;
										}
										
										// ---------------------------------
										
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[1]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[1]."'");
										$horario = mysql_num_rows($teste);
										echo($horario.' horario <br><br> ');
										
										$aux = MostraDia($dia_semana[1]);
										$dia = Verifica_dia($dia_semana[1]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										if ($resposta[$i][$aux] < '12:00')
										{
											$id_hor = verificaID($resposta[$i][$aux],$data[1], $id_pro);
											if ( $resposta[$aux1][$aux] != '' )
											{
												if ( $horario == 0 )
													echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[1].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
													<td align="center">');
												else
													echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
														   <td align="center">');
											}
											else
												echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
										}
										else
										{
											if (($resposta[$i][$aux] >= '12:00' )&& ( $resposta[$i][$aux] <'18:00'))
											{
												$id_hor = verificaID($resposta[$i][$aux],$data[1], $id_pro);
												if ( $resposta[$aux1][$aux] != '' )
												{
													if ( $horario == 0 )
														echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[1].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
														<td align="center">');
													else
														echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
															   <td align="center">');
												}
												else
													echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
											}
											else
											{
												if (($resposta[$i][$aux] >= '18:00' ) && ( $resposta[$i][$aux] <= '24:00' ))
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[1], $id_pro);
													if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[4].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
												else
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[1], $id_pro);
													if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[4].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
											}
										}
										// ---------------------------------
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[2]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[2]."'");
										$horario = mysql_num_rows($teste);
										echo($horario.' horario <br><br> ');
										
										$aux = MostraDia($dia_semana[2]);
			
										$dia = Verifica_dia($dia_semana[2]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										if ($resposta[$i][$aux] < '12:00')
										{
											$id_hor = verificaID($resposta[$i][$aux],$data[2], $id_pro);
											//if ( $horario1[$m] != '00:00:00'  )
											if ( $resposta[$aux1][$aux] != '' )
											{
												if ( $horario == 0 )
													echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[2].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
													<td align="center">');
												else
													echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
														   <td align="center">');
											}
											else
												echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
										}
										else
										{
											if (($resposta[$i][$aux] >= '12:00' )&& ( $resposta[$i][$aux] <'18:00'))
											{
												$id_hor = verificaID($resposta[$i][$aux],$data[2], $id_pro);
												if ( $horario1[$t] != '00:00:00' )
												{
													if ( $horario == 0 )
														echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[4].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
														<td align="center">');
													else
														echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
															   <td align="center">');
												}
												else
													echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
											}
											else
											{
												if (($resposta[$i][$aux] >= '18:00' ) && ( $resposta[$i][$aux] <= '24:00' ))
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[2], $id_pro);
													//if($horario1[$n] != '00:00:00' )
													if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[2].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
												else
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[2], $id_pro);
													//if ($horario1[$d] != '00:00:00' )
													if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[2].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
											}
										} 
										// ------------------------------------
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[3]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '$id_pro' and inicio_pro = '$resposta[$aux1][$aux]' and data_pro = '$data[3]'");
										$horario = mysql_num_rows($teste);
										echo($horario.' horario <br><br> ');
										
										$aux = MostraDia($dia_semana[3]);
										$dia = Verifica_dia($dia_semana[3]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										if ($resposta[$i][$aux] < '12:00')
										{
											$id_hor = verificaID($resposta[$i][$aux],$data[3], $id_pro);
											//if ( $horario1[$m] != '00:00:00'  )
											if ( $resposta[$aux1][$aux] != '' )
											{
												if ( $horario == 0 )
													echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[3].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
													<td align="center">');
												else
													echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
														   <td align="center">');
											}
											else
												echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
										}
										else
										{
											if (($resposta[$i][$aux] >= '12:00' )&& ( $resposta[$i][$aux] <'18:00'))
											{
												$id_hor = verificaID($resposta[$i][$aux],$data[3], $id_pro);
												if ( $horario1[$t] != '00:00:00' )
												//if ( $resposta[$aux1][$aux] != '' )
												{
													if ( $horario == 0 )
														echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[3].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
														<td align="center">');
													else
														echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
															   <td align="center">');
												}
												else
													echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
											}
											else
											{
												if (($resposta[$i][$aux] >= '18:00' ) && ( $resposta[$i][$aux] <= '24:00' ))
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[3], $id_pro);
													if($horario1[$n] != '00:00:00' )
													//if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[3].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
												else
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[3], $id_pro);
													//if ($horario1[$d] != '00:00:00' )
													if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[3].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
											}
										}
										
										/*	if ( $horario == 0 )
											{
												echo ('<a href="../cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i].'&d='.$data[3].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
												<td align="center">');
												//$horario = 1;	   
											}
											else
											{
												echo ('<a href="../horario/visualizar_atendimento.php?r='.$id_pro.'&d='.$data[3].'&h='.$resposta[$i].'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
													   <td align="center">');
												 
											}*/
										//}
										// -----------------------------------
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[4]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '$id_pro' and inicio_pro = '$resposta[$i][$aux]' and data_pro = '$data[4]'");
										$horario = mysql_num_rows($teste);
										echo($horario.' horario <br><br> ');
										
										$aux = MostraDia($dia_semana[4]);
										$dia = Verifica_dia($dia_semana[4]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										if ($resposta[$i][$aux] < '12:00')
										{
											$id_hor = verificaID($resposta[$i][$aux],$data[4], $id_pro);
											//if ( $horario1[$m] != '00:00:00'  )
											if ( $resposta[$aux1][$aux] != '' )
											{
												if ( $horario == 0 )
													echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[4].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
													<td align="center">');
												else
													echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
														   <td align="center">');
											}
											else
												echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
										}
										else
										{
											if (($resposta[$i][$aux] >= '12:00' )&& ( $resposta[$i][$aux] <'18:00'))
											{
												$id_hor = verificaID($resposta[$i][$aux],$data[4], $id_pro);
												if ( $horario1[$t] != '00:00:00' )
												//if ( $resposta[$aux1][$aux] != '' )
												{
													if ( $horario == 0 )
														echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[4].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
														<td align="center">');
													else
														echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
															   <td align="center">');
												}
												else
													echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
											}
											else
											{
												if (($resposta[$i][$aux] >= '18:00' ) && ( $resposta[$i][$aux] <= '24:00' ))
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[4], $id_pro);
													if($horario1[$n] != '00:00:00' )
													//if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[4].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
												else
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[4], $id_pro);
													if ($horario1[$d] != '00:00:00' )
													//if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[4].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
											}
										}
											
										/*	
										else
										{
											if ( $horario == 0 )
											{
												echo ('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i].'&d='.$data[4].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
												<td align="center">');
												//$horario = 1;	   
											}
											else
											{
												echo ('<a href="../horario/visualizar_atendimento.php?r='.$id_pro.'&d='.$data[4].'&h='.$resposta[$i].'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
													   <td align="center">');
												 
											}
										}*/
										// ----------------------
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[5]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '$id_pro' and inicio_pro = '$resposta[$aux1][$aux]' and data_pro = '$data[5]'");
										$horario = mysql_num_rows($teste);
										echo($horario.' horario <br><br> ');
										
										$aux = MostraDia($dia_semana[5]);
			
										$dia = Verifica_dia($dia_semana[5]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										if ($resposta[$i][$aux] < '12:00')
										{
											$id_hor = verificaID($resposta[$i][$aux],$data[5], $id_pro);
											//if ( $horario1[$m] != '00:00:00' )
											if ( $resposta[$aux1][$aux] != '' )
											{
												if ( $horario == 0 )
													echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[5].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
													<td align="center">');
												else
													echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
														   <td align="center">');
											}
											else
												echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
										}
										else
										{
											if (($resposta[$i][$aux] >= '12:00' )&& ( $resposta[$i][$aux] <'18:00'))
											{
												$id_hor = verificaID($resposta[$i][$aux],$data[5], $id_pro);
												if ( $horario1[$t] != '00:00:00' )
												//if ( $resposta[$aux1][$aux] != '' )
												{
													if ( $horario == 0 )
														echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[5].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
														<td align="center">');
													else
														echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
															   <td align="center">');
												}
												else
													echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
											}
											else
											{
												if (($resposta[$i][$aux] >= '18:00' ) && ( $resposta[$i][$aux] <= '24:00' ))
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[5], $id_pro);
													if($horario1[$n] != '00:00:00' )
													//if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[5].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
												else
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[5], $id_pro);
													if ($horario1[$d] != '00:00:00' )
													//if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[5].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>
															<td align="center">');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>
																   <td align="center">');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   <td align="center">');	
												}
											}
										}
										// ----------------------
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[6]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '$id_pro' and inicio_pro = '$resposta[$aux1][$aux]' and data_pro = '$data[6]'");
										$horario = mysql_num_rows($teste);
										echo($horario.' horario <br><br> ');
										
										$aux = MostraDia($dia_semana[6]);
			
										$dia = Verifica_dia($dia_semana[6]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										if ($resposta[$i][$aux] < '12:00')
										{
											$id_hor = verificaID($resposta[$i][$aux],$data[6], $id_pro);
											//if ( $horario1[$m] != '00:00:00'  )
											if ( $resposta[$aux1][$aux] != '' )
											{
												if ( $horario == 0 )
													echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[6].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>');
												else
													echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>');
											}
											else
												echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> ');	
										}
										else
										{
											if (($resposta[$i][$aux] >= '12:00' )&& ( $resposta[$i][$aux] <'18:00'))
											{
												$id_hor = verificaID($resposta[$i][$aux],$data[6], $id_pro);
												if ( $horario1[$t] != '00:00:00' )
												//if ( $resposta[$aux1][$aux] != '' )
												{
													if ( $horario == 0 )
														echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[6].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>');
													else
														echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td> ');
												}
												else
													echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td>');	
											}
											else
											{
												if (($resposta[$i][$aux] >= '18:00' ) && ( $resposta[$i][$aux] <= '24:00' ))
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[6], $id_pro);
													if($horario1[$n] != '00:00:00' )
													//if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[6].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td> ');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td>
														');	
												}
												else
												{
													$id_hor = verificaID($resposta[$i][$aux],$data[6], $id_pro);
													if ($horario1[$d] != '00:00:00' )
													//if ( $resposta[$aux1][$aux] != '' )
													{
														if ( $horario == 0 )
															echo('<a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$i][$aux].'&d='.$data[6].'"> <img src="../imagens/botoes/disponivel.png" width="90px" height="20px"> </a> </td>');
														else
															echo ('<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'"><img src="../imagens/botoes/ocupado.png" width="90px" height="20px"></a> </td>');
													}
													else
														echo ('<img src="../imagens/botoes/amarelo.png" width="90px" height="20px"> </td> 
										   ');	
												}
											}
										}
				//--------------------------------------------		
										//$i = $i + 1;	
									echo('</tr>');	
							}
							
							echo ('		</table>
										</form> ');
							
							echo('	
								<br><br>
							   <form name="data" method="post" action="../horario/visualizar_horarios.php?p='.$id_pro.'" style="text-align:left;">
									A partir da data: <input type="text" size="20" value="'.$sem.'" name="dt" id="dt" maxlength="10" onKeyPress="mascara(this, \'##-##-####\')" onBlur="TestaData(this)"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
									<input type="submit" value="Enviar" name="enviar" >
							   </form> ');		
					    }
					}		
					?>
				
			   
               </center>  
               </font> 
			
           </div> <!-- Fecha a div principal 1 -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>


<?php
function calculaInt($cont,$aux)
{
	global $horario1;
	$i = $cont;
	$menor = '';
	$hmenor = '';
	$maior = '';
	$cabec = '';
	echo($i.'   :i '.$aux.'   : aux  <br><br>');
	while ( $i <= $aux )  // Procura o menor horário por período
	{
		//Passa os horários de string para time
		echo($horario1[$i].' horário inicial    ||   '.$horario1[$i+1].' horario final      ||    '.$i.'   : i <br><br>');
		if (($horario1[$i] <> '00:00:00') && ($horario1[$i+2] <> '00:00:00'))
		{ //  horário inicial                   //intervalo
			echo($i.'  : i <br><br>');
			if ($menor == '')
			{
				$menor = $horario1[$i+2];  // menor intervalo
				$hmenor = $horario1[$i];   //menor horário inicial
				$maior = $horario1[$i+1];  //maior horário final
				echo($menor.'  : menor - primeiro <br><br>');
				echo($hmenor.'  : hmenor - primeiro <br><br>');
				echo($maior.'  : maior  - primeiro <br><br>');
			}
			$hor1 = strtotime($horario1[$i+2]);
			echo($hor1.'   : hor 1 <br><br> ');
			$hor2 = strtotime($menor); 
			echo($hor2.'   : hor 2 <br><br> ');
			//Define o menor intervalo de atendimento
			if (( $hor1 < $hor2 ) && ( $hor1 != 0 ))
				$menor = $horario1[$i+2];
		}
		
		//$x = $x + 3;
		
		//Passa os horários de string para time
		if (( $horario1[$i] <> '00:00:00') && ( $hmenor <> '00:00:00'))
		{
			$hor3 = strtotime($horario1[$i]);
			$hor4 = strtotime($hmenor); 
			//Define qual é o menor horário de início
			if ($hor3 < $hor4 )
				$hmenor = $horario1[$i];
		}
		//$c = $c + 3;
		
		//Passa os horários de string para time
		if (( $horario1[$i+1] <> '00:00:00') && ( $maior <> '00:00:00'))
		{
			$hor5 = strtotime($horario1[$i+1]);
			$hor6 = strtotime($maior); 
			//Define qual é o maior horário de fim
			if ($hor5 > $hor6 )
				$maior =  $horario1[$i+1];
		}
		//$f = $f + 3;
		$i = $i + 3;
		echo($menor.'  : menor <br><br> ');
	} // Fecha o while -- terminou de achar os valores chave
	
	if (( $menor == '') && ($hmenor == '') && ($maior == ''))
		$cabec[0] = '';
	else
	{
		$cabec[0] = $hmenor;
		$i = 0;
	
		//Monta a grade de horários lateral
		while( $cabec[$i] < $maior )
		{
			echo($menor.'  : menor   <br><br>');
			echo(somahora($cabec[$i],$menor).' =  somahora('.$cabec[$i].','.$menor.')<br><BR>');
			$i = $i + 1;
			$cabec[$i] = somahora($cabec[$i-1],$menor);	
			//$i = $i + 1; // i vai ser considerado a quantidade de horários de atendimento
			echo($cabec[$i-1].'   : hlateral <br><br>');
		}
		
		$hor1 = $cabec[$i];
		$hor2 = $maior;
		if ($hor1 >= $hor2)
		{
			// para não deixar os horários maiores
			$cabec[$i] = '';	
			$i = $i - 1;
			echo($cabec[$i].'   : hlateral <br><br>');
		}
	}
	
	//Monta a variável de retorno
	$retorno[0] = $menor;
	$retorno[1] = $hmenor;
	$retorno[2] = $maior;
	$retorno[3] = $cabec;
	return $retorno;
}
?>

