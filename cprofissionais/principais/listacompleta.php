<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>CProfissionais - Lista de Profissionais </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/lista.css" type="text/css" rel="stylesheet">
	</head>	
<!-- #################################################################################### -->
	<body>
		<div class="principal">
    
            <div id="cabeca" >
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
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
            </div>	<!-- Fecha a div Flash-->
            <?php
				session_start();
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;
				if(isset($_COOKIE['pro']))
					$id_pro = $_COOKIE["pro"];
				else
					$id_pro = 0;
					
					$i = !empty($_GET["i"])?$_GET["i"]:"";
					$d = !empty($_GET['d'])?$_GET["d"]:"";
					

			?>       
            <div class="conteudo">
            	<p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>      
                <div id="mostrar">
                    <center>
                    <h1> <font color='#FFFFFF'> Lista de Cadastro </font></h1>
    
                    <div>
                        <?php
                            include '../funcoes/conecta.php';
                            mysql_select_db(BASE,$cn)or die(mysql_error());
							
							
                            //Fazendo a busca apenas do ID e do nome no db.
                            	$busca = mysql_query("SELECT id_pro,nome_pro,registro_pro,especialidade_pro,categoria_pro,foto_pro, tipo FROM cadastro_profissionais where ativo = '1'")or die(mysql_error());
							/*$x = 0;
							while ($linha = mysql_fetch_array($busca)) {
								$id_pro[$x] = $linha['id_pro'];
								$x = $x + 1;
							}*/
							
                            //verifico se existe dados dentro da tabela.
                            if(!mysql_num_rows($busca))
                            { // se não tiver, ele imprime um erro.
                               echo "Nenhum dado cadastrado na base de dados.";
                            }
                            else
                            {
								if(isset($_COOKIE['cli'])){
									echo "	<table border='2' cellpadding='3' cellspacing='0' bordercolor='#000000' >	
												
													
													<tr bgcolor='#66CDAA'>
														<td colspan='5'><a href='../horario/horario_cliente.php'><input type='button' value='Seu Horario'/></a></td>
													</tr> ";
													//echo($i);
													//echo($d);
								}
								
								$x=0;
                                while($ver = mysql_fetch_row($busca))
                                {
                                    $id = $ver[0];             //corresponde ao campo ID, pois estamos trabalhando com vetor.
                                    $nome = $ver[1];           //corresponde ao campo nome.
                                    $registro = $ver[2];       //corresponde ao campo registro.
                                    $especialidade = $ver[3];  //corresponde ao campo especialidade.
                                    $categoria = $ver[4];      //corresponde ao campo categoria.
                                    $foto = $ver[5];           //foto
            						$tipo = $ver[6];
									//echo($id);
									$sql =mysql_query("select * from horarios_pro where idprofissional_pro= '".$id."' and inicio_pro= '".$i."' and data_pro= '".$d."' ");
								
									
									if ($tipo != 'admin')
									{
										
										echo "	<table border='2' cellpadding='3' cellspacing='0' bordercolor='#000000' >	
												<tr bgcolor='#66CDAA'>
													<td colspan='5'><b>".$nome."</b></td>
												</tr>
										
												<tr>
													<td bgcolor='#66CDAA'> Especialidade</td>
													<td>".$especialidade."</td>
													<td width='100px' height='100px'  rowspan='3'>
													";
													if ($foto == '')
													{
														echo (' <img src="../imagens/nophoto.jpg" width="95px" height="80">');
													}
													else
													{
														echo('<img src="'.$foto.'" width="95px" height="80">');
													}
													
													echo"
												</tr>
										
												<tr>
													<td bgcolor='#66CDAA' width='50px'> Categoria</td>
													<td>".$categoria."</td>
												</tr>
												<tr> ";
													   if ($tipo == 'empresa')
														{
															echo("
															<td colspan='4' width='50px'>
															 <a href='../principais/perfil_emp.php?r=".$id."&c=".$id_cli."'><input type='button' value='Visualizar ficha inteira' name='visualizar'></a>
															 </font>
															 </td>
															</tr>
															");
														}
														else
														{
														if (($i=="") and ($d=="")){ //O botão sai travado.
															echo("
															<td colspan='4' width='50px'>
															<a href='../horario/horario1.php?r=".$id."&c=".$id_cli."&n=".$nome."'><input type='button' value='Horários' name='horario' title='Horario vizualizado por clientes' disabled></a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;");
														} else if ($id_pro != 0){ //O botão sai normal
															echo("
															<td colspan='4' width='50px'>
															<a href='../horario/horario1.php?r=".$id."&c=".$id_cli."&n=".$nome."'><input type='button' value='Horários' name='horario' title='Horario vizualizado por clientes' ></a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;");
														}else{
															if (!mysql_num_rows($sql)) {
																echo("
																<td colspan='4' width='50px'>
																<a href='../horario/agendar_confirma.php?r=".$id."&c=".$id_cli."&i=".$i."&d=".$d."'><input type='button' value='Agendar' name='horario' title='marcar no horario escolhido'></a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;");
															} else {
																echo("
																<td colspan='4' width='50px'>
																<a href='../horario/horario1.php?r=".$id."&c=".$id_cli."&n=".$nome."'><input type='button' value='Indisponível' name='horario' title='Vizualizar grade de horarios'></a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;");
															}
														}
															
															echo(" <a href='../principais/perfil.php?r=".$id."&c=".$id_cli."'><input type='button' value='Visualizar ficha inteira' name='visualizar'></a>
															 </td>
														</tr>
														   ");
														}
											 echo "
													</td>
												</tr>
											</table>
											<br><br>";
									}
									$x=$x+1;
                                }
								
                            }
                        ?>
                          
                    </div> 
                   </center> 
                </div> <!-- Fecha a div Mostrar -->
			</div> <!-- Fecha a div Conteudo -->
	     </div> <!-- Fecha a div Principal -->
	</body>
</html>