<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Como Funciona </title>
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
            
            <?
				session_start();
				if (isset($_SESSION["admin"]))
				{		
					echo('<div id="flash" >');
							/* echo('<object width="1500px" height="65px">
								 <param name="movie" value="../menu/Menu-prof.swf">
								 <param name="wmode" value="transparent" />
								 <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
							</object>');*/
							include ("../funcoes/menu-prof.html");
						echo('</div>');		
				}
				else
				{
					echo('<div id="flash" >');
						/*	echo(' <object width="1500px" height="65px">
								 <param name="movie" value="../menu/Menu.swf">
								 <param name="wmode" value="transparent" />
								 <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
							</object>');*/
							include ("../funcoes/menu_teste.html");
						echo('</div>');
					
					
				}
			if(isset($_COOKIE['cli']))
				$id_cli = $_COOKIE["cli"];
			else
				$id_cli = 0;

			if(isset($_COOKIE['pro']))
				$id = $_COOKIE["pro"];
			else
				$id = 0;
			
            echo ('<div id="menu">');
			
				include '../funcoes/menu.php';
				
            echo (' </div> ');
			
			   include '../funcoes/conecta.php';
			   mysql_select_db(BASE,$cn)or die(mysql_error());
			   
			   $pesquisa = mysql_query("Select * from param_pro");
			   
				$func = mysql_fetch_row($pesquisa);
				echo('<br><p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>      ');			   
             	echo('
				 <div id="corpo">
					<img src="../imagens/como_funciona.png" width="200px" height="50px" title="Como Funciona" value="Como Funciona"><br>	');
					?>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<?php
					/*echo('<form name="editor" action="../cadastro/salva_func.php" method="post">
						<textarea name="funciona" rows="30" cols="100" style="font-family:Arial;">'.$func[0].' </textarea>
					');*/
					echo('	 <p align="justify">
										 <font face="Arial" color="#FFFFFF" size="3" >
										 <b> O "CProfissionais" tem quatro utilidades: </b><br><br>
										  
										  1) Visualizar ou divulgar as informações de um profissional </b> <br><br>
										 &nbsp&nbsp&nbsp1.1) Clicar em "Lista de cadastro" ou "Início" e depois selecione a categoria: Advogado, Dentista, Informática e Médico; <br>
										 &nbsp&nbsp&nbsp 1.2) Clicar em "Visualizar ficha inteira" para ver todo o perfil do profissional desejado; <br><br>
										   
										  2) Agendar ou desmarcar os horários com um profissional </b> <br><br>
										 &nbsp&nbsp&nbsp2.1) Clicar em "Lista de cadastro" ou "Início" e depois selecione a categoria, Advogado, Dentista, Informática e Médico; <br>
										 &nbsp&nbsp&nbsp 2.2) Clicar em "Horários" para ver ou agendar um horário com o profissional desejado; <br><br>
										 
										  3) Ter acesso pela internet aos horários de todos os profissionais de sua empresa: </b> <br><br>
										 &nbsp&nbsp&nbsp 3.1) Clicar em "Adquira sua agenda" e preencher o formulário para pedido; <br><br>
										 
										  4) Escrever recados para qualquer profissional da empresa </b> <br><br>
										 &nbsp&nbsp&nbsp 4.1) Clicar em "Recados" para incluir, alterar ou excluir um recados do seu Login; <br><br>
										 &nbsp&nbsp&nbsp 4.1) Para ver todos os recados de todos funcionários clicar em "Início", "Login", e entre com o login da sua empresa; <br><br>
										  
										  </font>
										  </p>
										  ');
				
				if (isset($_SESSION["admin"]))
				{		
					echo('
							<br><br> <p align="right"> <input type="submit" value="Salvar" name="salvar" align="right"> </p>
							<br><br>
						   </form>
					 </div>
            		');
				}

				
		   ?>			
            <div id="rodape">
                <!-- <font color="#FFFFFF">	Todos os direitos reservados </font> -->
            </div>
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
