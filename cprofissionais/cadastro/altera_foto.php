<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Alterar foto </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
        <link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
		<script src="../js/cadastroprofissional.js"></script>
	</head>	
	<!-- #################################################################################### -->
	<body>
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
            <div id="menu">
		   
		   		<?php 
						if(isset($_COOKIE['cli']))
							$id_cli = $_COOKIE["cli"];
						else
							$id_cli = 0;
		
						if(isset($_COOKIE['pro']))
							$id = $_COOKIE["pro"];
						else
							$id = 0;
						include '../funcoes/menu.php'; 
				?>
           
		   </div> 
            <div class="conteudo">
            <?php
				session_start();
				include 'conecta.php';
				mysql_select_db(BASE,$cn)or die(mysql_error());
				
				$f = $_GET['f'];
				
				$pesq = mysql_query("Select tipo from cadastro_profissionais where id_pro='$id'");
				
				$tipo = mysql_fetch_row($pesq);
				
				if ($tipo == 'empresa')
				{
					echo('Selecione qual foto deseja alterar
					
				    <form action="../cadastro/altera_foto1.php" method="post">
					
						<br><br><input type="radio" name="fotos" value="foto_pro" id="fotos"> Foto 1
						<br><br><input type="radio" name="fotos" value="foto2_pro" id="fotos"> Foto 2
						<br><br><input type="radio" name="fotos" value="foto3_pro" id="fotos"> Foto 3
						<br><br><input type="radio" name="fotos" value="foto4_pro" id="fotos"> Foto 4
						
						<br><br><input type="submit" name="enviar" value="Enviar">
						<a href="../cadastro/altera_prof.php?r="$id"><input type="button" name="voltar" value="Voltar"></a>
					</form>
					
					');
				}
				else
				{
					$foto = 'foto_pro';
					echo(' <form border="0" name="altera_foto" action="cadastro/altera_foto2.php?" method="post" onsubmit="return verificacadprofissional(this);return verificacpf(this);" enctype="multipart/form-data">
				    
						<table>
							<tr>
								<td> Foto a ser carregada: </td>
								<td> <input type="file" name="'.$foto.'">
								<td> <input type="hidden" name="nome" value="'.$foto.'">
							</tr>
							<tr>
								<td> <input type="submit" value="Enviar Foto" name="enviar">
								<td> <a href="../cadastro;altera_prof.php"> <img src="../imagens/botoes/voltar.png" name="voltar" title="Voltar" value="Voltar"></a> </p> </td>
						</table>
						
					</form>		');
				}
						
								    
        	?>
            </div> <!-- Fecha a div Conteudo -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>
