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
                <!-- <object width="1500px" height="65px">
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
				include '../funcoes/funcoes.php';
				
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
				
				$nome= $_POST["nome"];
				
				 
				
				
				$foto = $_FILES["foto_pro"]; //Recebe a foto.
				//echo($nome);
				$pattern = "/(gif|bmp|png|jpg|jpeg)$/i";
				$tipoextensao = $foto['type'];
				$diretorio_foto = "cprofissionais/";//Caminho para pasta das fotos do moderador
				$upfoto = $diretorio_foto . $foto["name"];//Caminho + Nome do arquivo
				move_uploaded_file($foto["tmp_name"],$upfoto);//Coloca no servidor*/
				echo($upfoto);
				//$foto = CarregaImagem($nome,$id,$f);
				//echo($foto[0]);
				//if ($foto[1] == 1)
				//{
					if ($nome == 'foto_pro')
						//$gravar = mysql_query("Update cadastro_profissionais set foto_pro = '$foto[0]' where id_pro = '$id'");
						$gravar = mysql_query("Update cadastro_profissionais set foto_pro = '$upfoto' where id_pro = '$id'");
					else
					{
						if ($nome == 'foto2_pro')
							$gravar = mysql_query("Update cadastro_profissionais set foto2_pro = '$upfoto' where id_pro = '$id'");				else
						{
							if ($nome == 'foto3_pro')
								$gravar = mysql_query("Update cadastro_profissionais set foto3_pro = '$upfoto' where id_pro = '$id'");
							else
								$gravar = mysql_query("Update cadastro_profissionais set foto4_pro = '$upfoto' where id_pro = '$id'");
						}
					}
					echo(" <br><br>Arquivo gravado com sucesso ! <br><br>");
				/*}
				else
				{
					echo(" <br><br> Não foi possível gravar a foto no banco de dados tente novamente mais tarde! <br><br> ");
				}*/

				$pesq = mysql_query("Select tipo from cadastro_profissionais where id_pro = '$id'");
				$tipo = mysql_fetch_row($pesq);
				
				if ($tipo[0] == 'empresa')
					echo(' <br><br> <a href="../cadastro/altera_emp.php"> <input type="button" name="voltar" value="Voltar"></a> </p> ');
				else
				{
					if ($tipo[0] == 'profissional')
						echo(' <br><br> <a href="../cadastro/altera_prof.php"> <input type="button" name="voltar" value="Voltar"></a> </p> ');
					else
						echo(' <br><br> <a href="../cadastro/altera_cli.php"> <input type="button" name="voltar" value="Voltar"></a> </p> ');
				}
	
			?>
            </div> <!-- Fecha a div Conteudo -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>
