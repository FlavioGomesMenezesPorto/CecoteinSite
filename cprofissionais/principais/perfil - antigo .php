<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<title> CProfissionais - Perfil </title>
        <script>        
			var aAbas       = new Array();  // Lista de abas do documento atual
			var sAbaAtiva   = ""            // Define qual é a aba ativa no momento
			var ABA_ID      = 1
			var ABA_BLOCO   = 2
			var ABA_CAMPOS  = 3
			
			function defineAba( sId, sBloco )
			{
			   var aAba  = new Array( ABA_CAMPOS );
			   aAba[ ABA_ID    ]  = sId;
			   aAba[ ABA_BLOCO ]  = sBloco;
			   aAbas.push( aAba );
			}
	
			function defineAbaAtiva( sId )
			{
			   trataCliqueAba( sId );
			}
	
			function trataMouseAba( oAba )
			{
			   oAba.style.cursor  = "pointer";
			}
	
			function trataCliqueAba( sId )
			{
				for ( var iAba  = 0; iAba < aAbas.length; iAba++ )
			   {
				  var aAba  = aAbas[ iAba ];
				  if ( aAba[ ABA_ID ] == sId ) ativaAba( aAba );
				  else inativaAba( aAba );
			   }
			}
	
			function ativaAba( aAba )
			{
			   var sAba       = aAba[ ABA_ID ];
			   var oAba       = document.getElementById( sAba );
			   mudaClasse( oAba, "abaativa" ); // Esse comando chama a classe css para fazer a troca
	
			   var sBlocoAba  = aAba[ ABA_BLOCO ];
			   var oBlocoAba  = document.getElementById( sBlocoAba );
			   oBlocoAba.style.display  = "block";
			}
	
			function inativaAba( aAba )
			{
			   var sAba       = aAba[ ABA_ID ];
			   var oAba       = document.getElementById( sAba );
			   mudaClasse( oAba, "abainativa" ); // Esse comando chama a classe css para fazer a troca
	
			   var sBlocoAba  = aAba[ ABA_BLOCO ];
			   var oBlocoAba  = document.getElementById( sBlocoAba );
			   oBlocoAba.style.display  = "none";
			}
			
			function mudaClasse( oObjeto, sClasse )
			{
			   oObjeto.className  = sClasse;
			}
        </script>
		<link href="../estilos/home.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body>
		<div class="principal">

            <div id="cabeca" >
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>
            </div>
            <?php
				session_start();
			?>
            <div id="corpo" style="left:50px">
            	<p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>

            	<center>
                    <font face="arial" color="#FFFFFF" size="4"> Perfil do Profissional </font>
                    <br><br>
                    <!-- Criação das abas -->
                    <table width="80%" border="0" cellpadding="0" cellspacing="1">
                        <tr>
                            <td width="10%" height="36" align="center" valign="middle" class="abaativa" id="Ficha-1" onClick="trataCliqueAba( this.id );" onMouseOver="trataMouseAba( this );"> Dados Comuns </td>
                            
                            <td id="Ficha-2" align="center" valign="middle" width="10%" class="abainativa" onMouseOver="trataMouseAba( this );" onClick="trataCliqueAba( this.id );"> Observações (Curriculum) </td>
                            
                            <td id="Ficha-3" align="center" valign="middle" width="10%" class="abainativa" onMouseOver="trataMouseAba( this );" onClick="trataCliqueAba( this.id );"> Horários </td>
                            
                        </tr>
                    </table> 
                         
						 <?php 
						    include '../funcoes/conecta.php';
						 	include '../funcoes/somaHora.php'; 
						 	mysql_select_db(BASE,$cn)or die(mysql_error());
						 
						// session_start();
						 
							if(isset($_COOKIE['cli']))
								$id_cli = $_COOKIE["cli"];
							else
								$id_cli = 0;
			
							if(isset($_COOKIE['pro']))
								$id1 = $_COOKIE["pro"];
							else
								$id1 = 0;
							
							$id = !empty($_GET["r"])?$_GET["r"]:$id1;	
							$de = 0;
							$ate = 1;
							$tem = 2;
							$x = 0;
							$d = 0;
							$ultimo[0] = 0;
							$maior = 0;
							//echo ($id); 
							$busca = mysql_query("SELECT nome_pro, registro_pro, especialidade_pro, categoria_pro, endereco_pro, bairro_pro, cidade_pro, estado_pro, telefone_pro, foto_pro, id_pro, numero_pro, observacao_pro from cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
								//verifico se existe dados dentro da tabela.
								
								//echo ($busca);
								if(!mysql_num_rows($busca))
								{// se não tiver, ele imprime um erro.
								   echo  "<font face=\"Arial\" color=\"#FFFFFF\" size=\"3pt\"> Perfil não encontrado! </font>";
								}
								else
								{
									while($ver=mysql_fetch_row($busca))
									{
										
										$nome=$ver[0];//corresponde ao campo nome.
										$registro=$ver[1];//corresponde ao campo registro.
										$especialidade=$ver[2];//corresponde ao campo especialidade.
										$categoria=$ver[3];//corresponde ao campo categoria.
										$endereco = $ver[4]; //endereço
										$bairro = $ver[5]; //bairro
										$cidade = $ver[6]; //cidade
										$estado = $ver[7]; //estado
										$telefone = $ver[8]; //telefone
										$foto=$ver[9];//foto
										$id=$ver[10]; //corresponde ao campo ID, pois estamos trabalhando com vetor.
										$numero = $ver[11]; //número
										$observacao = $ver[12];
										echo(" 
											<div id='dados' style='display: none ; top: 158px'>
											<table>
												<tr> 
													<td colspan='5' ><center><b> ".$nome." </b></center> </td>
												</tr>
												<tr> 
													<td rowspan='5'> ");
													if ($foto == '')
													{
														echo (' <img src="../imagens/nophoto.jpg" width="95px" height="110" border="0">');
													}
													else
													{
														echo('<img src="'.$foto.'" width="95px" height="80">');
													}
													echo(" </td>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
												 </tr>
												<tr>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> <font color='#FFFFFF' size='4pt'> Registro: </font> </td>
													<td> ".$registro."</td>
												</tr>
												<tr>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> <font color='#FFFFFF' size='4pt'> Especialidade: </font> </td>
													<td> ".$especialidade." </td>
												</tr>
												<tr>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> <font color='#FFFFFF' size='4pt'> Categoria: </font> </td>
													<td> ".$categoria." </td>
												</tr>
												<tr> 
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> <font color='#FFFFFF' size='4pt'> Endereço: </font> </td>
													<td> ".$endereco." </td>
												</tr>
												<tr>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> </td>
													<td> <font color='#FFFFFF' size='4pt'> Número: </font> </td>
													<td> ".$numero." </td>
												</tr>
												<tr>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> </td>
													<td> <font color='#FFFFFF' size='4pt'> Bairro: </font> </td>
													<td> ".$bairro." </td>
												</tr>
												<tr>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> </td>
													<td> <font color='#FFFFFF' size='4pt'> Cidade: </font> </td>
													<td> ".$cidade." </td>
												</tr>
												<tr>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> </td>
													<td> <font color='#FFFFFF' size='4pt'> Estado: </font> </td>
													<td> ".$estado." </td>
												</tr>
												<tr>
													<td> &nbsp&nbsp&nbsp&nbsp </td>
													<td> </td>
													<td> <font color='#FFFFFF' size='4pt'> Telefone: </font> </td>
													<td> ".$telefone." </td>
												</tr>
											</table> </div> ");
											
											echo ("
												<div id='obs' style='display: none; top: 158px'>
													<br><br>
													<form>
														<textarea rows='15' cols='90' style='font-family:Arial;'> ".$observacao."</textarea>
                                        				 </form>
										         </div>  <!--Fecha a div obs --> ");
												 
										    echo ("<div id='horarios' style='display: none; top: 158px'>
														<br><br>
													");
													$horario = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());	
													
													$hor = mysql_fetch_row($horario);
													//echo($hor[0].'horario');
													if ( $hor[0] == '' )
													{
														echo(' <img src="../imagens/atencao.png" width="60px" height="60px" align="middle"> <font size="+2"> Não foi possível encontrar os horários! </font>');
													}
													else
													{
														echo(' <form method="post" name="horario">
									<table name="horario" border="2" bordercolor="#66CDAA" cellspacing="0" cellpadding="4" 	 style="width:800px;">								
										<tr> 
											<td align="center"> Segunda-feira</td>
											<td align="center"> Terça-feira </td>
											<td align="center"> Quarta-feira</td>
											<td align="center"> Quinta-feira </td>
											<td align="center"> Sexta-feira </td>
											<td align="center"> Sábado </td>
											<td align="center"> Domingo </td>
										 </tr> 
										 <tr> ');
														
										while ( ( $de < 81 ) && ( $ate < 82 ) && ( $tem < 83 ) )
										{
											echo ("<br>".$hor[$de]."   Mostrando horário ".$de." <br><br>");
											echo ("<br>".$hor[$ate]."   Mostrando horário ".$ate." <br><br>");
											echo ("<br>".$hor[$tem]."   Mostrando horário ".$tem." <br><br>");
											if ($hor[$de] && $hor[$ate] != 0)
											{
												$resposta[$x][$d] = $hor[$de];
												//echo ($x.'   Mostrando X  <br> ');
												//echo($d.' : d');
												//echo($resposta[$x][$d].'   Mostrando resultado [' .$x. '][ '.$d.' ] <br>');
												//$x = $x + 1;
												//echo ($hor[$ate].'  Mostrando horario 1 <br>');
												echo('<br><br>'.$d.' : d  <br><Br> ');
												
												while ( $resposta[$x][$d] < $hor[$ate] )
												{
													echo($x.' : x <br><br><Br> ');
													echo('<br>'.$resposta[$x][$d].'   Mostrando resultado[' .$x. '][ '.$d.' ] <br>');
													$x = $x + 1;  
													$resposta[$x][$d] = somahora($resposta[$x-1][$d],$hor[$tem]);
												}
												if ($resposta[$x][$d] > $hor[$ate])
												{
													$resposta[$x][$d]= '';
													$x = $x - 1;
													echo('<br>'.$resposta[$x][$d].'   Mostrando resultado[' .$x. '][ '.$d.' ] <br>');
												}
												$ultimo[$d] = $x;
												//echo($d.' d <br>');
											}
											else
											{
												// para inicializar a posição do vetor
												$ultimo[$d] = 0;
											}
											echo('<br><br> ultimo[x]:'.$ultimo[$d].' = '.$x.' : $ultimo[' .$d. '] = ' .$x.' <br><Br>'); 
											
											//passa a verificar o mesmo período do próximo dia
											$de = $de + 3;
											$ate = $ate + 3;
											$tem = $tem + 3;
											$d = $d + 1;
											$x = 0;
											echo('<br><br>'.$hor[$de].' : hora[de] '.$de.' :de <br><br>');
											if ( $de > 21) // ultimo registro da manha 
											{
												$x = $ultimo[$d-1];
											}
											if ($hor[$de] && $hor[$ate] == 0) 
											{   //se os mesmos horários do dia seguinte for 0 então passa para o próximo dia
												$de = $de + 3;
												$ate = $ate + 3;
												$tem = $tem + 3;
												$x = $ultimo[$d-1];
												$d = 0;
											}
										}
										$ultimo[6] = -1;
										$d = $d + 1;	
										$x = 0;
										for ($d = 0 ; $d < 7 ; $d++)
										{
											//echo($d. ', '.$x.' : d e x <br>');
											
											//Seleciona a maior posição do vetor ultimo
											for ( $cont = 0 ; $cont < 7 ; $cont++ )
											{
												if ( $maior < $ultimo[$cont] )
													$maior = $ultimo[$cont];
											}
											
											if ( $x <= $maior)
											{
												echo($d. ', '.$x.' : d e x <br>');
												if ( $x > $ultimo[$d])
													$resposta[$x][$d] = ' ';
												
												//echo($ultimo[$d]. ' : ultimo <br>');
												echo($x.'  : x <br><br> ');
												echo($d.'  : d <br><br> ');
												echo ('<td align="center"> '.$resposta[$x][$d].'</td>');
												if ($d == 6)
												{
													echo('</tr>
													<tr>
													');
													$x = $x + 1;
													$d = -1;
												}
											}
											
										}
										echo('
													</tr>
												</table>
											</form>
										</div>');
													}
									} 
								}
							
							?>
             	</center>
		
            </div> <!--Fecha a div corpo -->
    	</div>  <!-- Fecha a div principal -->
       <script>
            defineAba( "Ficha-1" , "dados");
            defineAba( "Ficha-2" , "obs");
            defineAba( "Ficha-3" , "horarios");
            defineAbaAtiva( "Ficha-1" );
       </script>    
	</body>
</html>
