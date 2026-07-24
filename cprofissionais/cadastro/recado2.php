<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home </title>
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
               <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a>

            </div>
            
            <div id="flash" >
               <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>-->
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
				
				$dest = !empty($_GET["p"])?$_GET["p"]:""; //nome
				$mes = !empty($_POST["mens"])?$_POST["mens"]:"";  //mensagem
				$remet = !empty($_GET["i"])?$_GET["i"]:""; //id do destinatario
				$x = 0;
				
           echo(' <div id="menu">');
		   		include '../funcoes/menu.php';
           echo(' </div> ');
		   
		   include '../funcoes/conecta.php';
		   
		   mysql_select_db(BASE,$cn)or die(mysql_error());
           date_default_timezone_set('UTC');
           
		   //seleciona o nome e a empresa do profissional que está criando o recado
		   $pesquisa = mysql_query("Select nome_pro, empresa, tipo from cadastro_profissionais where id_pro = '$id'") or die(mysql_error());
		   $prof = mysql_fetch_row($pesquisa);
		   
		   echo('<div id="corpo">');
		   echo('<img src="../imagens/agenda_recado.png" alt="recados" title="recados" width="100px" height="100px" align="left">');
		   
		   if ($id == 0 )
		   {
			   echo("<br><br><br> Nenhum profissional logado no sistema! 
			   <br><br> <a href='../principais/index.php'><input type='button' name='voltar' title='voltar' value='Voltar'></a>");
			  
		   }
		   else
		   {
				if ( $prof[2] <> 'profissional')
				{
					echo("<br><br><br> Nenhum profissional logado no sistema! 
			  		<br><br> <a href='../principais/index.php'><input type='button' name='voltar' title='voltar' value='Voltar'></a>");
				}
				else
				{
					echo('
					<font face="Arial" color="#FFFFFF" size="+1">
					 <form name="recados" method="post" action="../cadastro/salva_recado.php">
						  <table align="center" style="text-align:left;">
							<tr>
								<td> Nome do profissional: <input type="text" size="40" name="nome" id="nome" value="'.$dest.'"> &nbsp&nbsp&nbsp <a href="../cadastro/busca_prof2.php"><img src="../imagens/botoes/busca.png" align="absbotton" ></a></td>
							</tr> ');
				echo('</form> ');
				$pesquisa = mysql_query("Select * from recados_pro where  destinatario='".$remet."'") or die(mysql_error());
			   	
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
							
			$pesquisa = mysql_query("Select nome_pro from cadastro_profissionais where id_pro = ".$remet) or die( mysql_error() );
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
		   }
           echo('</div>  <!-- Fecha a div "Corpo" -->');
           
         ?>   
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
