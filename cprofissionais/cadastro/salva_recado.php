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
               <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 

            </div>
            
            <div id="flash" >
               <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object> --->
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
				print("idpro = $id");
				
           echo(' <div id="menu">');
		   
		   	include '../funcoes/menu.php';
           
		   echo(' </div> ');
		   
		   echo('<div id="corpo">
		   			<font face="Arial" size="+1" color="#FFFFFF"> ');
					
		   include '../funcoes/conecta.php';
		   include '../funcoes/funcoes.php';
		   $hora = date("H:i:s");  //hora
		   // echo($hora);
		   mysql_select_db(BASE,$cn)or die(mysql_error());
           date_default_timezone_set('UTC');
           
		   $dest = $_POST["nome"];  //destinatário
		   $remet = $_POST["prof"];  //remetente
		   $emp = $_POST["empresa"]; //empresa
		   $mes = $_POST["mensagem"]; //mensagem
		   		   
		   
		   $dia_s = date("Y-m-d");  //data para o servidor
		   $dia   = date("d/m/Y");  //data para visualização

		   $x = 0;
		   
		   $mes = substitui_str($mes);
		   
		   // $pesquisa = mysql_query("Select id_pro, nome_pro from cadastro_profissionais where upper(empresa) like upper('%".$emp."%') and upper(nome_pro) like upper('%".$dest."%') ") or die (mysql_error());
		   $pesquisa = mysql_query("Select id_pro, nome_pro from cadastro_profissionais where empresa = ".$emp." and upper(nome_pro) like upper('%".$dest."%') ") or die (mysql_error());
		   
		   if(mysql_num_rows($pesquisa) == 1 )
		   {
			   $dest = mysql_fetch_row($pesquisa);
			   $grava = mysql_query("Insert into recados_pro(empresa, destinatario, remetente, hora, dia, mensagem) values('$emp', '$dest[0]', '$remet', '$hora', '$dia_s', '$mes') ") or die(mysql_error());
			   
			   if(mysql_affected_rows() == 1)
			   {
					echo ("<p align='center'> <img src='../imagens/confirma.png' width='60px' height='60px' align='middle'> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Recado gravado com sucesso <BR><br><BR> <a href='../cadastro/recado.php'><input type='button' name='voltar' title='Voltar' value='Voltar'></a> </p>");
			   }
			   else
			   {
					echo ("<p align='center'> <img src='../imagens/atencao.png' width='60px' height='60px' align='middle'>Não foi possivel gravar seu recado, por favor, tente novamente mais tarde.<BR><br><BR> <a href='../cadastro/recado.php'><input type='button'  name='voltar' title='Voltar' value='Voltar'></a> </p>");
				}
		   }
		   else
		   {
			   if ( mysql_num_rows($pesquisa) == 0 )
			   {
				   echo("<br><br> Profissional não encontrado no banco de dados, tente novamente!
				   
				   <br><br>
				   <form action='../cadastro/recado.php' method='post'>
					  <input type='hidden' name='mens' value='".$mes."'>
					
					  <input type='submit' name='voltar' value='Voltar'>
				   </form>
				  
				   ");
			   }
			   else
			   {
				    while ($row = mysql_fetch_assoc($pesquisa))
					{
						$prof[$x] = $row['nome_pro'];
						$x = $x + 1;
					}
					echo('Selecione o profissional para o qual deseja marcar o recado :');
				
					echo(' <table cellpadding="5px" cellspacing="5px" align="center" ');
					echo('<tr> <td> <br> </td></tr> ');
					
					for($y = 0 ; $y < $x ; $y++ )
					{
						echo('<form action="../cadastro/salva_recado.php" method="post">');
						echo('<tr>
								<td> <input type="hidden" value="'.$prof[$y].'" name="nome"> '.$prof[$y].'
								     <input type="hidden" value="'.$remet.'" name="prof">
									 <input type="hidden" value="'.$emp.'" name="empresa">
									 <input type="hidden" value="'.$mes.'" name="mensagem">
									 <input type="submit" value="Enviar" name="enviar">
								</td>
							   </tr>
							  </form>');
					}
					echo(' </table> ');
					echo("</font>");
			   }
				
		   }
		   
		   echo(' </font>
		   </div>');
         ?>   
         <table><tr><td>
            <!--<div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
            </td></tr>
         </table>
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
