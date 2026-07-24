<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Profissional </title>
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
                <?php 
				    if(isset($_COOKIE['cli']))
						$id_cli = $_COOKIE["cli"];
					else
						$id_cli = 0;
	
					if(isset($_COOKIE['pro']))
						$id = $_COOKIE["pro"];
					else
						$id = 0;
						
					include '../funcoes/conecta.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
					/*$cn = mysql_connect("localhost","root",""); // Usar somente essa parte do código
   					$dados = mysql_select_db("shoppingvirtualu",$cn); //para trabalhar em localhost*/
				?>
                
                <div id="flash" >
                     <!--<object width="1500px" height="65px">
                      	 <param name="movie" value="../menu/Menu-prof.swf"> 
                         <param name="wmode" value="transparent" />
                         <embed wmode="transparent" src="../menu/Menu-prof.swf?r=<?= $id; ?>" width="900px" height="60px" />
                    </object>-->
                    <?php
						include ("../funcoes/menu-prof.html");
					?>
                </div>
                
			</div> <!-- Fecha a div Menu -->
			<!-- ##########################################################FIM MENU######################################## -->
           		
	        <!-- ****************************** A partir daqui ira mudar a div -->
            <div class="conteudo">

				<?php
				if ($id != '') {
					session_start();
					$pesquisa = mysql_query("Select nome_pro from cadastro_profissionais where id_pro = '$id'");
					$nome = mysql_fetch_row($pesquisa);
					$cpfpesquisa = mysql_query("Select cpf_pro from cadastro_profissionais where id_pro = '$id'");
					$cpf_aux = mysql_fetch_row($cpfpesquisa);
				?>

                <div id="corpo">
                
               	<form name='escolha'>
                     <font size="+1" color="#FFFFFF">
					 <?php echo(" Seja bem-vindo(a), ".$nome[0].".<br><br>"); ?>
                     
                     O que deseja fazer? </font>
                     
                     </div>
                   <?php echo ('<br><div id="minha_div">
                     	<div id="minha_div2">
                     	<li><a href="../horario/visualizar_horarios.php?p='.$id.'" title="Visualizar horários">Visualizar Horários</a></li>
                        </div>
                        
                        	<li><a href="../cadastro/altera_prof.php" title="Alterar dados">Alterar dados</a></li>
                        
                        <div id="minha_div3">
                        	<li><a href="../horario/visualizar_hora_prof.php" title="Visualizar horários de outro profissional">Visualizar horário de outro profissional</a></li>
                        </div>
						</div>
				   ');

				    if ($cpf_aux[0] == "08683685632" or $cpf_aux[0] == "51738180697"){
						echo ('<br><div id="minha_div">
					   <div id="minha_div5">
						<li><a href="../cadastro/cadastroprofissional.php?p='.$id.'" title="Cadastrar Profissional">Cadastrar Profissional</a></li>
						</div>
											   
							<li><a href="../cadastro/cadastrocliente.php" title="Cadastrar Cliente">Cadastrar Cliente</a></li>
							
						<div id="minha_div6">
						   <li><a href="../cadastro/cadastroempresa.php" title="Cadastrar Empresa">Cadastrar Empresa</a></li>
						</div>
					</div>
					   ');
					}

				  	$pesquisa = mysql_query("Select nome_pro, empresa from cadastro_profissionais where id_pro = '$id'") or die(mysql_error());
		   		$nome_c = mysql_fetch_row($pesquisa);
		   
				    //$pesquisa = mysql_query("Select * from recados_pro where empresa like '%".$nome_c[1]."%' ") or die(mysql_error());
					$pesquisa = mysql_query("Select * from recados_pro where destinatario = ".$id) or die(mysql_error());
					if(mysql_num_rows($pesquisa) != 0 )
					{
						echo(' <br><br><br>
						Obs: Existem recados na agenda para este profissional! <br><br>
						
						<a href="../principais/visualizar_recados.php"><input type="button" name="visualizar" value="Visualizar Recados"></a> ');
					}
					
				   ?>         

					<!--?php echo "<p>$cpf_aux[0]</p>";?-->  
              	</form>
              
            	</div> <!-- Fecha a div Corpo -->
            <?
				} else {
					echo ("Não  tem sessão !");
					echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/logar.php>");
				}
			
			 ?>
			</div>
		</div>	 <!-- Fecha a div Principal -->
	</body>
</html>