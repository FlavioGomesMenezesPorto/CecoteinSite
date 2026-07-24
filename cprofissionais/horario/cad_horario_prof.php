<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> CProfissionais - Agendar </title>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
        <script type="text/javascript">
			function validavazio(nome){
				if (document.confirma.elements[0].value =="")
				{
					alert ("Campo cliente não pode ser vazio !");
					return false;
				} else {
					return true;
				}
			}
        </script>
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
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
             <?php
			if(isset($_COOKIE['cli']))        //Contém o valor do CNPJ/CPF do cliente que está logado no site
				$id_cli = $_COOKIE["cli"];
			else
				$id_cli = 0;

			if(isset($_COOKIE['pro']))
				$id = $_COOKIE["pro"];
			else
				$id = 0;
				
			$id = $_GET["r"];
            echo ('<div id="menu"> ');
				include '../funcoes/menu.php';
			echo('</div> ');
			if ($id <> 0){
			?>
			<div class="confirma">
            	<br><br><br>
                <img src="../imagens/agenda.png" align="left" alt="agenda" width="150px" height="105px">
            	<font size="+2"> Agendar: 
                <br><br>
                <?php 
					
					include '../funcoes/conecta.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
					date_default_timezone_set('UTC');
					
					//$_get['c'];
					$id_pro = $_GET["r"];
					$inicio = $_GET["i"];
					$data   = $_GET["d"];
					
					// session_start();
						//echo ('  <br>');
					$timestamp = strtotime($data);
					$data1 = date('d-m-Y', $timestamp);
					
					echo (' '.$data1.'  às '.$inicio.'<br><br>');
					
					echo (' <form name="confirma" action="../horario/cad_horario_prof1.php?r='.$id_pro.'&i='.$inicio.'&d='.$data.'" method="post" onSubmit="return validavazio();">
								Para o cliente: 
								<input type="text" maxlength="25" name="cliente" id="cliente" size="40px">
								<br><br><input type="submit" name="Confirma" value=" Procurar cliente "> &nbsp&nbsp&nbsp&nbsp&nbsp
								<a href="javascript:history.back(1);"><input type="button" name="Voltar" value="        Voltar        "></a>
								
							 </form>
						  ');
				//	<a href="visualizar_horarios.php?r='.$id_pro.'&c='.$id_cli.'&i='.$inicio.'&d='.$data.'"> <input type="button" name="voltar" value="Voltar"> </a>
            	
               echo('</font>');
			} else {
				echo ("Não  tem sessão !");
						echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/login.php?r=$id_pro&d=$data&i=$inicio'>");
			}
			   ?>
            </div> <!-- Fecha a div conteudo -->
            
         </div> <!-- Fecha a div Principal -->
</body>
</html>