<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> CProfissionais - Home Cliente</title>
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
					if(isset($_COOKIE['pro']))
						$id = $_COOKIE["pro"];
					else
						$id = 0;
					
				?>
                
                <div id="flash" >
                     <!--<object width="1500px" height="65px">
                      	 <param name="movie" value="../menu/Menu-prof.swf"> 
                         <param name="wmode" value="transparent" />
                         <embed wmode="transparent" src="../menu/Menu-prof.swf?r=" width="900px" height="60px" />
                    </object>-->
                    <?php
					header('Content-Type: text/html; charset=utf-8');
					include ("../funcoes/menu-prof.html");
					?>
                </div>
                
			</div> <!-- Fecha a div Menu -->
			<!-- ##########################################################FIM MENU######################################## -->
            
             
            <div class="conteudo">

				<?php
					session_start();
					
					include '../funcoes/conecta.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
					
				?>
                
                <div id="corpo">
                	<p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar" id="voltar"></a> </p>
                    <?php 
						
						$empresa = mysql_query("Select empresa from cadastro_profissionais where id_pro = '$id'");
						$emp = mysql_fetch_row($empresa);
						//echo($emp[0]. 'empresa <br>');
						
						$prof = mysql_query("Select id_pro, nome_pro from cadastro_profissionais where empresa like '%".$emp[0]."%' ORDER BY nome_pro ASC");
						
						echo('<form name="profissionais">
						
							<table>
								<tr>
									<td> <font size="+1"> Escolha o profissional: </font> <br><br></td>
								</tr>
							');
						while($row = mysql_fetch_assoc($prof))
						{						  
							$id_pro = $row['id_pro'];
							$nome = $row['nome_pro'];
							echo("<tr>
									<td> <a href='../horario/horario.jquery.php?p=".$id_pro."'> ".$nome." </a> </td>
								  </tr>");
						}
							
						echo('</table> ');
								
								
					?>
                    
                   </div> <!-- Fecha a div Corpo -->
                   
               </div> <!-- Fecha a div Conteudo -->
               
           </div> <!-- Fecha a div Principal -->
           
   </body>
</html>
                	
                    
                    
                    