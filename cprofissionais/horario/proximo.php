<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Horários </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       
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
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>-->
                <?php
				header('Content-Type: text/html; charset=utf-8');
					include ("../funcoes/menu_teste.html");
				?>
            </div>
             <?php
				
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;
					
				$id = $_GET['r'];
				session_start();
			
            echo ('<div id="menu"> ');
				include '../funcoes/menu.php';
			echo('</div> ');
			?>
            <div class="conteudo">
				<?	
					date_default_timezone_set('UTC');
					
					include '../funcoes/conecta.php';
					include '../funcoes/funcoes.php';	
                    include '../funcoes/somaHora.php';
                    
                    mysql_select_db(BASE,$cn)or die(mysql_error());
					
                    //echo($hoje.' : Hoje <br>');
                    $hor = $_GET["h"]; // horario de inicio 
                    $dt = $_GET["d"]; //data escolhida
                    $id = $_GET["r"]; //id profissional
                    $intervalo = $_GET["int"]; // intevalo de cada horario
                    //echo ($intervalo.' : intervalo <br>');
					
                    //-------
                    
                    $buscar[0] = 0 ;
                    $x = 0;
                    $flag = 0 ;
					$i = 0;
					$d = 1;
					$e = 1;
					$op1 = false;
					$op2 = false; 
					$pro = 0;
					$para = 0;
					
					// seleciona os horários do profissional
                    $termino = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
					
                    $ter = mysql_fetch_row($termino);
                    $hora = somahora($hor,$intervalo);
					$cont = 0;
					
					$data = strtotime($dt);
					$dia = date('l', $data);
					$data = date('Y-m-d', $data);
					//echo($dia.' : dia <br> ');
					
					$dia1 = Verifica_day($dia);
					
					$m = $dia1[0];
					$a = $dia1[1];
					$n = $dia1[2];
					$r = $dia1[3];
					
					$time1 = strtotime('00:00:00');
					$time2 = strtotime('06:00:00');
					$time3 = strtotime('12:00:00');
					$time4 = strtotime('18:00:00');
					$time5 = strtotime('24:00:00');
					$time = strtotime($hora);
					
					// horario da manha 06 - 12
					if(($time > $time2) && ($hora <= $time3) && ($para == 0 )) 
					{
						//echo('entrou no if 1 <br> ');
						$cont = $m + 1;
						if ($ter[$cont] == '00:00:00')
						{
							//echo('entrou no if 1.1 <br> ');
							$cont = $a + 1;
							$hora = $ter[$a];
							$intervalo = $ter[$a+2];
							if ($ter[$a+2] == '00:00:00')
							{
								//echo('entrou no if 1.3 <br> ');
								$timestamp = strtotime($data.' +1 day');
								$data = date('Y-m-d',$timestamp);
								$hora = $ter[$n];
								$intervalo = $ter[$n+2];
							}
							
						}
						$intervalo = $ter[$m+2];
						$para = 1;
					}
					
					// horario da tarde 12 - 18
					if(($time > $time3 ) && ($time <= $time4) && ($para == 0 )) 
					{
						//echo('entrou no if 2 <br> ');
						$cont = $a + 1 ;
						if ($ter[$cont] == '00:00:00')
						{
							//echo('entrou no if 2.1 <br> ');
							$cont = $n + 1;
							$hora = $ter[$n];
							$intervalo = $ter[$n+2];
							if ($ter[$n+2] == '00:00:00')
							{
								//echo('entrou no if 2.3 <br> ');
								$timestamp = strtotime($data.' +1 day');
								$data = date('Y-m-d',$timestamp);
								$hora = $ter[$m];
								$intervalo = $ter[$m+2];
								//echo($ter[$m+2].' ter <br> ');
							}
							
						}
						$intervalo = $ter[$a+2];
						$para = 1;
					}
					
					// horario da noite 18 - 24
					if(($time > $time4) && ($time <= $time5) && ($para == 0 )) 
					{
						//echo('entrou no if 3 <br> ');
						$cont = $n + 1;
						if ($ter[$cont] == '00:00:00')
						{
							//echo('entrou no if 3.1 <br> ');
							$cont = $r + 1;
							$hora = $ter[$r];
							$intervalo = $ter[$r+2];
							//echo($intervalo.' intervalo <br> ');
							if ($ter[$r+2] == '00:00:00')
							{
								//echo('entrou no if 3.2 <br> ');
								$timestamp = strtotime($data.' +1 day');
								$data = date('Y-m-d',$timestamp);
								$intervalo = $ter[$m+2];
								//echo($intervalo.' intervalo <br> ');
								$hora = $ter[$m];
								
							}
						}
						$intervalo = $ter[$n+2];
						$para = 1;
					}
					
					// horario da madrugada 00 - 06
					if(($time >  $time1) && ($time <= $time2) && ($para == 0 )) 
					{
						//echo('entrou no if 4 <br> ');
						$cont = $r + 1;
						if ($ter[$cont] == '00:00:00')
						{
							$cont = $m + 1;
							$hora = $ter[$m];
							$intervalo = $ter[$m+2];
							if ($ter[$m+23] == '00:00:00')
							{
								$timestamp = strtotime($data.' +1 day');
								$data = date('Y-m-d',$timestamp);
								$hora = $ter[$a];
								$intervalo = $ter[$a+2];
							}
						}
						$intervalo = $ter[$r+2];
						$para = 1;
					}
					
					//echo($intervalo.' intervalo');
					
					//echo($cont.' cont <br>');
					while ($flag == 0)
                    { 
						$tempo[0] = date('u'); // recebe a data atual
						
						if ( $flag == 0)
                        { // Se  não foi mostrada a mensagem ainda executa
							$x = 0;
							/*echo('<br>'.$hora.' : Hora <br> ');
							echo($flag. ' : flag <br>');
							echo($data.' : data <br> ');
							echo($ter[$cont].' ter [ '.$cont.' ] <br>'); */
							
                        	if (( $hora < $ter[$cont] ) && ( $hora != '00:00:00' ))
                            {  // ainda pode tem horario livre para aquele período
							
                                //echo(' entrou no if hora <br> ');
								$horario = mysql_query( "Select * from horarios_pro where idprofissional_pro = '$id' and data_pro = '$data'"); //recebe todos os horários do profissional
                               
							    //echo(mysql_num_rows($horario). ' : horario <br>');
								
                                //Se houver resultado na pesquisa
								//echo( mysql_num_rows($horario). ' colunas horarios <br> ');
                                if (( mysql_num_rows($horario) != 0 ) && ( $flag == 0 ))
                                {
									//echo('está no if igual <br> ');
									while ($row = mysql_fetch_assoc($horario))
                                    {
                                        $iniciocad[$i] = $row['inicio_pro']; // pega o valor do campo início
										//echo($iniciocad[$i].' inicio <br> ');
									 	$finalcad[$i] = somahora($iniciocad[$i],$intervalo);
										//verifica qual é o horário final daquele atendimento
										
                                        $i = $i + 1;
                                    }
									//echo($i." i <br> ");
									// coloca os valores do inicio do atendimento do profissional em ordem crescente
									for ( $aux1 = 0 ; $aux1 < $i ; $aux1++ )
									{
										for ( $aux2 = 0 ; $aux2 < $i ; $aux2++)
										{
											if ( $iniciocad[$aux2] > $iniciocad[$aux2+1])
											{
												$aux3 = $iniciocad[$aux2];
												$iniciocad[$aux2] = $iniciocad[$aux2+1];
												$iniciocad[$aux2+1] = $aux3;
												$aux3 = $finalcad[$aux2];
												$finalcad[$aux2] = $finalcad[$aux2+1];
												$finalcad[$aux2+1] = $aux3;
											}
										}
									}
									
									//echo($hora.' : Hora <br> ');
                                    $horario = mysql_query( "Select * from horarios_pro where idprofissional_pro = '$id' and inicio_pro = '$hora' and data_pro = '$data'");
									//echo( mysql_num_rows($horario). ' colunas horarios <br> ');
                                    //Se não houver resultado na pesquisa, não há nenhum horário marcada nesta hora de inicio
									if ( mysql_num_rows($horario) == 0 )
                                    {
                                        while (($x < $i ) && ($iniciocad[$x] != ''))
                                        {
											$time1 = strtotime($iniciocad[$x]);
											$time2 = strtotime($hora);
											$time3 = strtotime($finalcad[$x]);
                                            if  (($time1 < $time2) && ($time2 < $time3))
											{ //se o resultado estiver entre os horários de inicio e fim do profissional
											  	$op1 = true;
											  // para ir para o próximo horário
											}
											
											//echo($op1. ': mostrando op1 <br>'.$op2.' : mostrando op2 <br>');
											if($op1)
											{// se for verdadeira vai para o próximo horário
												if ($iniciocad[$x+1] == '')
												{
													$horario = $hora;
													$hora = somahora($hora, $intervalo); // vai para o próximo horário
													//echo ($hora.' : hora alterada <br>');
												}
										    }
                                            else
                                            { // se não salva os valores
										        $buscar[0] = 1;
                                                $buscar[1] = $data;
                                                $buscar[2] = $hora;
											}
                                            $x = $x + 1;
                                        }
									}
									else
									{ // se tiver horário marcado vai para o próximo horário de atendimento do profissional
										$hora = somahora($hora, $intervalo);
										
										if ($cont <= 20) 
										{
											$cont = $a + 1;
											$y = 1;
										}
										if (( $cont > 20 ) && ($cont <= 41 ))
										{
											$cont = $n + 1;
											$y = 2;
										}
											
										if (($cont > 41 ) && ($cont <= 62 ))
										{
											$cont = $d + 1;
											$y = 3;
										}
										if (($cont > 62 ) && ( $cont <= 82 ))
										{
											$cont = $a + 1;
											$y = 0;
										}
											
										
									}
								}
								// Se $horario == 0, não há horario marcada naquele dia
                                else
                                {
									/*echo('está no else igual <br> ');
									$ver[0] = strtotime($hora);
									$ver[1] = strtotime('00:00:00');
									$ver[2] = strtotime('06:00:00');
									$ver[3] = strtotime('12:00:00');
									$ver[4] = strtotime('18:00:00');
									$ver[5] = strtotime('24:00:00');
									
									$campo = controla_dia($dia,$id);
									echo($campo.' campo <br> ');
									echo($ver[0].' ver [0] <br>');
									echo($ver[1].' ver [1] <br>');
									echo($ver[2].' ver [2] <br>');
									echo($ver[3].' ver [3] <br>');
									echo($ver[4].' ver [4] <br>');
									echo($ver[5].' ver [5] <br>');
									
									if (($ver[0] >= $ver[2]) || ($ver[0] < $ver[3]))
									{
										if ($tem[$m] == '00:00:00')
										{
											$timestamp = strtotime($data.'+'.$e.' days');
											$dt = date('d-m-Y',$timestamp);
											//echo($dt.' : mostrando data <br>');
											$ini = $campo;
											$hr = mysql_fetch_row($ini);
											echo($hr.' hora alterada <br>');
											$hora = $hr[0];
											echo($hora. ' : Mostrando hora <br> ');
											$e = $e + 1;
										}
									}
									else
									{
										if (($ver[0] >= $ver[3]) || ($ver[0] < $ver[4]))
										{
											if ($tem[$a] == '00:00:00')
											{
												$timestamp = strtotime($data.'+'.$e.' days');
												$dt = date('d-m-Y',$timestamp);
												//echo($dt.' : mostrando data <br>');
												$ini = $campo;
												$hr = mysql_fetch_row($ini);
												echo($hr.' hora alterada <br>');
												$hora = $hr[0];
												echo($hora. ' : Mostrando hora <br> ');
												$e = $e + 1;
											}
										}
										else
										{
											if (($ver[0] >= $ver[4]) || ($ver[0] < $ver[5]))
											{
												if ($tem[$n] == '00:00:00')
												{
													$timestamp = strtotime($data.'+'.$e.' days');
													$dt = date('d-m-Y',$timestamp);
													//echo($dt.' : mostrando data <br>');
													$ini = $campo;
													$hr = mysql_fetch_row($ini);
													echo($hr.' hora alterada <br>');
													$hora = $hr[0];
													echo($hora. ' : Mostrando hora <br> ');
													$e = $e + 1;
												}
											}
											else
											{
												if (($ver[0] >= $ver[1]) || ($ver[0] < $ver[2]))
												{
													if ($tem[$d] == '00:00:00')
													{
														$timestamp = strtotime($data.'+'.$e.' days');
														$dt = date('d-m-Y',$timestamp);
														//echo($dt.' : mostrando data <br>');
														$ini = $campo;
														$hr = mysql_fetch_row($ini);
														echo($hr.' hora alterada <br>');
														$hora = $hr[0];
														
														echo($hora. ' : Mostrando hora <br> ');
														$e = $e + 1;
													}
												}
											}
										}
									}
								
								
								
								  */
								
									//echo($hora.' hora <br> ');
									//echo($data. ' : data atual <br> '); 
									$timestamp = strtotime($data);
									$data = date('d-m-Y', $timestamp);
                                    Mostrar_resultado($data,$hora,$hora,$id,$id_cli,$intervalo);
									// se mostrar o resultado o flag recebe 1 para não mostrar outra mensagem
                                    $flag = 1;
                                }
								if ( $buscar[0] == 1)
								{
									$timestamp = strtotime($data);
									$data = date('d-m-Y', $timestamp);
									 Mostrar_resultado($data,$hora,$hora,$id,$id_cli,$intervalo);
									$flag = 1;
								}
							}
							//vai para o próximo período
							else
                            {
								$hora = somahora($hora,$ter[$cont+1]);
								//echo(' entrou no else da hora <br><br> ');
								//echo($cont.' cont <br>');
								if ( $cont > 62 )
								{
									//echo(' Entrou no if 62 <br><br>');
									//echo($dia.' : dia <br>');
									$campo = controla_dia($dia, $id);
									//echo($campo.' : campo <br>');
									$timestamp = strtotime($data.'+'.$d.' days');
									$cont = $m;
									/*if (( date('l', $timestamp) == 'Sunday') || ( date('l', $timestamp) == 'Domingo'))
									{
										$d = $d + 1;
										$timestamp = strtotime($data.'+'.$d.' days');
									}*/
									$dt = date('d-m-Y',$timestamp);
									$ini = mysql_query($campo);
									$hr = mysql_fetch_row($ini);
									$hora = $hr[0];
									//echo($hr[0].' hora <br> ');
									//$d = $d + 1;
								}
								else
								{
									/*echo(' Entrou no else 62 <br><br>');
									echo($cont.' cont <br> ');
									echo($ter[$cont+20].' ter <br> '); */
									if ($ter[$cont+20] == '00:00:00') 
									{
										/*echo("Entrou no if soma <br>");
										echo($dia.' : dia <br>');
										echo($data. ' : data atual <br> '); 
										echo(' Soma mais um dia na data <br>');
										echo($d.' d <br> '); */
										$timestamp = strtotime($data.'+'.$d.' days');
										$dt = date('d-m-Y',$timestamp);
										$dia = date('l', $timestamp);
										//echo($dia.' dia <br>');
										$dia1 = Verifica_day($dia);
										$m = $dia1[0];
										$a = $dia1[1];
										$n = $dia1[2];
										$r = $dia1[3];
										
										//echo($m.' m '.$a.' a '.$n.' n '.$r.' r ');
										$cont = $m + 1;
										//echo($dt.' : mostrando data <br>');
										$campo = controla_dia($dia,$id);
										//echo($campo.' : campo <br> ');
										$ini = mysql_query($campo);
										$hr = mysql_fetch_row($ini);
										$hora = $hr[0];
										//echo($hora. ' : Mostrando hora <br> ');
										//$d = $d + 1;
										//echo($cont.' cont <br> ');
										$data = $dt;
									}
									else
										$cont = $cont + 21;
								}
                            }
						    //echo (' está no switch <br> ');
							/*switch ($cont)
							{
								case 0 : $cont = $a + 1;
										 break;
								case 1 : $cont = $n + 1;
										 break;
								case 2 : $cont = $r + 1;
										 break;
								case 3 : $cont = $m + 1;
										 break;
							}*/
						
						
						}
						$tempo[1] = date('u');
					}
				?>
	      	</div>
       </div>
	</body>
</html>