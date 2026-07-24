<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Lista de PRofissionais </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/lista.css" type="text/css" rel="stylesheet">
	</head>	
<!-- #################################################################################### -->
	<body>
		<div class="principal">
    
            <div id="cabeca" >
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                  <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu_teste.html");
				?>
            </div>	<!-- Fecha a div Flash-->
            <?php
				session_start();
				
				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;

			?>       
            <div class="conteudo">
            	 <br><p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>
                <div id="mostrar">
                    <center>
                    <h1> <font color='#FFFFFF'> Lista de Cadastro </font> </h1>
    
                    <div>
                        <?php
                            include '../funcoes/conecta.php';
                            mysql_select_db(BASE,$cn)or die(mysql_error());
							
                            //Fazendo a busca apenas do ID e do nome no db.
                           
			    $empresa = mysql_query("select cnpj from cadastro_profissionais where id_pro = '$id'");                            
			    
			    $emp = mysql_fetch_row($empresa);
			    $nome = $emp[0];
			   // echo("SELECT id_pro,nome_pro,registro_pro,especialidade_pro,categoria_pro,foto_pro, tipo FROM cadastro_profissionais where empresa like '%".$nome."%'");
			    $id_cli = '';	
			    $busca = mysql_query("SELECT id_pro,nome_pro,registro_pro,especialidade_pro,categoria_pro,foto_pro, tipo FROM cadastro_profissionais where empresa = '".$emp[0]."'")or die(mysql_error());
			    $num = mysql_num_rows($busca);
			    
                            //verifico se existe dados dentro da tabela.
                            if(!mysql_num_rows($busca))
                            { // se n�o tiver, ele imprime um erro.
                               echo "Nenhum dado cadastrado na base de dados.";
                            }
                            else
                            {
                                while($ver = mysql_fetch_row($busca))
                                {
                                    $id = $ver[0];             //corresponde ao campo ID, pois estamos trabalhando com vetor.
                                    $nome = $ver[1];           //corresponde ao campo nome.
                                    $registro = $ver[2];       //corresponde ao campo registro.
                                    $especialidade = $ver[3];  //corresponde ao campo especialidade.
                                    $categoria = $ver[4];      //corresponde ao campo categoria.
                                    $foto = $ver[5];           //foto
            			    		$tipo = $ver[6];
				    
               			    		echo "<table border='2' cellpadding='3' cellspacing='0'>	
				    						<tr bgcolor='#66CDAA'>
												<td colspan='5'><b>".$nome."</b></td>
											</tr>
																	
											<tr>
												<td bgcolor='#66CDAA'> Especialidade</td>
												<td>".$especialidade."</td>
												<td width='100px' height='100px'  rowspan='3'>
											";
									if ($foto == '')
									{
										 echo (' <img src="../imagens/nophoto.jpg" width="95px" height="80" border="0">');
									}
									else
									{
										 echo('<img src="'.$foto.'" width="95px" height="80" border="0">');
									}
																	
									echo"
										 </tr>
										 
										 <tr>
										<td bgcolor='#66CDAA' width='50px'> Categoria</td>
										<td>".$categoria."</td>
										 </tr>
										 <tr> ";
									 
						
										 echo("
										   <td colspan='4' width='50px'>
											 <a href=../horario/visualizar_horarios.php?p=".$id."&n=".$nome."><input type='button' value='Horários' name='horario'></a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;
											 <a href=../principais/perfil.php?r=".$id."&n=".$nome."><input type='button' value='Visualizar ficha inteira' name='visualizar'></a>
										  </font>
											</td>
										  </tr>
										 </table>
										<br><br>");
												
                                }
                            }
                        ?>
                               
                    </div> 
                   </center> 
                </div> <!-- Fecha a div Mostrar -->
			</div> <!-- Fecha a div Conteudo -->
	     </div> <!-- Fecha a div Principal -->
	</body>
</html>