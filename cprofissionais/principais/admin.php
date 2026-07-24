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
                     <param name="movie" value="../menu/Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
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
			
            echo ('<div id="menu"> ');
               include '../funcoes/menu.php';
			echo(' </div> ');
			?>
			<div id="corpo">
               O que deseja cadastrar? 
            	<form name='escolha'>
                   <br><br><a href="../cadastro/cadastrocliente.php"><img src="../imagens/botoes/cliente.png" width="200px" height="35	px" title="Cadastro de clientes" alt="Cadastro de Cliente"></a>
                   <br><br><a href="../cadastro/cadastroprofissional.php"><img src="../imagens/botoes/profissionais.png" width="230px" height="35 px" title="Cadastro de profissionais" alt="Cadastro de Profissionais"></a>                   
                   <br><br><a href="../cadastro/cadastroempresa.php"><img src="../imagens/botoes/empresa.png" width="200px" height="35	px" title="Cadastro de empresa" alt="Cadastro de Empresa"></a>
                  <!-- <div id="minha_ul2">
                   		<li> <a href="../principais/index.php">horarios excluidos</a></li>
                   </div>-->
                </form>
            </div> <!-- Fecha a div Corpo -->
          <!--  <div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
