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
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
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
					
				$id = $_GET['r'];
				session_start();
			
				echo ('<div id="menu">');
					include '../funcoes/menu.php';
				echo('</div> ');
			?>
			<div class="conteudo">
            	<br><br><br>
               
				<?php
					include '../funcoes/funcoes.php';
					include '../funcoes/conecta.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
					$id_pro = $_GET["r"];
					$inicio = $_GET["i"];
					$data   = $_GET["d"];
					$obs    = $_POST["obs"];
					
					$obs = substitui_str($obs);
					if ($obs == "") {
						echo("<script>alert('Campo observação não pode ficar vazio!')</script>");
						echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/agendar_confirma.php?r=$id_pro&d=$data&i=$inicio'>");
					} else {
					$gravar = mysql_query("INSERT INTO horarios_pro(idprofissional_pro, inicio_pro, id_cliente_pro, data_pro, observacoes) VALUES ('$id', '$inicio', '$id_cli', '$data', '$obs')")or die(mysql_error());
					
					if ($gravar != 0) 
					{
						echo (' <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<font size="+2"> Agendamento concluído com sucesso! </font>
							  ');
					}
					else
					{
						echo(' <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> Não foi possível concluir o agendamento, <br> por favor tente mais tarde. <br><br></font>
							  ');
					}
					echo('<a href="../horario/cad_horario_2.php?r='.$id.'"><input type="button" name="voltar" value="Voltar"></a> ');
					}
				?>
                </p> 	
                           
            </div>
         </div>
	</body>
</html>