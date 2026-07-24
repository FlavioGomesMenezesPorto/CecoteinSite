<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Perfil </title>
        <META NAME="robots" CONTENT="noindex, nofollow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
       <link href="../estilos/home.css" type="text/css" rel="stylesheet">
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
            </div>
            <?php
				session_start();
			?>
            <div id="corpo" style="left:50px">
            	<br><p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>
				 <?php 
                    include '../funcoes/conecta.php';
                    include '../funcoes/somaHora.php'; 
                 mysql_select_db(BASE,$cn)or die(mysql_error());
                 
                // session_start();
                 
                    if(isset($_COOKIE['cli'])){
                        $id_cli1 = $_COOKIE["cli"];
                    
                    
                    $id_cli = !empty($_GET["c"])?$_GET["c"]:$id_cli1;	
                    $de = 0;
                    $ate = 1;
                    $tem = 2;
                    $x = 0;
                    $d = 0;
                    //echo ($id);
                    //nome_pro, endereco_pro, numero_pro, bairro_pro, cidade_pro, telefone_pro, cpf_pro, foto_pro, senha_pro, nasc_pro, id_cliente_pro, estado_pro 
                    $busca = mysql_query("SELECT nome_cli, endereco_cli, bairro_cli, cidade_cli, telefone1_cli, cpnjcpf_cli, estado_cli, email_cli from cliente where cpnjcpf_cli = '$id_cli' and sexo_cli = 'E'")or die(mysql_error());
                        //verifico se existe dados dentro da tabela.
                        
                        //echo ($busca);
                        if(!mysql_num_rows($busca))
                        {// se não tiver, ele imprime um erro.
                           echo  "<font face=\"Arial\" color=\"#FFFFFF\" size=\"3pt\"> Perfil não encontrado! </font>";
                        }
                        else
                        {
                            while($ver=mysql_fetch_row($busca))
                            {
                                
                                $nome = $ver[0];//corresponde ao campo nome.
                                $endereco = $ver[1];//corresponde ao campo endereco.
                                $bairro = $ver[2];//corresponde ao campo bairro.
                                $cidade = $ver[3]; // cidade
                                $telefone = $ver[4]; //telefone
                                $id = $ver[5]; //corresponde ao campo ID, pois estamos trabalhando com vetor.
                                $estado = $ver[6]; //estado
                                $email = $ver[7]; //email
                                echo(" <center> <font size='+1'> Perfil do Cliente <br><br></font>
								    
                                    <div id='dados' style='display: block ; top: 148px'>
                                    <table width='450px'>
                                        <tr> 
                                            <td colspan='7' bgcolor='#66CDAA'><center><b> ".$nome." </b></center> </td>
                                        </tr>
                                        <tr> 
											<td> <font color='#FFFFFF' size='4pt'> Endereço: </font> </td>
                                            <td> ".$endereco." </td>
                                        </tr>
                                        <tr>
											<td> <font color='#FFFFFF' size='4pt'> Bairro: </font> </td>
                                            <td> ".$bairro." </td>
                                        </tr>
                                        <tr>
											<td> <font color='#FFFFFF' size='4pt'> Cidade: </font> </td>
                                            <td> ".$cidade." </td>
                                        </tr>
                                        <tr>
                                            <td> <font color='#FFFFFF' size='4pt'> Estado: </font> </td>
                                            <td> ".$estado." </td>
                                        </tr>
                                        <tr>
                                            <td> <font color='#FFFFFF' size='4pt'> Telefone: </font> </td>
                                            <td> ".$telefone." </td>
                                        </tr>
										<tr>
                                            <td> <font color='#FFFFFF' size='4pt'> Email: </font> </td>
                                            <td> ".$email." </td>
                                        </tr>
                                    </table> </div>
									
									</center> ");
							}
						}
					}else{
                        $id_cli1 = 0;
						echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/login_cliente.php'>");
					}
				?>
               
            </div> <!--Fecha a div corpo -->
    	</div>  <!-- Fecha a div principal -->
	</body>
</html>
