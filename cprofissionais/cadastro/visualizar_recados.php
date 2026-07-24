<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Recados </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/home.css" type="text/css" rel="stylesheet">
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
                </object> -->
                <?php
					include ("../funcoes/menu_teste.html");
				?>
            </div>
            <?php
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;
				
				session_start();
				
           echo(' <div id="menu">');
		   
		   	include '../funcoes/menu.php';
           
		   echo(' </div> ');
		   
		   echo('<div id="recados">
		   			<font face="Arial" size="+1" color="#FFFFFF"> ');
					
		   include '../funcoes/conecta.php';
		   mysql_select_db(BASE,$cn)or die(mysql_error());
           date_default_timezone_set('UTC');
           
		   //-------------------
		   //Definindo variáveis
		   
		   $x = 0;
		   
		   //------------------
		   
		   $pesquisa = mysql_query("Select nome_pro, empresa from cadastro_profissionais where id_pro = '$id'") or die(mysql_error());
		   $nome_c = mysql_fetch_row($pesquisa);
		   
    	   //strpos(); // retorna a posição de uma string
		   //substr(); // retorna parte da posição de uma string
		   
		   //$nome = substr($nome_c[0],0,strpos($nome_c[0],' '));
		   
		   echo(' <img src="../imagens/agenda_recado.png" alt="recados" title="recados" width="100px" height="100px" align="left">
		    <p align="right"><a href="../principais/index.php"><input type="button" name="voltar" value="Voltar"></a> 
		   <a href="../cadastro/recado.php"><input type="button" name="cria" value="Criar recado"></a></p>
		   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <img src="../imagens/recados.png" width="150" height="45">
		    <br><br>
		   ');
		   
		   if ($id == 0 )
		   {
			   echo("Nenhum profissional logado no sistema! ");
			  
		   }
		   else
		   {	
		   		if ($id == 70) {
					echo('nome do profissional: <input type="text" size="40" name="nome" id="nome" value="'.$dest.'"> &nbsp&nbsp&nbsp <a href="../cadastro/busca_prof2.php"><img src="../imagens/botoes/busca.png" align="absbotton" ></a><br>');
				}
			   $pesquisa = mysql_query("Select tipo from cadastro_profissionais where id_pro = '$id'") ;
			   $tipo = mysql_fetch_row($pesquisa);
			   
			   if ($tipo[0] == 'empresa')
			   {	
			   		//echo($nome_c[0].'empresa');										          
				   $pesquisa = mysql_query("Select * from recados_pro where  empresa like '%".$nome_c[0]."%' ") or die(mysql_error());
			   
				   while( $row = mysql_fetch_assoc($pesquisa) )
				   {
					   $recado[$x][0] = $row['id'];
					   $recado[$x][1] = $row['empresa'];
					   $recado[$x][2] = $row['destinatario'];
					   $recado[$x][3] = $row['remetente'];
					   $recado[$x][4] = $row['hora'];
					   $recado[$x][5] = $row['dia'];
					   $timestamp = strtotime($recado[$x][5]);
					   $recado[$x][5] = date('d-m-Y', $timestamp);
					   $recado[$x][6] = $row['mensagem'];
					   
					   $x = $x + 1;
				   }
				   
				   if ($x == 0 )
						echo(" Não há nenhum recado para estes profissionais!");
				   else
				   {
					     /*<form action="../cadastro/altera_recado1.php" method="post" name="mens">
						 Mensagem a ser alterada:
						 
						 <textarea name="mensagem" cols="40" rows="6" style="font-family="Arial"> '.$mes.' </textarea>
						 <input type="hidden" name="id" value="'.$id.'">
						 <input type="submit" value="Salvar" name="salvar">
						 */
						 
						echo('
						<table> 
							<tr>
								<td colspan="2" align="center"> <font color="#EE2C2C"> 
									Destinatário &nbsp&nbsp&nbsp 
									<font color="#FFFFFF"> -- </font> &nbsp&nbsp&nbsp Mensagem &nbsp&nbsp&nbsp 
									<font color="#FFFFFF"> -- </font> &nbsp&nbsp&nbsp Remetente &nbsp&nbsp&nbsp 
									<font color="#FFFFFF"> -- </font> &nbsp&nbsp&nbsp Dia &nbsp&nbsp&nbsp 
									<font color="#FFFFFF"> -- </font> &nbsp&nbsp&nbsp Hora </font> <br><br> </td>
								</td> &nbsp&nbsp&nbsp </td>
							</tr> 	'); 
							
						for ($y = 0 ; $y < $x ; $y ++ )
						{
							//$remet = substr($recado[$y][3],0,strpos($recado[$y][3],' '));
							//Destinatário é o código do funcionário
							
							$pesquisa = mysql_query("Select nome_pro from cadastro_profissionais where id_pro = ".$recado[$y][2]) or die( mysql_error() );
							$nome = mysql_fetch_row($pesquisa);
							$num = mysql_num_rows($pesquisa);
							
							if ($num > 0) 
							{
							
								$tempo = strtotime($recado[$y][5]);
								$dia = date('d-m-Y', $tempo);
								echo(" 
									<tr>
										<td> ".$nome[0]." 
										<font color='#EE2C2C'> -- </font> ".$recado[$y][6]." 
										<font color='#EE2C2C'> -- </font> ".$recado[$y][3]." 
										<font color='#EE2C2C'> -- </font> ".$recado[$y][5]."
										<font color='#EE2C2C'> -- </font> ".$recado[$y][4]." </td>
										<td> <form action='../cadastro/altera_recado.php' method='post' name='envia'>
												 <input type='hidden' value='".$recado[$y][6]."' name='mes'>
												 <input type='hidden' value='".$recado[$y][0]."' name='id'> 
												 <input type='submit' value='Alterar' name='alterar'>
											 </form>
										</td>
										<td> <a href='../cadastro/exclui_recado.php?h=".$recado[$y][4]."&r=".$recado[$y][3]."&e=".$recado[$y][1]."&d=".$recado[$y][5]."'>
											 <input type='button' name='excluir' value='Excluir'></a> 
										 </td>
									</tr>
									<tr> <td> <br><br> </td></tr> 	");
							}
							
						}
						echo("</table> ");
				   }
			   }
			   else
			   {
				 $pesquisa = mysql_query("Select * from recados_pro where destinatario = $id and empresa like '%".$nome_c[1]."%' ") or die(mysql_error());
				   
				   while( $row = mysql_fetch_assoc($pesquisa) )
				   {
					   $recado[$x][0] = $row['id'];
					   $recado[$x][1] = $row['empresa'];
					   $recado[$x][2] = $row['destinatario'];
					   $ver = mysql_query("Select nome_pro from cadastro_profissionais where id_pro = '$id'") or die (mysql_error());
					   $recado[$x][2] = mysql_fetch_row($ver);
					   $recado[$x][3] = $row['remetente'];
					   $recado[$x][4] = $row['hora'];
					   $recado[$x][5] = $row['dia'];
					   $timestamp = strtotime($recado[$x][5]);
					   $recado[$x][5] = date('d-m-Y', $timestamp);
					   $recado[$x][6] = $row['mensagem'];
					   
					   $x = $x + 1;
				   }
				   
				   if ($x == 0 )
						echo(" Não há nenhum recado para este profissional!");
				   else
				   {
						echo('
						<table> <tr>
								<td colspan="2" align="center"> <font color="#EE2C2C"> 
									Mensagem  &nbsp&nbsp&nbsp 
									<font color="#FFFFFF"> -- </font> &nbsp&nbsp&nbsp Remetente &nbsp&nbsp&nbsp 
									<font color="#FFFFFF"> -- </font> &nbsp&nbsp&nbsp Dia &nbsp&nbsp&nbsp 
									<font color="#FFFFFF"> -- </font> &nbsp&nbsp&nbsp Hora 
								</font> <br><br> </td>
								<td>  &nbsp&nbsp&nbsp </td>
							</tr> 	');
						
						for ($y = 0 ; $y < $x ; $y ++ )
						{
							//$remet = substr($recado[$y][3],0,strpos($recado[$y][3],' '));
							echo(" 
							<tr> ");
								$mensagem = $recado[$y][6];
								echo("
								<td> ".$recado[$y][6]."
								     <font color='#EE2C2C'> -- </font> ".$recado[$y][3]."
									 <font color='#EE2C2C'> -- </font> ".$recado[$y][5]."
									 <font color='#EE2C2C'> -- </font> ".$recado[$y][4]." </td>
								<td> <form action='../cadastro/altera_recado.php' method='post' name='envia'>
										 <input type='hidden' value='".$recado[$y][0]."' name='id'> 
										 <textarea  style='visibility:hidden; display:none' name='mes'>".$mensagem."</textarea>  
										 <input type='submit' value='Alterar' name='alterar'>
									 </form>
								</td>
								<td> <a href='../cadastro/exclui_recado.php?h=".$recado[$y][4]."&r=".$recado[$y][3]."&e=".$recado[$y][1]."&d=".$recado[$y][5]."'>
								 	 <input type = 'button' name='excluir' value='Excluir'></a>
								</td>
							</tr>
						    <tr> <td> <br><br> </td> </tr>
							</form> ");
						}
						echo("</table> ");
				   }
			   }
		   }
		   echo(' </font>
		   </div>');
         ?>   
          
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
