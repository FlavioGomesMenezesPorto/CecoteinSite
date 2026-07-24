<html>
	<head>
		<title>CProfissionais - Lista de profissionais </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/lista.css" type="text/css" rel="stylesheet">
	</head>	
 	<!-- ##################################################################################### -->
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
					include ("../funcoes/menu_teste.html");
				?>
            </div>	<!-- Fecha a div Flash -->
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
			?>
            <div class="conteudo">
            	<p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>      
                <?php 
					if($_GET['r']=='advogado')
					{
                		echo"<h1> <font color='#FFFFFF'> Lista de advogados </font> </h1>";
					}
					else
					{
						if($_GET['r']=='informatica')
						{
							echo " <h1> <font color='#FFFFFF'> Lista de profissionais de informática </font> </h1>";
						}
						else
					    {
							if($_GET['r']=='dentista')
							{
								echo "<h1> <font color='#FFFFFF'> Lista de dentistas </font> </h1>";
							}
							else
							{
								if($_GET['r']=='medico')
								{
									echo "<h1> <font color='#FFFFFF'> Lista de médicos </font> </h1>";
								}
							}
						}
					}
					
                ?>            
                <div id="mostrar">
                 <center>
					<?php
						
						include '../funcoes/conecta.php';
 
                            			mysql_select_db(BASE,$cn)or die(mysql_error());

						//Fazendo a busca apenas do ID e do nome no db.
						
						$r = $_GET['r'];
						$busca = mysql_query("SELECT id_pro,nome_pro,registro_pro,especialidade_pro,categoria_pro,foto_pro, tipo FROM cadastro_profissionais where categoria_pro = '$r'")or die(mysql_error());
						//verifico se existe dados dentro da tabela.
						if(!mysql_num_rows($busca))
						{// se não tiver, ele imprime um erro.
						   echo 'Nenhum dado cadastrado na base de dados.';
						}
						else
						{
						    while($ver=mysql_fetch_row($busca))
							{
								$id = $ver[0]; //corresponde ao campo ID, pois estamos trabalhando com vetor.
								$nome = $ver[1];//corresponde ao campo nome.
								$registro = $ver[2];//corresponde ao campo registro.
								$especialidade = $ver[3];//corresponde ao campo especialidade.
								$categoria = $ver[4];//corresponde ao campo categoria.
								$foto = $ver[5]; // foto
								$tipo = $ver[6];// tipo
								
								
								echo "	<table border='2' cellpadding='3' cellspacing='0' bordercolor='#000000'>	
										<tr bgcolor='#66CDAA'>
											<td colspan='5'><b>".$nome."</b></td>
										</tr>
								
										<tr>
											<td bgcolor='#66CDAA'>Especialidade</td>
											<td><b> ".$especialidade."</b> </td>
											<td width='100px' height='100px'  rowspan='3'>";
											if ($foto == '')
											{
												echo (' <img src="../imagens/nophoto.jpg" width="95px" height="80" border="0">');
											}
											else
											{
												echo('<img src="'.$foto.'" width="95px" height="80" border="0">');
											}
											echo("</td>
										</tr>
										<tr>
											<td bgcolor='#66CDAA' width='50px'>Categoria</td>
											<td><b>".$categoria."</b></td>
										</tr>
										<tr>
											");
										if ($tipo == 'empresa')
										{
											echo("
											<td colspan='4' width='50px'>
											 <a href=../principais/perfil_emp.php?r=".$id."><input type='button' value='Visualizar ficha inteira' name='visualizar'></a>
											 </font>
											 </td>
											</tr>
											");
										}
										else
										{
											echo("
											<td colspan='4' width='50px'>
											<a href=../horario/horario1.php?r=".$id."><input type='button' value='Horários' name='horario'></a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;
											
											 <a href=../principais/perfil.php?r=".$id."><input type='button' value='Visualizar ficha inteira' name='visualizar'></a>
											</font>
											</td>
											
								    	</tr>
									       ");
										}
								  echo("
									</table>
									<br><br>
									");
								
							}
						}
					?>
				 </center>
				</div> <!-- Fecha a div Mostrar -->
			</div> <!-- Fecha a div Conteudo -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>