<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Agendar </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
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
				include ("../funcoes/menu_teste.html");
				?>
            </div>
             <?php
			if(isset($_COOKIE['cli'])){
					$id_cli = $_COOKIE["cli"];
			}
				else {
					$id_cli = 0;
				}
			$id = $_GET["r"];
			
            echo ('<div id="menu"> ');
				include '../funcoes/menu.php';
			echo('</div> ');
			?>
			<div class="confirma">
            	<br><br><br>
                <img src="../imagens/agenda.png" align="left" alt="agenda" width="200px" height="140px">
            	<font size="+2"> Agendar: 
                <br><br>
                <?php 
					
					include '../funcoes/conecta.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
					date_default_timezone_set('UTC');
					
					$id_pro = $_GET["r"];
					$inicio = $_GET["i"];
					$data   = $_GET["d"];
								
					session_start();
					//if (isset($_SESSION['cliente']))
					if ($id_cli != 0 )
					{
						//echo ('  <br>');
						$timestamp = strtotime($data);
						$data1 = date('d-m-Y', $timestamp);
						
						echo (' '.$data1.'  às '.$inicio.'<br><br>');
						
						echo('<form name="agenda" method="post" action="../horario/confirmado_2.php?r='.$id_pro.'&i='.$inicio.'&d='.$data.'">
								<table>
									<tr>
										<td> <font size="+1"> Observações: </font></td>
									</tr>
									<tr>
										<td> <textarea cols="45" rows="6" name="obs" style="font-family:Arial"></textarea> </td>
									</tr>
									<tr>
										<td align="center"> <input type="submit" name="Confirma" value="Confirma Agendamento"></a>  &nbsp&nbsp&nbsp&nbsp
							<a href="../horario/cad_horario_2.php?r='.$id_pro.'&i='.$inicio.'&d='.$data.'"> <input type="button" name="voltar" value="Voltar"> </a> </td>
						 			</tr>
								</table>
							  </form>');
							 // <a href="../horario/confirmado_1.php?r='.$id_pro.'&i='.$inicio.'&d='.$data.'"> 
					}
					else
					{
						echo ("Não  tem sessão !");
						echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/login.php?r=$id_pro&d=$data&i=$inicio'>");
					}
            	?>
               </font>
            </div> <!-- Fecha a div conteudo -->
            
         </div> <!-- Fecha a div Principal -->
</body>
</html>