<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home Cliente</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/pagprincipal.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body>
		<div class="principal">
			<div class="menu" >
                <div id="cabeca" >
                    <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
                </div>
                
                <div id="flash" >
                     <!--<object width="1500px" height="65px">
                         <param name="movie" value="../menu/Menu-cliente.swf">
                         <param name="wmode" value="transparent" />
                         <embed wmode="transparent" src="../menu/Menu-cliente.swf" width="900px" height="60px" />
                    </object>-->
                    <?php
					include ("../funcoes/menu-cliente.html");
					?>
                </div>
                
			</div> <!-- Fecha a div Menu -->
			<!-- ##########################################################FIM MENU######################################## -->
			
	        <!-- ****************************** A partir daqui ira mudar a div -->
            <div class="conteudo">
				<p align="right"><a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>             	
				<?php
				    session_start();
					include '../funcoes/conecta.php';
					include '../funcoes/somaHora.php';
					include '../funcoes/funcoes.php';
					
                    mysql_select_db(BASE,$cn)or die(mysql_error());
                    date_default_timezone_set('UTC');
					
					if(isset($_COOKIE['cli']))
						$id_cli = $_COOKIE["cli"];
					else
						$id_cli = 0;
	
					$id = $_GET["r"];
					$hora = $_GET["h"];
					$id_hor = $_GET["i"];
					$data = $_GET["d"];
					$x = 0;
					$i = 0;
					
					$data = date('Y-m-d');
					$hora = date('H:i:s');
					$agora = $data.' '.$hora;
					
					mysql_query("Insert into desmarcado_pro(id_profissional_pro, id_cliente_pro, horario_pro, data_pro, hora_desmarcado,id_profissional) values($id, $id_cli, '$hora', '$data', '$agora', '$id_pro') ") or die (mysql_error());
					
					echo("<center>");
					if (mysql_affected_rows() == 1 )
					{
						mysql_query("DELETE FROM horarios_pro where id_pro = '$id_hor'") or die(mysql_error());
						if (mysql_affected_rows() == 1 )
						{
							echo('<img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<font size="+2">
							O horário foi desmarcado com sucesso! </font>');
						}
						else
						{
							echo('<img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> Não foi possível desmarcar o horários selecionado, por favor tente mais tarde! </font>');
						}
					}
					echo("</center>");
				?>

				    
            	</div> <!-- Fecha a div Corpo -->
			</div>
		</div>	 <!-- Fecha a div Principal -->
	</body>
</html>