<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Lista de clientes </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
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
				if(isset($_COOKIE['cli'])){
					$id_cli = $_COOKIE["cli"];
				

			?>       
            <div class="conteudo">
            	<p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>      
                <div id="mostrar">
                    <center>
                    <h1>Lista de Cadastro </h1>
    
                    <div>
                        <?php
                            include '../funcoes/conecta.php';
                            mysql_select_db(BASE,$cn)or die(mysql_error());
							
                            //Fazendo a busca apenas do ID e do nome no db.
                           
                            $busca = mysql_query("SELECT cpnjcpf_cli, nome_cli FROM cliente where nome_cli is not null order by nome_cli")or die(mysql_error());
                            //verifico se existe dados dentro da tabela.
                            if(!mysql_num_rows($busca))
                            { // se não tiver, ele imprime um erro.
                               echo "Nenhum dado cadastrado na base de dados.";
                            }
                            else
                            { 
							    while($ver = mysql_fetch_row($busca))
                                {
                                    $id = $ver[0];             //corresponde ao campo ID, pois estamos trabalhando com vetor.
                                    $nome = $ver[1];           //corresponde ao campo nome.
            						
									echo "	<table border='0' align='left'>	
												<tr>
													<td><a href='../principais/perfil_cli.php?c=".$id."'><b>".$nome."</b></a>
													</td>
												</tr>
											</table>
										<br><br>";
								}
							}
				}else{
						$id_cli = 0;
				}
                        ?>
                    </div> 
                   </center> 
                </div> <!-- Fecha a div Mostrar -->
			</div> <!-- Fecha a div Conteudo -->
	     </div> <!-- Fecha a div Principal -->
	</body>
</html>