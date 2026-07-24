<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Hor&aacute;rios </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<link href="_style/default.css" rel="stylesheet" type="text/css"/>-->
		<link href="../calendario/_style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="../calendario/_scripts/jquery.js"></script>
		<script type="text/javascript" src="../calendario/_scripts/jquery.click-calendario-1.0-min.js"></script>		
		<script type="text/javascript" src="../calendario/_scripts/exemplo-calendario.js"></script>
        <link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
        <script src="../funcoes/mascaras.js" ></script>
        <script type="text/javascript" src="../funcoes/jQUERY.js"></script>
		<script type="text/javascript">
		/*$(document).ready(function() {
			$("#mesanterior").click(function(){
				//var dt=$("#data_1").val();
				var dt= $("#mesmenos").val();
				var id= <?  echo (!empty($_GET["p"])?$_GET["p"]:'') ?>;
				alert(dt);
				alert(id);
				$.ajax({
						type      : 'post',
		 
						url       : 'horario.jquery.php',
		 
						data      : 'dt='+ dt + '&p='+ id,
		 
						dataType  : 'html', 
						success : function(txt){
							$("table#tabela").fadeOut(500);
							$('table#tabela').html(txt);
							$("table#tabela").fadeIn(500);
							
						}
						
				});
			});
		});*/
		
        </script>

        </script>

