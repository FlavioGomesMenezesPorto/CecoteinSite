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
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
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
           
            <div class="conteudo">
            <?php
				session_start();
				include '../funcoes/conecta.php';
				mysql_select_db(BASE,$cn)or die(mysql_error());
				
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;
					
				$f = $_GET['f'];
				/*echo'<form method="POST" enctype="multipart/form-data" action="upload.asp">
					  <input type="FILE" size="40" name="FILE1"><br/>
				 <input type=submit value="Upload!">
				 </form>';*/
				
				$foto = $_POST["fotos"];
				
				if ($f == 1)
					$foto = 'foto_pro';
				
				if ($f == 2)
					$foto = 'foto2_pro';
					
				if ($f == 3)
					$foto = 'foto3_pro';
					
				if ($f == 4)
					$foto = 'foto4_pro';
				
				echo(' <form border="0" name="altera_foto" action="../cadastro/altera_foto2.php?f='.$f.'" method="post" onsubmit="return verificacadprofissional(this);return verificacpf(this);" enctype="multipart/form-data">
				    
						<table>
							<tr>
								<td> Foto a ser carregada: </td>
								<td> <input type="file" name="foto_pro">
								<td> <input type="hidden" name="nome" value="'.$foto.'">
							</tr>
							<tr>
								<td> <input type="submit" value="Enviar Foto" name="enviar">');
								
								$pesq = mysql_query("Select tipo from cadastro_profissionais where id_pro = '$id'");
								
								$tipo = mysql_fetch_row($pesq); 
								
								echo('<td> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </td>');
								
									/*echo('<td> <a href="../cadastro/altera_prof.php?r='.$id.'"> <input type="button" name="voltar" value="Voltar"></a> </p> </td>');*/ 
						echo('
						</table>
						
					</form>					
				');			
			
			?>
            </div> <!-- Fecha a div Conteudo -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>
