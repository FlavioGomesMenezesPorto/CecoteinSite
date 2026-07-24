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
				<p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>
				<?php
				    session_start();
					include '../funcoes/conecta.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
					
					
					if (isset($_COOKIE["cli"])) 
					{
						if(isset($_COOKIE['cli']))
							$id_cli = $_COOKIE["cli"];  // traz o cpf/cnpj dp cliente
						else
							$id_cli = 0;
		
						$pesquisa = mysql_query("Select nome_cli from cliente where cpnjcpf_cli = '$id_cli'");
						$nome = mysql_fetch_row($pesquisa);
						
						echo('<div id="corpo" align="left">
						<font size="+1"> Seja bem-vindo(a), '.$nome[0].'. <br><br> 
						
						O que deseja fazer? </font> <br><br>
						
						<form name="escolha">
						   
						<!--  <a href="../cadastro/altera_cli.php"><img src="../imagens/botoes/alterar.png" width="150px" height="35px" title="Alterar dados" alt="Alterar dados"></a>          
						  <a href="../horario/cancela_agenda.php"><img src="../imagens/botoes/desmarcar_horario.png" width="220px" height="35px" title="Desmarcar horários" alt="Desmarcar horários"></a>  
						  <a href="../principais/index.php"><img src="../imagens/botoes/marca_horario.png" width="220px" height="35px" title="Desmarcar horários" alt="Desmarcar horários"></a>  -->
						  
						  
						  
						<div id="minha_div">
							<div id="minha_div4">
								<li><a href="../horario/cancela_agenda.php" title="Desmarcar horários">Desmarcar um horários</a></li>
							</div>
							<div id="minha_div2">
								<li><a href="../principais/index.php" title="Marcar horários">Marcar um horários</a></li>
							</div>
						</div>
						<!--</form>-->
						
						');
              
					}
					else
					{
						echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/login_cliente.php'>");
					}
					
				
				?>

                
            	</div> <!-- Fecha a div Corpo -->
			</div>
		</div>	 <!-- Fecha a div Principal -->
	</body>
</html>