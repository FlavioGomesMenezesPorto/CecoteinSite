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
                
                
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                <!-- <object width="1500px" height="65px">
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
			
            echo ('<div id="menu">');
				include '../funcoes/menu.php';
			echo('</div> ');
			?>
            
            <div class="conteudo">
            	<?php
                
                    include '../funcoes/conecta.php';
					include '../funcoes/somaHora.php';
					include '../funcoes/funcoes.php';
					
                    mysql_select_db(BASE,$cn)or die(mysql_error());
                    date_default_timezone_set('UTC');
					
					$id = $_GET["r"];
					$t = 0;
					$y = 0;
					$i = 0;
					$buscar[0] = 0;
					$flag = 0;
					$aux = 0;
					$ct = 0;
					$temp = 0;
					$nao = 0;
					$diasem = '';
					
					// receber os dados do form anterior
                    for ( $x = 0; $x < 24 ; $x++ )
                    {
                        $hora[$x] = !empty($_POST["$x"])?$_POST["$x"]:'';
						$ct = $ct + 1;
					}
                    //$horario[0] = $_POST["man_seg_de"];	
                    $dia[0] = !empty($_POST["segunda"])?$_POST["segunda"]:'';
					$dia[1] = !empty($_POST["terca"])?$_POST["terca"]:'';
                    $dia[2] = !empty($_POST["quarta"])?$_POST["quarta"]:'';
                    $dia[3] = !empty($_POST["quinta"])?$_POST["quinta"]:'';
                    $dia[4] = !empty($_POST["sexta"])?$_POST["sexta"]:'';
                    $dia[5] = !empty($_POST["sabado"])?$_POST["sabado"]:'';
                    $dia[6] = !empty($_POST["domingo"])?$_POST["domingo"]:'';
					$data = $_POST["data"]; 
                    $timestamp = strtotime($_POST["data"]);
					
					for ( $x = 0 ; $x <= 6 ; $x++ )
					{
						if ($dia[$x] == '')
							$ct = $ct + 1;
					}
					if ($ct == 31)
						mostra_vazio($id,$id_cli);
					
					// Verificar o dia da semana correspondente ao dia marcado
					$semana = date('l',$timestamp);
					
					$aux = 0;
					// Verificar qual checkbox dos dias da semana está marcado 
					
					if (( $semana == 'Monday') || ( $semana == 'Segunda-feira'))
					{  
						for ( $aux = 0 ; $aux < 7 ; $aux++)
						{
							//echo($dia[$aux].' dia ['.$aux.'] <br> ');
							//echo($aux.' aux <br> ');
							//echo($t.' t <br> ');
							if ( $dia[$aux] != '' )
							{
								switch ($aux)
								{
									case 0 : $tempo[$t] = $data;
											 $temp = date('Y-m-d', $tempo[$t]);
											 $temp = date('l',$temp);
											 $t = $t + 1;
											 break;
									case 1 : $timestamp = strtotime('+1 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 2 : $timestamp = strtotime('+2 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
											 
									case 3 : $timestamp = strtotime('+3 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 4 : $timestamp = strtotime('+4 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 5 : $timestamp = strtotime('+5 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 6 : $timestamp = strtotime('+6 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
								}
								//echo($tempo[$t-1].' date <br>');
							}
						}
					}
					if (( $semana == 'Tuesday') || ( $semana == 'Terça-feira'))
					{  
						for ( $aux = 0 ; $aux < 7 ; $aux++)
						{
							if ( $dia[$aux] != '' )
							{
								//echo($aux.' aux <br>');
								switch ($aux)
								{
									case 1 : $tempo[$t] = $data;
											 $temp = date('Y-m-d', $tempo[$t]);
											 $temp = date('l',$temp);
											 $t = $t + 1;
											 break;
									case 2 : $timestamp = strtotime('+1 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 3 : $timestamp = strtotime('+2 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 4 : $timestamp = strtotime('+3 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 5 : $timestamp = strtotime('+4 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 6 : $timestamp = strtotime('+5 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 0 : $timestamp = strtotime('+6 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
								}
							}
						}
					}
					if (( $semana == 'Wednesday') || ( $semana == 'Quarta-feira'))
					{  
						for ( $aux = 0 ; $aux < 7 ; $aux++)
						{
							if ( $dia[$aux] != '' )
							{
								switch ($aux)
								{
									case 2 : $tempo[$t] = $data;
											 $temp1 = date('Y-m-d', $tempo[$t]);
											 $temp = date('l',$temp);
											 $t = $t + 1;
											 break;
									case 3 : $timestamp = strtotime('+1 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 4 : $timestamp = strtotime('+2 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 5 : $timestamp = strtotime('+3 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 6 : $timestamp = strtotime('+4 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 0 : $timestamp = strtotime('+5 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 1 : $timestamp = strtotime('+6 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
								}
							}
						}
					}
					if (( $semana == 'Thursday') || ( $semana == 'Quinta-feira'))
					{  
						for ( $aux = 0 ; $aux < 7 ; $aux++)
						{
							if ( $dia[$aux] != '' )
							{
								switch ($aux)
								{
									case 3 : $tempo[$t] = $data;
											 $temp1 = date('Y-m-d', $tempo[$t]);
											 $temp = date('l',$temp);
		                   					 $t = $t + 1;
											 break;
											 
									case 4 : $timestamp = strtotime('+1 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 5 : $timestamp = strtotime('+2 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 6 : $timestamp = strtotime('+3 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 0 : $timestamp = strtotime('+4 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 1 : $timestamp = strtotime('+5 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 2 : $timestamp = strtotime('+6 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp1 = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
								}
							}
						}
					}
					if (( $semana == 'Friday') || ( $semana == 'Sexta-feira'))
					{  
						for ( $aux = 0 ; $aux < 7 ; $aux++)
						{ // Verificar quantos dias faltam para chegar o compromisso
						
							//echo($dia[$aux].'  : Mostrando semana <br>');
							//echo($aux.' : Mostrando aux <br>');
							if ( $dia[$aux] != '' )
							{
								switch ($aux)
								{
									case 4 : $tempo[$t] = $data;
											 $temp = date('Y-m-d', $tempo[$t]);
											 $temp = date('l',$temp);
											 $t = $t + 1;
											 break;
									case 5 : $timestamp = strtotime('+1 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 6 : $timestamp = strtotime('+2 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 0 : $timestamp = strtotime('+3 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 1 : $timestamp = strtotime('+4 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 2 : $timestamp = strtotime('+5 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 3 : $timestamp = strtotime('+6 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
								}
							}
							//echo ($timestamp.'<br>');
							//echo($tempo[$x].'  : Mostrando tempo <br>');
						}
					}
					if (( $semana == 'Saturday') || ( $semana == 'Sabado'))
					{  
						
						for ( $aux = 0 ; $aux < 7 ; $aux++)
						{
							//echo($dia[$aux].' : Mostrando dia{aux] <br>');
							if ( $dia[$aux] != '' )
							{
								switch ($aux)
								{
									case 5 : $tempo[$t] = $data;
											 $temp = date('Y-m-d', $tempo[$t]);
											 $temp = date('l',$temp);
											 $t = $t + 1;
											 break;
									case 6 : $timestamp = strtotime('+1 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 0 : $timestamp = strtotime('+2 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 1 : $timestamp = strtotime('+3 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 2 : $timestamp = strtotime('+4 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 3 : $timestamp = strtotime('+5 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 4 : $timestamp = strtotime('+6 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
								}
							}
						}
					}
					if (( $semana == 'Sunday') || ( $semana == 'Domingo'))
					{  
						for ( $aux = 0 ; $aux < 7 ; $aux++)
						{
							if ( $dia[$aux] != '' )
							{
								switch ($aux)
								{
									case 6 : $tempo[$t] = $data;
									 		 $temp = date('Y-m-d', $tempo[$t]);
											 $temp = date('l',$temp);
											 $t = $t + 1;
											 break;
									case 0 : $timestamp = strtotime('+1 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 1 : $timestamp = strtotime('+2 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 2 : $timestamp = strtotime('+3 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 3 : $timestamp = strtotime('+4 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 4 : $timestamp = strtotime('+5 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
									case 5 : $timestamp = strtotime('+6 days');
											 $tempo[$t] = date('d-m-Y', $timestamp) ;
											 $temp = date('Y-m-d', $timestamp);
											 $temp = date('l',$timestamp);
											 $t = $t + 1;
											 break;
								}
								
							}
						}
					}
					
					//echo($temp.' temp <br>');
					$dia1 = Verifica_day($temp);
					
					$m = $dia1[0];
					$r = $dia1[1];
					$n = $dia1[2];
					$d = $dia1[3];
					
					//echo($m.' m '.$r.' r '.$n.' n '.$d.' d <br>');
					$aux = 0;
					//Verificar quais horários o profissional atende
					$final1 = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
					
					$final = mysql_fetch_row($final1);
					//echo($final[$m].' final['.$m.'] <br>');
					
					//definindo tempo dos horários
					$madru = strtotime('00:00:00');
					$manha = strtotime('06:00:00');
					$tarde = strtotime('12:00:00');
					$noite = strtotime('18:00:00');
					$mad_1 = strtotime('24:00:00');
					
					for ($c = 0 ; $c < 24 ; $c++ )
					{
						if ($hora[$c] != '') // pega somente as horas válidas
						{
							
							//echo($hora[$c].' hora c <br> ');
							$hora[$c] = $hora[$c].':00:00';
							$hora_1 = strtotime($hora[$c]);
							$hora[$c] = date('H:i:s', $hora_1);
							//echo($hora[$c].' hora alterada <br> ');
							if(($madru <= $hora_1) && ( $hora_1 < $manha))
							{
								if (($final[$d+1] != '') && ($final[$d+1] != '00:00:00'))
								{
									//echo('('.$madru.' <= '.$hora_1.') && ( '.$hora_1.' < '.$manha.')');
									//echo('00:00:00 <= '.$hora[$c].') && ( '.$hora[$c].' < 06:00:00)<br>');
									// são os horários da madrugada ------
									$resposta[$aux] = $final[$d]; // horário inicial
									//echo($final[$d].' final['.$d.'] d <br>');
									//echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
									while (( $resposta[$aux] < $final[$d+1]) && ($resposta[$aux] != '00:00:00'))
									{
										$aux = $aux + 1;  
										//echo ($x.'  Mostrando X  <br> ');
										$resposta[$aux] = somahora($resposta[$aux-1],$final[$d+2]);
										//echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
									}
									if ($resposta[$aux] >= $final[$d+2])
									{
										$resposta[$aux] = '';
									}
								}
								else
								{
									//Mostra_nao_encontrou($tempo[$cont2],$resposta[$aux],$resposta[$aux],$id, $id_cli, $final[$d+2]);
									$int = '00:00:00';
									$nao = 1;
									$resp = $hora[$c];
								}
							}
							//echo('06:00:00 <= '.$hora[$c].') && ( '.$hora[$c].' > 12:00:00)<br>');
							if(($manha <= $hora_1) && ( $hora_1 < $tarde))
							{
							   //--------- horários da manhã -----------	
								if (($final[$m+1] != '00:00:00') && ($final[$m+1] != '00:00:00'))
								{
									//echo('06:00:00 <= '.$hora[$c].') && ( '.$hora[$c].' < 12:00:00)<br>');
									$resposta[$aux] = $final[$m];
									//echo($final[$m].' final['.$m.'] m <br>');
									//echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
									while (( $resposta[$aux] < $final[$m+1]) && ($resposta[$aux] != '00:00:00'))
									{
										$aux = $aux + 1;  
										//echo ($x.'  Mostrando X  <br> ');
										$resposta[$aux] = somahora($resposta[$aux-1],$final[$m+2]);
										//echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
									}
									if ($resposta[$aux] >= $final[$m+2])
									{
										$resposta[$aux] = '';
									}
									//echo($aux." aux <br> ");
								}
								else
								{
									//Mostra_nao_encontrou($tempo[$cont2],$resposta[$aux],$resposta[$aux],$id, $id_cli, $final[$m+2]);
									$int = '00:00:00';
									$nao = 1;
									$resp = $hora[$c];
								}
							}
							
							if(($tarde <= $hora_1) && ( $hora_1 <= $noite))
							{
								 //-------- horários da tarde -----------
								 if (($final[$r+1] != '00:00:00') && ($final[$r+1] != '00:00:00'))
								{
									// echo('12:00:00 <= '.$hora[$c].') && ( '.$hora[$c].' < 18:00:00)<br>');
									$resposta[$aux] = $final[$r];
									//echo($final[$r].' final['.$r.'] r <br>');
									//echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
									while (( $resposta[$aux] < $final[$r+1]) && ($resposta[$aux] != '00:00:00'))
									{
										$aux = $aux + 1;  
										//echo ($x.'  Mostrando X  <br> ');
										$resposta[$aux] = somahora($resposta[$aux-1],$final[$r+2]);
										//echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
									}
									if ($resposta[$aux] >= $final[$r+2])
									{
										$resposta[$aux] = '';
									}
									//echo($aux." aux <br> ");
								}
								else
								{
									//Mostra_nao_encontrou($tempo[$cont2],$resposta[$aux],$resposta[$aux],$id, $id_cli, $final[$r+2]);
									$int = '00:00:00';
									$nao = 1;
									$resp = $hora[$c];
								}
							}
							
							if(($noite <= $hora_1) && ( $hora_1 < $mad_1))	
							{
								//------ horários da noite -----------
								if (($final[$n+1] != '00:00:00') && ($final[$n+1] != '00:00:00'))
								{
									//echo('18:00:00 <= '.$hora[$c].') && ( '.$hora[$c].' < 24:00:00)<br>');
									$resposta[$aux] = $final[$n];
									//echo($final[$n].' final['.$n.'] d <br>');
									//echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
									while (( $resposta[$aux] < $final[$n+1]) && ($resposta[$aux] != '00:00:00'))
									{
										$aux = $aux + 1;  
										//echo ($x.'  Mostrando X  <br> ');
										$resposta[$aux] = somahora($resposta[$aux-1],$final[$n+2]);
										//echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
									}
									if ($resposta[$aux] >= $final[$n+2])
									{
										$resposta[$aux] = '';
										
										//echo($aux." aux <br> ");
									}
									//echo($aux." aux <br> ");
								}
								else
								{
									
									//Mostra_nao_encontrou($tempo[],$resposta[$aux],$resposta[$aux],$id, $id_cli, $final[$n+2]);
									$int = '00:00:00';
									$nao = 1;
									$resp = $hora[$c];
								}	
							}
								
							/*if(('00:00:00' <= $hora[$c]) && ( $hora[$c] > '06:00:00'))
							{
								//------- horários da madrugada ----------
						
								$resposta[$aux] = $final[$d];
								echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
								while (( $resposta[$aux] < $final[$d+1]) && ($resposta[$aux] != '00:00:00'))
								{
									$aux = $aux + 1;  
									echo ($x.'  Mostrando X  <br> ');
									$resposta[$aux] = somahora($resposta[$aux-1],$final[$d+2]);
									echo($resposta[$aux].' : Resposta [ '.$aux.' ] <br>');
								}
								if ($resposta[$aux] >= $final[$d+2])
								{
									$resposta[$aux] = '';
								}
								//-----
								/*echo($aux." aux <br> ");
								for ($x = 0 ; $x < $aux ; $x++ )
								{
									echo($resposta[$x]." Resposta[".$x."] <br>");
								}*/
							//}
						}
					}
					
					// Verificar o horario 
					
					for ($x = 0; $x < 24 ; $x++)
					{
						if (( $hora[$x] != '' ) && ($hora[$x] != '00:00:00'))
						{
							$verifica_horario[$y] = $hora[$x];
							//echo( 'entrou no if hora<br>');
							for ($a = 0 ; $a < $aux ; $a++) 
							{
								/*echo($a. ' : A <br> '); 
								$ver_hor = strtotime($verifica_horario[$y]);
								echo(date('G:m:s   <br>', $ver_hor));
								$resp1 = strtotime($resposta[$a]);
								echo(date('h:m:s   <br>', $resp1));
								$resp2 = strtotime($resposta[$a+1]);
								echo(date('h:m:s   <br>', $resp2));*/
								//if (( $resp1 < $ver_hor) && ( $ver_hor < $resp2 ))
								if (($resposta[$a] < $verifica_horario[$y]) && ($verifica_horario[$y] < $resposta[$a+1]))
									$verifica_horario[$y] = $resposta[$a+1];
							}
							//echo($verifica_horario[$y].' : Mostrando horario '.$y.' <br>');
							$y = $y + 1;
						}
						
					}
					
					// ---- 
					
					//Verificar qual o intervalo de atendimento do profissional
					$atendimento = mysql_query("Select man_seg_tem from cadastro_profissionais where id_pro = '$id'"); 
					$atend = mysql_fetch_row($atendimento);
					//echo($atend[0].' : Mostrando atendimento <br> '); 
					$x = 0;
					//echo($t.' : t <br> ');
					
					
					for ( $cont2 = 0 ; $cont2 < $t ; $cont2++ )
					{ //Verificar horário pela data
						
						if ($nao == 1 )
						{
							Mostra_nao_encontrou($tempo[$cont2],$resp,$resp,$id, $id_cli, $int);
						}
						else
						{
							//echo($cont2.' cont2 <br>');
							if ( $flag == 0 )
							{
								//echo ($x.' : mostrando X <br>');
								//echo($tempo[$cont2].' : mostrando tempo <br>');
								$timestamp = strtotime($tempo[$cont2]);
								$dt_teste = date('Y-m-d',$timestamp); 
								$diasem = date('l', $timestamp);
								//echo($dt_teste.' : Mostrando dt_teste <br>');
								
								//Verifica os horários
								for ( $cont = 0 ; $cont < $y ; $cont++ )
								{  
									if ( $flag == 0 )
									{
										/*$time1 = strtotime('00:00:00');
										$time2 = strtotime('06:00:00');
										$time3 = strtotime('12:00:00');
										$time4 = strtotime('18:00:00');
										$time5 = strtotime('24:00:00');
										//$time = inttostr(
										$time = strtotime($verifica_horario[$cont]);
										echo($verifica_horario[$cont].' verifica_horario <br> ');
										echo($time. ' time <br> ');
										echo($time1. ' time1 <br> ');
										echo($time2. ' time2 <br> ');
										echo($time3. ' time3 <br> ');
										echo($time4. ' time4 <br> ');
										echo($time5. ' time5 <br> '); */
										
										if(($verifica_horario[$cont] >= 6) && ($verifica_horario[$cont] < 12))
										{
											//echo("entrou if 1 <br>");
											$val = $m;
										}
										if(($verifica_horario[$cont]>= 12) && ($verifica_horario[$cont] < 18))
										{
											//echo("entrou if 2 <br>");
											$val = $r;
										}
										if(($verifica_horario[$cont] >= 18) && ($verifica_horario[$cont] < 24))
										{
											//echo("entrou if 3 <br>");
											$val = $n;
										}
										if(($verifica_horario[$cont] >=  0) && ($verifica_horario[$cont] < 6))
										{
											//echo("entrou if 4 <br>");
											$val = $d;
										}
										//echo($final[$val+1].' final val + 1 <br>');
										//echo($final[$val].' final val  <br>');
										//echo($verifica_horario[$cont].' verifica_cont <br>');
										//echo(' verifica_horario[$cont] < final[$val+1]) || ( verifica_horario[$cont] > final[$val] ))');
										if (( $verifica_horario[$cont] >  $final[$val+1]) && ( $verifica_horario[$cont] < $final[$val] ))
										{
											//echo($val.' val <br>');
											
											//echo($final[$val+2].' final <br> ');
											$hora = $final[$m];
											$verifica_horario[$cont] = somahora($verifica_horario[$cont], $final[$val+2]);
											//echo($verifica_horario[$cont].' Verifica horario <br>');
											Mostra_nao_encontrou($tempo[$cont2],$verifica_horario[$cont],$verifica_horario[$cont], $id, $id_cli, $final[$val+2]);
											$flag = 1;
										}
										else
										{
											//echo($cont.' cont <br> ');
											$inicio = mysql_query("Select inicio_pro from horarios_pro where idprofissional_pro = '$id' and data_pro = '$dt_teste'");
											// Se não houver retorno na pesquisa, não tem nenhum horário agendado para aquela data
											//echo(mysql_num_rows($inicio).' : mostrando n° de colunas de inicio <br>');
											if ( mysql_num_rows($inicio) == 0 )
											{
												//echo($verifica_horario[$cont].' : Mostrando Verifica horario['.$cont.'] <br>');
												Mostrar_resultado($tempo[$cont2],$verifica_horario[$cont],$verifica_horario[$cont], $id, $id_cli, $final[$val+2]);
												
												$flag = 1;
											}
											else
											{
												$i = 0;
												while ($row = mysql_fetch_assoc($inicio))
												{
													$iniciocad[$i] = $row['inicio_pro'];
													//echo($row['inicio_pro'].' inicio <br>');
													$i = $i + 1;
												}
												//echo($row['inicio_pro'].' inicio<br>');
												// Verifica em que horario o profissional vai estar atendendo
												//echo($inicio_cad[].' : mostrando inicio cad 1 ');
												//echo($verifica_horario[$cont].' : mostrando verifica horario CONT <br>');
												while (($x < $i) && ( $iniciocad[$x] != '' ))
												{
													
													$intervalo = somahora($iniciocad[$x],$atend[0]); 
													//echo($verifica_horario[$cont].' $verifica_horario[$cont] <br>');											
													$pesquisa = mysql_query("Select * from horarios_pro where idprofissional_pro = '$id' and inicio_pro = '$verifica_horario[$cont]' and data_pro = '$dt_teste'");
													
													//echo(mysql_num_rows($pesquisa).' : Mostrando pesquisa <br>');
													// Se não houver nenhum retorno no select
													if ( mysql_num_rows($pesquisa) == 0 )
													{
														if(($iniciocad[$x] < $verifica_horario[$cont]) && ($verifica_horario[$cont] < $intervalo))
													   {
															$horario = somahora($verifica_horario[$cont], '0:00:00');
															$h = $cont;
															//echo($horario. ' : Horario 1 <br> ');
														}
														else
														{
															$buscar[0] = 1;
															$buscar[1] = $tempo[$cont2];
															$buscar[2] = somahora($verifica_horario[$cont],'0:00:00');
														}
													}
													else
													{
														$horario = somahora($verifica_horario[$cont], '0:00:00');
														//echo($horario. ' : Horario 1 <br> ');
														$h = $cont;
													}
													$x = $x + 1;
													//echo ("Somou X <br>");
												}
											}
										}
									}
								}
								if ( $buscar[0] == 1)
								{
									//echo($buscar[2]. ' : Buscar 2 <br>');
									//echo($horario. ' : Horario 1 <br> ');
									Mostrar_resultado($buscar[1],$buscar[2], $buscar[2], $id, $id_cli, $final[$val+2] );
									$flag = 1;
									
								}
								else
								{
									if ($flag == 0)
									{
										//echo($verifica_horario[$h]. ' : verifica h <br> ');
										$verifica_horario[$h] = somahora($verifica_horario[$h], $final[$val+1]);
										Mostra_nao_encontrou($tempo[$cont2],$verifica_horario[$h],$horario, $id, $id_cli, $final[$val+2]);
										$flag = 1;
									}
								}
							}
						}
					}
					// mandar $horario por URL
              ?>
        	</div>
       </div>
	</body>
</html>