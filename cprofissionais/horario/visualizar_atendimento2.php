<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> CProfissionais - Atendimento </title>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000" text="#FFFFFF">
		<div class="principal">

            <div id="cabeca" >
                
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
				header('Content-Type: text/html; charset=utf-8');
				include ("../funcoes/menu-prof.html");
				?>  
            </div>
            
             <div class="principal" style="top: 183px; text-align:center">
             	<img src="../imagens/horario.png" align="left" width="150" height="100">
                <font color="#FFFFFF"><center>
            	<br>
            	<img src="../imagens/horario_prof.png" width="400" height="50">
                <br><br><br>
                
            <?php
				session_start();
				
				$id = $_GET["r"];
				//$hora = $_GET["h"];
				//$data = $_GET["d"];
				$id_hor = $_GET["a"]; //id do horário
				$id_cli = $_GET['id_cli'];
				$a = $_GET['u'];
				include '../funcoes/conecta.php';
				
				mysql_select_db(BASE,$cn)or die(mysql_error());
				date_default_timezone_set('UTC');
				$pesquisa = mysql_query("Select id_cliente_pro, observacoes from horarios_pro where id_pro = '$id_hor'") or die (mysql_error());
				
				$cli = mysql_fetch_row($pesquisa);
    
                                $verifica = mysql_query("Select nome_pro from cadastro_profissionais where id_pro = ".$id) or die (mysql_error());
				
				$cliente = mysql_fetch_row($verifica);
				echo(' <p align="right"><a href="../horario/horario_cliente.php?p='.$id.'"> <input type="button" name="voltar" value="Voltar"></a> </p> ');				
				echo(' <form name="altera" action="../horario/altera_horario.php" method="post">
				
				<table>
					<tr>
						<td colspan="2"> Neste horário estará atendendo: <br> <br></td>
					</tr>
					<tr>
						<td align="right"> Nome: </td>
						<td> <input type="hidden" name="nome" value="'.$cliente[0].'"> '.$cliente[0].' </td>
					</tr>
				
					<tr>
						<td > Observações: </td>
						<td > <input type="hidden" name="obs" value="'.$cli[1].'"> '.$cli[1].' </td>
					</tr>

				</table> ');
			?> 
            	</center> </font>
            </div>
    	</div>
	</body>
</html>