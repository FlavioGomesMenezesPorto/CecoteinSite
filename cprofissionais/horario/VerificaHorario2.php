<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
				header('Content-Type: text/html; charset=utf-8');
					include ("../funcoes/menu_teste.html");
				?>
            </div>
    		
            <?php
				session_start();
				$hora = $_POST["hora"] ;//analisar
				$dia = $_POST["dia"]; //analisar
				
				if ( $hora = '  ')
				{
					// fazer ligação com banco de dados e depois verificar se tem horario livre 
					echo " Agendar
					
					$dia, $hora
					
					<input type=\"button\" value=\"Confirmar Agendamento\" name=\"confirmar\">
					<a href=\"principais/index.php\"> <input type=\"button\" value=\"Voltar\" name=\"voltar\"> </a>";
				}
			?>
        </div>
	</body>
</html>