<script type="text/javascript">
			function submitform1()
			{
				if(document.myform1.onsubmit &&
				!document.myform1.onsubmit())
				{
					return;
				}
			 document.myform1.submit();
			}
			function submitform2()
			{
				if(document.myform2.onsubmit &&
				!document.myform2.onsubmit())
				{
					return;
				}
			 document.myform2.submit();
			}
			function submitform3()
			{
				if(document.myform3.onsubmit &&
				!document.myform3.onsubmit())
				{
					return;
				}
			 document.myform3.submit();
			}
			function submitform4()
			{
				if(document.myform4.onsubmit &&
				!document.myform4.onsubmit())
				{
					return;
				}
			 document.myform4.submit();
			}
		</script>

	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000" text="#FFFFFF">
		<div class="principal">

            <div id="cabeca" >
                
              <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>
            <?php
                    session_start();
					header('Content-Type: text/html; charset=utf-8');
                    include '../funcoes/conecta.php';
					include '../funcoes/somaHora.php';
					include '../funcoes/funcoes.php';
					
                    mysql_select_db(BASE,$cn)or die(mysql_error());
                    date_default_timezone_set('UTC');
				
					
                   if(isset($_COOKIE['pro'])){
						$id = $_COOKIE["pro"];
				   }
					else{
						$id = 0;
					}
					//if(isset($_COOKIE['pro'])){
						//$id = $_COOKIE["pro"];
				   
					$pesquisa = mysql_query("Select tipo, nome_pro, cidade_pro from cadastro_profissionais where id_pro = '$id'") or die (mysql_error());
					$tipo = mysql_fetch_row($pesquisa);
					
					if ($tipo[0] == 'empresa') 
					{
						echo('
								<div id="flash" >');
								/*echo('
									<object width="1500px" height="65px">
										 <param name="movie" value="../menu/Menu-emp.swf">
										 <param name="wmode" value="transparent" />
										 <embed wmode="transparent" src="../menu/Menu-emp.swf" width="900px" height="60px" />
									</object>');*/
									include ("../funcoes/menu-emp.html");
								echo('</div> ');
						echo('<div class="principal" style="top: 183px; text-align:center">
            	<p align="right"> <a href="../principais/empresa_princ.php"><input type="button" name="voltar" value="Voltar"></a> </p>');
						
					}
					else
					{
						echo('
								<div id="flash" >');
									/*echo('<object width="1500px" height="65px">
										 <param name="movie" value="../menu/Menu-prof.swf">
										 <param name="wmode" value="transparent" />
										 <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
									</object>');*/
									include ("../funcoes/menu-prof.html");
								echo('</div> ');
								
						 echo(' <div class="principal" style="top: 183px; text-align:center">
            	<p align="right"> <a href="../principais/prof_princ.php"><input type="button" name="voltar" value="Voltar"></a> </p> ');
					}
			?>
           <!-- <div class="principal" style="top: 183px; text-align:center">
            	<p align="right"> <a href="../principais/prof_princ.php"><input type="button" name="voltar" value="Voltar"></a> </p> -->
           	   <font color="#FFFFFF"><center>
            	
                <?
					echo('<img src="../imagens/visualizar_horarios.png" > <br><Br>');
					$id_pro = !empty($_GET["p"])?$_GET["p"]:$id; // verifica se tem algum horário específico
					echo('<input type="hidden" value="'.$id_pro.' id="id_pro""');
					$pesquisa = mysql_query("Select tipo, nome_pro, cidade_pro from cadastro_profissionais where id_pro = '$id_pro'") or die (mysql_error());
					$tipo = mysql_fetch_row($pesquisa);
					
					$dia_1 = date('d-m-Y');	// Salva data atual
					$sem = !empty($_POST["dt"])?$_POST["dt"]:$dia_1; // Salva o valor da data passada por post
					$sem = !empty($_GET["dt"])?$_GET["dt"]:$sem; // Salva o valor da data passada por get
					$data2 = strtotime($sem);
					$data3 = date('d-m', $data2);
					$data4 = semanamais($sem);
					$flag = 0;
					$d = 0;
					$cont = 0;
					$aux = 0;
					$menor = '';
					$nome = !empty($_GET["n"])?$_GET["n"]:"";
					//$d = !empty($_GET["d"])?$_GET["d"]:"";

					$SQL = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
							//echo("SELECT * FROM calendario_pro where cidade='nacional' and cidade like '".$tipo[2]."'");
							$resultad = mysql_query($SQL);
							while ($row = mysql_fetch_array($resultad)) {
								$data[$z] = $row['data'];
								for ($b =0; $b<6; $b++) {
									//if ($data3 == 
								}
								
								//echo('data do feriado eh'.$data[$z]);
								$z++;
							}
					
					
					
					
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
							
							
							$hl = 0;
							//Calculo dos valores chave da manhã
							//$retorno1 = calculaInt(0,20);
							$pesquisa22 = mysql_query("SELECT MAX( campo ) 
FROM ( SELECT `man_seg_ate` AS Campo FROM cadastro_profissionais WHERE `id_pro` =$id_pro UNION ALL SELECT `man_ter_ate` FROM cadastro_profissionais WHERE `id_pro` =$id_pro UNION ALL  SELECT `man_qua_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL  SELECT  `man_qui_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `man_sex_ate` 
FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `man_sab_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `man_dom_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro
)Drv")or die(mysql_error());
							$retorno1 = mysql_fetch_row($pesquisa22);
							$hlateral1 = $retorno1[0];
							
							$ct1 = 0;
							while( $hlateral1[$ct1] != '' )
							{
								$hlateral[$hl] = $hlateral1[$ct1];
								//echo($hlateral[$hl].' :  hlteral1  <br><br>');
								$ct1 = $ct1 + 1;
								$hl = $hl + 1;
							}
							//echo($hl.'   : hl 1 <br><Br>');
							//Calculo dos valores chave da tarde
							//$retorno2 = calculaInt(21,41);
							$pesquisa32 = mysql_query("SELECT MAX( campo ) FROM ( SELECT  `tar_seg_ate` AS Campo FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `tar_ter_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `tar_qua_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `tar_qui_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `tar_sex_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT `tar_sab_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `tar_dom_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro )Drv")or die(mysql_error());
							$retorno2 = mysql_fetch_row($pesquisa32);
							$hlateral2 = $retorno2[0];
							$ct2 = 0;
							while( $hlateral2[$ct2] != '' )
							{
								//echo($hlateral[$hl-1].' :  hlteral2  <br><br>');
								//echo($hl.'   : hl 1 <br><Br>');
								//echo($ct2.'   : ct2 <br><Br>');
								$hlateral[$hl] = $hlateral2[$ct2];
								//echo($hlateral[$hl].' :  hlteral2  <br><br>');
								$ct2 = $ct2 + 1;
								$hl = $hl + 1;
							}
							
							//Calculo dos valores chave da noite
							//$retorno3 = calculaInt(42,62);
							$pesquisa42 = mysql_query("SELECT MAX( campo ) FROM ( SELECT  `noi_seg_ate` AS Campo FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `noi_ter_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `noi_qua_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `noi_qui_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `noi_sex_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT `noi_sab_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `noi_dom_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro )Drv")or die(mysql_error());
							$retorno3 = mysql_fetch_row($pesquisa42);
							$hlateral3 = $retorno3[0];
							$ct3 = 0;
							while( $hlateral3[$ct3] != '' )
							{
								$hlateral[$hl] = $hlateral3[$ct3];
								//echo($hlateral[$hl].' :  hlteral3  <br><br>');
								$hl = $hl + 1;
								$ct3 = $ct3 + 1;
							}
								
							//Calculo dos valores chave da manhã
							$retorno4 = calculaInt(63,83);
							$pesquisa52 = mysql_query("SELECT MAX( campo ) FROM ( SELECT  `mad_seg_ate` AS Campo FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `mad_ter_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `mad_qua_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `mad_qui_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `mad_sex_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT `mad_sab_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro UNION ALL SELECT  `mad_dom_ate` FROM cadastro_profissionais WHERE  `id_pro` =$id_pro )Drv")or die(mysql_error());
							$retorno4 = mysql_fetch_row($pesquisa52);
							$hlateral4 = $retorno4[0];
							$ct4 = 0;
							while( $hlateral4[$ct4] != '' )
							{
								$hlatera[$hl] = $hlateral4[$ct4];
								//echo($hlateral[$hl].' :  hlteral4  <br><br>');
								$hl = $hl + 1;
								$ct4 = $ct4 + 1;
							}
															
							//echo($i.'  valor de i antes do while  <br><br>');
							
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
								
								//echo($de.'  : de <br><br>');
								$aux = 0;
								//echo('//Montando as respostas dos dias - antes do meio-dia <br><br>');
								$resultado = $horario1[$de];
								//echo($hlateral1[$aux].'  : hlateral ['.$aux.']<br><br>');
								//echo($resultado.'  : resultado <br><br>');
								//echo($ct1.'  : ct <br><br>');
								
								//Verifica se os horários são iguais a resposta
								for ($aux = 0 ; $aux < $ct1 ; $aux++ )
								{ 
									//echo('A <br><br><br>'); 
									if ( $resultado == $hlateral1[$aux] )
									{ //  echo('B <br><br><br>');
										// Se for igual manda a resposta
										$resposta[$x][$d] = $resultado;
										//echo($resposta[$x][$d].'   : Mostrando resposta <br>');
										$resultado = somahora($resposta[$x][$d], $horario1[$tem]);
										//echo($horario1[$tem].'  : horario[tem] <br><br>');
										$x = $x + 1;
									}
									else
									{	//echo('C <br><br><br>');
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
								{   //echo('E <br><br><br>');
									if ( $resultado == $hlateral2[$aux] )
									{ //  echo('F <br><br><br>');
										// Se for igual manda a resposta
										$resposta[$x][$d] = $resultado;
										//echo($resposta[$x][$d].'   : Mostrando resposta <br><br>');
										$resultado = somahora($resposta[$x][$d], $horario1[$tem+21]);
										$x = $x + 1;
									}
									else
									{	//echo('G <br><br><br>');
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
								{   //echo('I <br><br><br>');
									if ( $resultado == $hlateral3[$aux] )
									{   //echo('J <br><br><br>');
										// Se for igual manda a resposta
										$resposta[$x][$d] = $resultado;
										//echo($resposta[$x][$d].'   : Mostrando resposta <br><br>');
										$resultado = somahora($resposta[$x][$d], $horario1[$tem+42]);
										$x = $x + 1;
									}
									else
									{	//echo('K <br><br><br>');
										//senão, manda vazio pra resposta
										$resposta[$x][$d] = '';
										$x = $x + 1;	
									}
								}
								
								//Montando os resultados até as seis da manhã
								for( $aux = $x + 1 ; $aux <= $i ; $aux++ )
								{   //echo('L <br><br><br>');
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
								{   //echo('M <br><br><br>');
									if ( $resultado == $hlateral[$aux] )
									{   //echo('N <br><br><br>');
										// Se for igual manda a resposta
										$resposta[$x][$d] = $resultado;
										//echo($resposta[$x][$d].'   : Mostrando resposta <br><br>');
										$resultado = somahora($resposta[$x][$d], $horario1[$tem+63]);
										$x = $x + 1;
									}
									else
									{	//echo('O <br><br><br>');
										//senão, manda vazio pra resposta
										$resposta[$x][$d] = '';
										$x = $x + 1;	
									}
								}
								//echo('P <br><br><br>');
								$de = $de + 3;
								$ate = $ate + 3;
								$tem = $tem + 3;
								$d = $d + 1;  // Marca que mudou o dia
								$x = 0;
							} //Fecha o while
									
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
									<table name="horario" id="tabela" border="2" bordercolor="#66CDAA" cellspacing="0" cellpadding="4" 	 style="width:800px;">								
											<tr>
												<td colspan="8" align="center"><strong>'.$nome.'</strong></td>
											</tr>
											
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
							$z = 0;
							/*$SQL = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
							//echo("SELECT * FROM calendario_pro where cidade='nacional' and cidade like '".$tipo[2]."'");
							$resultad = mysql_query($SQL);
							while ($row = mysql_fetch_array($resultad)) {
								$data[$z] = $row['data'];
								//echo('data do feriado eh'.$data[$z]);
								$z++;
							}*/
							//hl é o indice dos horários laterais	
							for ( $aux1 = 0 ; $aux1 < $hl ; $aux1++ )
							{   //montar linha por linha da tabela
								echo (' <tr>
											<td align="center"> '.$hlateral[$aux1].' </td> 
											<td align="center" >');
										
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = '".$resposta[$i][$aux]."' and data_pro = '".$data[0]."'<br><br>");
										 //Dia 0
										//echo($aux1.' : aux1<br>');
										$aux = MostraDia($dia_semana[0]);
										//echo($aux.' : aux<br>');
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[0]."'");
										$horario = mysql_num_rows($teste);
										$teste2 = "Select * from horarios_pro";
										$teste2 = mysql_query($teste2,$cn) or die (mysql_error());
										
										//s$horaro_teste = mysql_fetch_assoc($teste);
										//
										//echo('id cliente ='.$id_cli_pro);
										while ($row = mysql_fetch_assoc($teste2)){
											$idp = $row['idprofissional_pro'];
											$idp2 = $row['inicio_pro'];
											$idp3 = $row['data_pro'];
											
											if (($idp == $id_pro) and ($idp2 == $resposta[$aux1][$aux]) and ($idp3 == $data[0])){
												//echo ''. $idp.'=='.$id_pro.', '.$idp2.'=='.$resposta[$aux1][$aux].''.$idp3.'=='.$data[0].'<BR/>';
												$id_cli_pro = $row['id_cliente_pro'];
											}
										}
										//echo('id cliente ='.$id_cli_pro);
										$sql = mysql_query("SELECT `nome_cli` FROM `cliente` WHERE `cpnjcpf_cli` =".$id_cli_pro);
										//echo("Select nome_cli form cliente where cpnjcpf_cli =".$id_cli_pro);
										$nomec = mysql_fetch_row($sql);
										//echo($nomec[0]);
										//echo($horario.' horario <br><br> ');
										
										//echo($dia_semana[0]);
										
										//Recebe o dia da semana correspondente 
										
										
										$dia = Verifica_dia($dia_semana[0]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										//echo('<br>'.$i.' : i <br><br>');
										//echo('<br>'.$aux.' : d <br><br>');
										//echo(':'.$resposta[$i][$aux].'   : Resposta<br><br>');
										//if ($resposta[$aux1][$aux] < '12:00')
										//{
											/* echo($resposta[$i].' resposta <br><br>');
											echo($data[0]. 'data <br><br>');
											echo($id_pro.' id_pro <br><br>');
											echo('function testeID($hora, $data, $id)');  */
											//echo verificaID($resposta[$i],$data[0], $id_pro);
											
										$id_hor = verificaID($resposta[$aux1][$aux], $data[0], $id_pro);
										//echo($horario1[$m].' horario 1 <br> '); 
										//if ( $horario1[$m] != '00:00:00' )
										$SQL2 = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
										$resultad = mysql_query($SQL2);
										$data2 = strtotime($data[0]);
										$data3 = date('d-m', $data2); // aioasidhgahdso
										while ($row = mysql_fetch_array($resultad)) {
											$data4 = $row['data'];
											$data2 = strtotime($data4);
											$data5 = date('d-m', $data2);
											//echo($data3.'=='.$data5.'<br>');
											if ($data3 == $data5){
												$verifica = 01;
											}
											
										}
										if ($verifica == 01) {
											echo ('<div id="bloqueado1"><li><a title="Feriado">Bloqueado</a></li></div> </td>
											</td><td align="center">');	
										} else {
										if ( $resposta[$aux1][$aux] != '' )
										{
											if ( $horario == 0 )
											{
												echo('<div id="disponivel1"><li><a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[0].'"> Disponivel </a></li></div> </td>
												<td align="center">');
											}
											else
											{
												
												echo ('<div id="ocupado1"><li><a title="'.$nomec[0].'" href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'&n='.$nome.'&d='.$data[0].' ">Ocupado</a></li></div>');
												echo(' </td> <td align="center">');
											}
										}
										else
										{
											echo ('<div id="bloqueado1"><li><a>Bloqueado</a></li></div> </td>
											</td><td align="center">');	
										}
										}
										
										
										// ---------------------------------
										//Dia 1
										//echo($aux1.' : aux1<br>');
										$aux = MostraDia($dia_semana[1]);
										//echo($aux.' : aux<br>');
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[1]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[1]."'");
										$horario = mysql_num_rows($teste);
										//echo($horario.' horario <br><br> ');
										$teste2 = "Select * from horarios_pro";
										$teste2 = mysql_query($teste2,$cn) or die (mysql_error());
										
										//s$horaro_teste = mysql_fetch_assoc($teste);
										//
										//echo('id cliente ='.$id_cli_pro);
										while ($row = mysql_fetch_assoc($teste2)){
											$idp = $row['idprofissional_pro'];
											$idp2 = $row['inicio_pro'];
											$idp3 = $row['data_pro'];
											
											if (($idp == $id_pro) and ($idp2 == $resposta[$aux1][$aux]) and ($idp3 == $data[1])){
												//echo ''. $idp.'=='.$id_pro.', '.$idp2.'=='.$resposta[$aux1][$aux].''.$idp3.'=='.$data[0].'<BR/>';
												$id_cli_pro = $row['id_cliente_pro'];
											}
										}
										//echo('id cliente ='.$id_cli_pro);
										$sql = mysql_query("SELECT `nome_cli` FROM `cliente` WHERE `cpnjcpf_cli` =".$id_cli_pro);
										//echo("Select nome_cli form cliente where cpnjcpf_cli =".$id_cli_pro);
										$nomec = mysql_fetch_row($sql);
										
										$dia = Verifica_dia($dia_semana[1]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										//if ($resposta[$aux1][$aux] < '12:00')
										//{
										$id_hor = verificaID($resposta[$aux1][$aux],$data[1], $id_pro);
										//echo($resposta[$aux1][$aux].' resposta  <br>');
										
										$SQL2 = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
										$resultad = mysql_query($SQL2);
										$data2 = strtotime($data[1]);
										$data3 = date('d-m', $data2); // aioasidhgahdso
										while ($row = mysql_fetch_array($resultad)) {
											$data4 = $row['data'];
											$data2 = strtotime($data4);
											$data5 = date('d-m', $data2);
											//echo($data3.'=='.$data5.'<br>');
											if ($data3 == $data5){
												$verifica1 = 01;
											}
											
										}
										if ($verifica1 == 01) {
											echo ('<div id="bloqueado1"><li><a title="Feriado">Bloqueado</a></li></div> </td>
											</td><td align="center">');	
										} else {
										if ( $resposta[$aux1][$aux] != '' )
										{
											if ( $horario == 0 )
											{
												echo('<div id="disponivel1"><li><a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[1].'">Disponivel</a></li></div>
												 </td><td align="center">');
											}
											else
											{
												echo ('<div id="ocupado1"><li><a title="'.$nomec[0].'" href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'&n='.$nome.'&d='.$data[0].'">Ocupado</a></li></div>
												</td> <td align="center">');
											}
										}
										else 
										{
											echo ('<div id="bloqueado1"><li><a>Bloqueado</a></li></div> </td> 
											</td><td align="center">');
										}
										}
										
										// ---------------------------------
										//Dia 2
										//echo($aux1.' : aux1<br>');
										$aux = MostraDia($dia_semana[2]);
										//echo($aux.' : aux<br>');
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[2]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[2]."'");
										$horario = mysql_num_rows($teste);
										//echo($horario.' horario <br><br> ');
										$teste2 = "Select * from horarios_pro";
										$teste2 = mysql_query($teste2,$cn) or die (mysql_error());
										
										//s$horaro_teste = mysql_fetch_assoc($teste);
										//
										//echo('id cliente ='.$id_cli_pro);
										while ($row = mysql_fetch_assoc($teste2)){
											$idp = $row['idprofissional_pro'];
											$idp2 = $row['inicio_pro'];
											$idp3 = $row['data_pro'];
											
											if (($idp == $id_pro) and ($idp2 == $resposta[$aux1][$aux]) and ($idp3 == $data[2])){
												//echo ''. $idp.'=='.$id_pro.', '.$idp2.'=='.$resposta[$aux1][$aux].''.$idp3.'=='.$data[0].'<BR/>';
												$id_cli_pro = $row['id_cliente_pro'];
											}
										}
										//echo('id cliente ='.$id_cli_pro);
										$sql = mysql_query("SELECT `nome_cli` FROM `cliente` WHERE `cpnjcpf_cli` =".$id_cli_pro);
										//echo("Select nome_cli form cliente where cpnjcpf_cli =".$id_cli_pro);
										$nomec = mysql_fetch_row($sql);
										
			
										/*$dia = Verifica_dia($dia_semana[2]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];*/
										
										//if ($resposta[$i][$aux] < '12:00')
										//{
										$id_hor = verificaID($resposta[$aux1][$aux],$data[2], $id_pro);
										//if ( $horario1[$m] != '00:00:00'  )
										
										$SQL2 = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
										$resultad = mysql_query($SQL2);
										$data2 = strtotime($data[2]);
										$data3 = date('d-m', $data2); // aioasidhgahdso
										while ($row = mysql_fetch_array($resultad)) {
											$data4 = $row['data'];
											$data2 = strtotime($data4);
											$data5 = date('d-m', $data2);
											//echo($data3.'=='.$data5.'<br>');
											if ($data3 == $data5){
												$verifica2 = 01;
											}
											
										}
										if ($verifica2 == 01) {
											echo ('<div id="bloqueado1"><li><a title="Feriado">Bloqueado</a></li></div> </td>
											</td><td align="center">');	
										} else {
										if ( $resposta[$aux1][$aux] != '' )
										{
											if ( $horario == 0 )
											{
												echo('<div id="disponivel1"><li><a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[2].'">Disponivel</a></li></div> </td>
												<td align="center">');
											}
											else
											{
												echo ('<div id="ocupado1"><li><a title="'.$nomec[0].'" href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'&n='.$nome.'&d='.$data[0].'">Ocupado</a></li></div>
												</td><td align="center">');
											}
										}
										else
										{
											echo ('<div id="bloqueado1"><li><a>Bloqueado</a></li></div> </td> 
											</td><td align="center">');
										}
										}
										
										// ------------------------------------
										//Dia 3
										//echo($aux1.' : aux1<br>');
										$aux = MostraDia($dia_semana[3]);
										//echo($aux.' : aux<br>');
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[3]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[3]."'");
										$horario = mysql_num_rows($teste);
										//echo($horario.' horario <br><br> ');
										$teste2 = "Select * from horarios_pro";
										$teste2 = mysql_query($teste2,$cn) or die (mysql_error());
										
										//s$horaro_teste = mysql_fetch_assoc($teste);
										//
										//echo('id cliente ='.$id_cli_pro);
										while ($row = mysql_fetch_assoc($teste2)){
											$idp = $row['idprofissional_pro'];
											$idp2 = $row['inicio_pro'];
											$idp3 = $row['data_pro'];
											
											if (($idp == $id_pro) and ($idp2 == $resposta[$aux1][$aux]) and ($idp3 == $data[3])){
												//echo ''. $idp.'=='.$id_pro.', '.$idp2.'=='.$resposta[$aux1][$aux].''.$idp3.'=='.$data[0].'<BR/>';
												$id_cli_pro = $row['id_cliente_pro'];
											}
										}
										//echo('id cliente ='.$id_cli_pro);
										$sql = mysql_query("SELECT `nome_cli` FROM `cliente` WHERE `cpnjcpf_cli` =".$id_cli_pro);
										//echo("Select nome_cli form cliente where cpnjcpf_cli =".$id_cli_pro);
										$nomec = mysql_fetch_row($sql);

										/*$dia = Verifica_dia($dia_semana[3]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3]; */
										
										//if ($resposta[$aux1][$aux] < '12:00')
										//{
										$id_hor = verificaID($resposta[$aux1][$aux],$data[3], $id_pro);
										//if ( $horario1[$m] != '00:00:00'  )
										
										$SQL2 = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
										$resultad = mysql_query($SQL2);
										$data2 = strtotime($data[3]);
										$data3 = date('d-m', $data2); // aioasidhgahdso
										while ($row = mysql_fetch_array($resultad)) {
											$data4 = $row['data'];
											$data2 = strtotime($data4);
											$data5 = date('d-m', $data2);
											//echo($data3.'=='.$data5.'<br>');
											if ($data3 == $data5){
												$verifica3 = 01;
											}
											
										}
										if ($verifica3 == 01) {
											echo ('<div id="bloqueado1"><li><a title="Feriado">Bloqueado</a></li></div> </td>
											</td><td align="center">');	
										} else {
										if ( $resposta[$aux1][$aux] != '' )
										{
											if ( $horario == 0 )
											{
												echo('<div id="disponivel1"><li><a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[3].'">Disponivel</a></li></div> </td>
												<td align="center">');
											}else{
												echo ('<div id="ocupado1"><li><a title="'.$nomec[0].'" href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'&n='.$nome.'&d='.$data[0].'">Ocupado</a> </li></div>
												</td><td align="center">');
											}
										}else{
											echo ('<div id="bloqueado1"><li><a>Bloqueado</a></li></div> </td> 
											</td><td align="center">');
										}
										}
										
										// -----------------------------------
										//Dia 4
										//echo($aux1.' : aux1<br>');
										$aux = MostraDia($dia_semana[4]);
										//echo($aux.' : aux<br>');

										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[4]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[4]."'");
										$horario = mysql_num_rows($teste);
										//echo($horario.' horario <br><br> ');
										$teste2 = "Select * from horarios_pro";
										$teste2 = mysql_query($teste2,$cn) or die (mysql_error());
										
										//s$horaro_teste = mysql_fetch_assoc($teste);
										//
										//echo('id cliente ='.$id_cli_pro);
										while ($row = mysql_fetch_assoc($teste2)){
											$idp = $row['idprofissional_pro'];
											$idp2 = $row['inicio_pro'];
											$idp3 = $row['data_pro'];
											
											if (($idp == $id_pro) and ($idp2 == $resposta[$aux1][$aux]) and ($idp3 == $data[4])){
												//echo ''. $idp.'=='.$id_pro.', '.$idp2.'=='.$resposta[$aux1][$aux].''.$idp3.'=='.$data[0].'<BR/>';
												$id_cli_pro = $row['id_cliente_pro'];
											}
										}
										//echo('id cliente ='.$id_cli_pro);
										$sql = mysql_query("SELECT `nome_cli` FROM `cliente` WHERE `cpnjcpf_cli` =".$id_cli_pro);
										//echo("Select nome_cli form cliente where cpnjcpf_cli =".$id_cli_pro);
										$nomec = mysql_fetch_row($sql);

										$dia = Verifica_dia($dia_semana[4]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										//if ($resposta[$aux1][$aux] < '12:00')
										//{
										$id_hor = verificaID($resposta[$aux1][$aux],$data[4], $id_pro);
										//if ( $horario1[$m] != '00:00:00'  )
										
										$SQL2 = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
										$resultad = mysql_query($SQL2);
										$data2 = strtotime($data[4]);
										$data3 = date('d-m', $data2); // aioasidhgahdso
										while ($row = mysql_fetch_array($resultad)) {
											$data4 = $row['data'];
											$data2 = strtotime($data4);
											$data5 = date('d-m', $data2);
											//echo($data3.'=='.$data5.'<br>');
											if ($data3 == $data5){
												$verifica4 = 01;
											}
											
										}
										if ($verifica4 == 01) {
											echo ('<div id="bloqueado1"><li><a title="Feriado">Bloqueado</a></li></div> </td>
											</td><td align="center">');	
										} else {
										if ( $resposta[$aux1][$aux] != '' )
										{
											if ( $horario == 0 )
											{
												echo('<div id="disponivel1"><li><a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[4].'">Disponivel</a></li></div> </td>
												<td align="center">');
											}else{
												echo ('<div id="ocupado1"><li><a title="'.$nomec[0].'" href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'&n='.$nome.'&d='.$data[0].'">Ocupado</a></li></div>
												</td><td align="center">');
											}
										}else{
											echo ('<div id="bloqueado1"><li><a>Bloqueado</a></li></div> </td> 
											</td><td align="center">');		
										}
										}
										
										// ----------------------
										//Dia 5

										//echo($aux1.' : aux1<br>');
										$aux = MostraDia($dia_semana[5]);
										//echo($aux.' : aux<br>');
										
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[5]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[5]."'");
										$horario = mysql_num_rows($teste);
										//echo($horario.' horario <br><br> ');
										$teste2 = "Select * from horarios_pro";
										$teste2 = mysql_query($teste2,$cn) or die (mysql_error());
										
										//s$horaro_teste = mysql_fetch_assoc($teste);
										//
										//echo('id cliente ='.$id_cli_pro);
										while ($row = mysql_fetch_assoc($teste2)){
											$idp = $row['idprofissional_pro'];
											$idp2 = $row['inicio_pro'];
											$idp3 = $row['data_pro'];
											
											if (($idp == $id_pro) and ($idp2 == $resposta[$aux1][$aux]) and ($idp3 == $data[5])){
												//echo ''. $idp.'=='.$id_pro.', '.$idp2.'=='.$resposta[$aux1][$aux].''.$idp3.'=='.$data[0].'<BR/>';
												$id_cli_pro = $row['id_cliente_pro'];
											}
										}
										//echo('id cliente ='.$id_cli_pro);
										$sql = mysql_query("SELECT `nome_cli` FROM `cliente` WHERE `cpnjcpf_cli` =".$id_cli_pro);
										//echo("Select nome_cli form cliente where cpnjcpf_cli =".$id_cli_pro);
										$nomec = mysql_fetch_row($sql);

			
										$dia = Verifica_dia($dia_semana[5]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										//if ($resposta[$aux1][$aux] < '12:00')
										//{
										$id_hor = verificaID($resposta[$aux1][$aux],$data[5], $id_pro);
										//if ( $horario1[$m] != '00:00:00' )
										
										$SQL2 = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
										$resultad = mysql_query($SQL2);
										$data2 = strtotime($data[5]);
										$data3 = date('d-m', $data2); // aioasidhgahdso
										while ($row = mysql_fetch_array($resultad)) {
											$data4 = $row['data'];
											$data2 = strtotime($data4);
											$data5 = date('d-m', $data2);
											//echo($data3.'=='.$data5.'<br>');
											if ($data3 == $data5){
												$verifica5 = 01;
											}
											
										}
										if ($verifica5 == 01) {
											echo ('<div id="bloqueado1"><li><a title="Feriado">Bloqueado</a></li></div> </td>
											</td><td align="center">');	
										} else {
										if ( $resposta[$aux1][$aux] != '' )
										{
											if ( $horario == 0 )
											{
												echo('<div id="disponivel1"><li><a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[5].'">Disponivel</a></li></div> </td>
												<td align="center">');
											}else {
												echo ('<div id="ocupado1"><li><a title="'.$nomec[0].'" href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'&n='.$nome.'&d='.$data[0].'">Ocupado</a></li></div>
												</td><td align="center">');
											}
										}else{
											echo ('<div id="bloqueado1"><li><a>Bloqueado</a></li></div> </td> 
											</td><td align="center">');	
										}
										}
										
										// ----------------------
										//Dia 6
										//echo($aux1.' : aux1<br>');
										$aux = MostraDia($dia_semana[6]);
										//echo($aux.' : aux<br>');
										//echo("Select * from horarios_pro where idprofissional_pro = ".$id_pro." and inicio_pro = ".$resposta[$i][$aux]." and data_pro = ".$data[6]."<br><Br>");
										$teste = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id_pro."' and inicio_pro = '".$resposta[$aux1][$aux]."' and data_pro = '".$data[6]."'");
										$horario = mysql_num_rows($teste);
										//echo($horario.' horario <br><br> ');
										$teste2 = "Select * from horarios_pro";
										$teste2 = mysql_query($teste2,$cn) or die (mysql_error());
										
										//s$horaro_teste = mysql_fetch_assoc($teste);
										//
										//echo('id cliente ='.$id_cli_pro);
										while ($row = mysql_fetch_assoc($teste2)){
											$idp = $row['idprofissional_pro'];
											$idp2 = $row['inicio_pro'];
											$idp3 = $row['data_pro'];
											
											if (($idp == $id_pro) and ($idp2 == $resposta[$aux1][$aux]) and ($idp3 == $data[6])){
												//echo ''. $idp.'=='.$id_pro.', '.$idp2.'=='.$resposta[$aux1][$aux].''.$idp3.'=='.$data[0].'<BR/>';
												$id_cli_pro = $row['id_cliente_pro'];
											}
										}
										//echo('id cliente ='.$id_cli_pro);
										$sql = mysql_query("SELECT `nome_cli` FROM `cliente` WHERE `cpnjcpf_cli` =".$id_cli_pro);
										//echo("Select nome_cli form cliente where cpnjcpf_cli =".$id_cli_pro);
										$nomec = mysql_fetch_row($sql);

										$dia = Verifica_dia($dia_semana[6]);
										
										$m = $dia[0];
										$t = $dia[1];
										$n = $dia[2];
										$d = $dia[3];
										
										//if ($resposta[$aux1][$aux] < '12:00')
										//{
										$id_hor = verificaID($resposta[$aux1][$aux],$data[6], $id_pro);
										//if ( $horario1[$m] != '00:00:00'  )
										
										$SQL2 = "SELECT * FROM calendario_pro where cidade='nacional' or cidade like '".$tipo[2]."'";
										$resultad = mysql_query($SQL2);
										$data2 = strtotime($data[6]);
										$data3 = date('d-m', $data2); // aioasidhgahdso
										while ($row = mysql_fetch_array($resultad)) {
											$data4 = $row['data'];
											$data2 = strtotime($data4);
											$data5 = date('d-m', $data2);
											//echo($data3.'=='.$data5.'<br>');
											if ($data3 == $data5){
												$verifica6 = 01;
											}
											
										}
										if ($verifica6 == 01) {
											echo ('<div id="bloqueado1"><li><a title="Feriado">Bloqueado</a></li></div> </td>
											</td>');	
										} else {
										if ( $resposta[$aux1][$aux] != '' )
										{
											if ( $horario == 0 )
											{
												echo('<div id="disponivel1" title="disponivel"><li><a href="../horario/cad_horario_prof.php?r='.$id_pro.'&i='.$resposta[$aux1][$aux].'&d='.$data[6].'">Disponivel</a></li></div> </td>');
											}else
											{
												echo ('<div id="ocupado1" onMouseOver=""><li><a title="'.$nomec[0].'" href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id_pro.'&n='.$nome.'&d='.$data[6].'">Ocupado</a></li></div> </td>');
											}
										}else
										{
											echo ('<div id="bloqueado1"><li><a>Bloqueado</a></li></div> </td>');
										}
										}
							
				//--------------------------------------------		
										//$i = $i + 1;	
									echo('</tr>');	
									
							}
							
							echo ('		</table>
										</form> ');
							echo('<div id="proximo" class="efeito_fade">
								<strong><li><a id="mesanterior" href="javascript: submitform3()" title="Mês anterior"><<</a>
								<a id="semanaanterior" href="javascript: submitform1()" title="Semana anterior"><</a></li></strong>
							</div>');
							echo('<div id="proximo2" class="efeito_fade">	
								<strong><li><a id="proximasemana" href="javascript: submitform2()" title="Próxima semana" >></a>
								<a id="proximomes" href="javascript: submitform4()" title="Próximo mês">>></a></li></strong>
							</div>');
								
							echo('<br><br>');
							
							 echo('<form name="myform" method="post" action="../horario/visualizar_horarios.php?p='.$id_pro.'&n='.$nome.'"style="text-align:center;">
							   ');
							   	$sem1 = $data[0];
								$semmais = semanamais($data[0]);
								$semmenos = semanamenos($data[0]);
								$mesmais = mesmais($data[0]);
								$mesmenos = mesmenos($data[0]);
								echo('<div>');
							   echo('A partir da data: <input type="text" size="20" value="'.$sem.'" name="dt" id="data_1" maxlength="10" onKeyPress="mascara(this, \'##-##-####\')" onBlur="TestaData(this)"> 
								<input type="submit" value="Enviar" name="enviar" >');
								echo('</div>');
							echo('</form> ');

							echo('<br><br><fieldset style="width:680px"><legend>Buscar</legend><form action="busca_t.php?s='.$sem.'&p='.$id_pro.'&n='.$nome.'" method="post">');
							   		echo ('Buscar texto:<input type="text" name="cnpjcpf">
									A partir de:<input type="text" style="width:78px; size="20" value="'.$sem.'" name="dt" id="dt" maxlength="10" onKeyPress="mascara(this, \'##-##-####\')" onBlur="TestaData(this)">
									<input type="submit" name="ok" value="ok">');
							   echo('</form>');	
									
							  echo('<tr></tr><form action="busca_h.php?s='.$sem.'&p='.$id_pro.'&n='.$nome.'" method="post">');
							   		echo ('Buscar Cliente pelo nome:<input type="text" name="cnpjcpf">
									A partir de:<input type="text" style="width:78px; size="20" value="'.$sem.'" name="dt" id="dt" maxlength="10" onKeyPress="mascara(this, \'##-##-####\')" onBlur="TestaData(this)">
									<input type="submit" name="ok" value="ok">');
							   echo('</form></fieldset>');	
							   
							  
							  echo('<form name="myform1" method="post" action="../horario/visualizar_horarios.php?p='.$id_pro.'&n='.$nome.'"><input type="hidden" name="dt" id="dt" value="'.$semmenos.'"></form>');
								echo('<form name="myform2" method="post" action="../horario/visualizar_horarios.php?p='.$id_pro.'&n='.$nome.'"><input type="hidden" name="dt" id="dt" value="'.$semmais.'"></form>');	
								echo('<form name="myform3" method="post" action="../horario/visualizar_horarios.php?p='.$id_pro.'&n='.$nome.'"><input type="hidden" name="dt" id="dt" value="'.$mesmenos.'"></form><input type="hidden" name="dt" id="mesmenos" value="'.$mesmenos.'"/>');
								echo('<form name="myform4" method="post" action="../horario/visualizar_horarios.php?p='.$id_pro.'&n='.$nome.'"><input type="hidden" name="dt" id="dt" value="'.$mesmais.'"></form><input type="hidden" name="dt" id="mesmais" value="'.$mesmais.'"/>'); 
					    } // Fecha o else dos horários
					}//Fecha o if do tipo 
										
					?>
				<!--<input type="text" name="nome" onKeyUp="pesquisa(this.value)">
                <div id="pagina">
                </div>-->
			   
               </center>  
               </font> 
			
           </div> <!-- Fecha a div principal 1 -->
		</div> <!-- Fecha a div Principal -->
        <?php
		/*			} else {
						echo('<div id="flash" >');
							include ("../funcoes/menu_teste.html");
							echo ("Não  tem sessão !");
						echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/login.php?r=$id_pro&d=$data&i=$inicio'>");
						echo('</div> ');
					}*/
		?>
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
	//echo($i.'   :i '.$aux.'   : aux  <br><br>');
	while ( $i <= $aux )  // Procura o menor horário por período
	{
		//Passa os horários de string para time
		//echo($horario1[$i].' horário inicial    ||   '.$horario1[$i+1].' horario final      ||    '.$i.'   : i <br><br>');
		if (($horario1[$i] != '00:00:00') && ($horario1[$i+2] != '00:00:00'))
		{ //  horário inicial                   //intervalo
			//echo($i.'  : i <br><br>');
			if ($menor == '')
			{
				$menor = $horario1[$i+2];  // menor intervalo
				$hmenor = $horario1[$i];   //menor horário inicial
				$maior = $horario1[$i+1];  //maior horário final
				//echo($menor.'  : menor - primeiro <br><br>');
				//echo($hmenor.'  : hmenor - primeiro <br><br>');
				//echo($maior.'  : maior  - primeiro <br><br>');
			}
			$hor1 = strtotime($horario1[$i+2]);
			//echo($hor1.'   : hor 1 <br><br> ');
			$hor2 = strtotime($menor); 
			//echo($hor2.'   : hor 2 <br><br> ');
			//Define o menor intervalo de atendimento
			if (( $hor1 < $hor2 ) && ( $hor1 != 0 ))
				$menor = $horario1[$i+2];
		}
		
		//$x = $x + 3;
		
		//Passa os horários de string para time
		if (( $horario1[$i] != '00:00:00') && ( $hmenor != '00:00:00'))
		{
			$hor3 = strtotime($horario1[$i]);
			$hor4 = strtotime($hmenor); 
			//Define qual é o menor horário de início
			if ($hor3 < $hor4 )
				$hmenor = $horario1[$i];
		}
		//$c = $c + 3;
		
		//Passa os horários de string para time
		if (( $horario1[$i+1] != '00:00:00') && ( $maior != '00:00:00'))
		{
			$hor5 = strtotime($horario1[$i+1]);
			$hor6 = strtotime($maior); 
			//Define qual é o maior horário de fim
			if ($hor5 > $hor6 )
				$maior =  $horario1[$i+1];
		}
		//$f = $f + 3;
		$i = $i + 3;
		//echo($menor.'  : menor <br><br> ');
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
			//echo($menor.'  : menor   <br><br>');
			//echo(somahora($cabec[$i],$menor).' =  somahora('.$cabec[$i].','.$menor.')<br><BR>');
			$i = $i + 1;
			$cabec[$i] = somahora($cabec[$i-1],$menor);	
			//$i = $i + 1; // i vai ser considerado a quantidade de horários de atendimento
			//echo($cabec[$i-1].'   : hlateral <br><br>');
		}
		
		$hor1 = $cabec[$i];
		$hor2 = $maior;
		if ($hor1 >= $hor2)
		{
			// para não deixar os horários maiores
			$cabec[$i] = '';	
			$i = $i - 1;
			//echo($cabec[$i].'   : hlateral <br><br>');
		}
	}
	//echo($maior);
	//echo("<br/>");
	//Monta a variável de retorno
	$retorno[0] = $menor;
	$retorno[1] = $hmenor;
	$retorno[2] = $maior;
	$retorno[3] = $cabec;
	return $retorno;
}

function mesmais($sem1){
	list($sem3, $sem2, $sem1) = explode('-', $sem1, 3);
	if ($sem2 == 12) {
		$sem2 = 1;
		$sem3 = $sem3 + 1;
	} else {
		$sem2 = $sem2 + 1;
	}
	$sem1 = $sem1.'-'.$sem2.'-'.$sem3;
	return $sem1;
}

function mesmenos($sem1){
	list($sem3, $sem2, $sem1) = explode('-', $sem1, 3);
	if ($sem2 == 1) {
		$sem2 = 12;
		$sem3 = $sem3 - 1;
	} else {
		$sem2 = $sem2 - 1;
	}
	$sem1 = $sem1.'-'.$sem2.'-'.$sem3;
	return $sem1;
}

function semanamais($sem1)
{
	
	list($sem3, $sem2, $sem1) = explode('-', $sem1, 3);
	$sem1 = $sem1 + '7';
	//echo($sem1.",");
	if (($sem2 == '1') || ($sem2 == '3') || ($sem2 == '5') || ($sem2 == '7') || ($sem2 == '9') || ($sem2 == '11')){
		if ($sem1 > '31'){
			$sem2 = $sem2 +1;
			if ($sem2 < 10){
				$sem2 = '0'.$sem2;
			}
			$sem1 = $sem1 - 31;
			$sem1 = '0'.$sem1;
		}
	}
	if (($sem2 == '4') || ($sem2 == '6') || ($sem2 == '8') || ($sem2 == '10')){
		if ($sem1 > '30'){
			$sem2 = $sem2 +1;
			if ($sem2 < 10){
				$sem2 = '0'.$sem2;
			}
			$sem1 = $sem1 - 30;
			$sem1 = '0'.$sem1;
		}
	}
	if ($sem2 == '12' ) {
		if ($sem1 > '30'){
			$sem2 = 1;
			if ($sem2 < 10){
				$sem2 = '0'.$sem2;
			}
			$sem1 = $sem1 - 30;
			$sem1 = '0'.$sem1;
			$sem3 = $sem3 +1;
		}
	}
	if ($sem2 == '2') {
	$resto = $sem3 % 4;
			if ($resto != 0) {
			  if ($sem1 > 28){ 
				$sem1 = $sem1 - 28;
				$sem1 = '0'.$sem1;
				$sem2 = $sem2 + 1;
				if ($sem2 < 10){
					$sem2 = '0'.$sem2;
				} 
			  }
			}
			if ($resto == 0) {
			  if ($sem1 > 28){ 
				$sem1 = $sem1 - 29;
				$sem1 = '0'.$sem1;
				$sem2 = $sem2 + 1;
				if ($sem2 < 10){
					$sem2 = '0'.$sem2;
				} 
			  }
			}
			
		
	}
	$sem1 = $sem1.'-'.$sem2.'-'.$sem3;
	return $sem1;
}
function semanamenos($sem1)
{
	
	list($sem3, $sem2, $sem1) = explode('-', $sem1, 3);
	//echo($$sem1);
	if ( $sem1 > 7) {
		$x = $sem1-7;
	} else {
		$x = 7-$sem1;
	}
	$y = $sem2;
	//echo(" ".$x);
	//echo($sem2);
	if (($sem2 == 5) || ($sem2 == 7) || ($sem2 == 9) || ($sem2 == 11)){
		if ($sem1 < 8){
			$y = $sem2 - 1;
			if ($y < 10){
				$y = '0'.$y;
			}
			
			$x = 30 - $x;
			//echo($x."-");
			//$sem1 = '0'.$sem1;
		}
	}
	if (($sem2 == 2) || ($sem2 == 4) || ($sem2 == 6) || ($sem2 ==8) || ($sem2 == 10) || ($sem2 == 12)){
		if ($sem1 < 8){
			$y = $sem2 - 1;
			if ($y < 10){
				$y = '0'.$y;
			}
			
			$x = 31 - $x;
			//echo($x."-");
			//echo($sem1.".".$x);
			//$sem1 = '0'.$sem1;
		}
	}
	if ($sem2 == 1) {
		if ($sem1 < 8){
			$y = 12;
			if ($sem2 < 10){
				$sem2 = '0'.$sem2;
			}
			$x = 30 - $x;
			//$sem1 = '0'.$sem1;
			$sem3 = $sem3 - 1;
			//$sem3 = '0'.$sem3;
		}
	}
	if ($sem2 == 3){
		$resto = $sem3 % 4;
		if ($sem1 < 8){
			if ($resto != 0){
				$x = 28 - $x;
				//$sem1 = '0'.$sem1;
				$y = $sem2 - 1;
				if ($y < 10){
					$y = '0'.$sem2;
				}
			}
			if ($resto == 0){
				$x = 29 - $x;
				//$sem1 = '0'.$sem1;
				$y = $sem2 - 1;
				if ($y < 10){
					$y = '0'.$y;
				}
			} 
			
		}
	}
	//echo($x."-");
	$sem1 = $x.'-'.$y.'-'.$sem3;
	return $sem1;
}
?>

