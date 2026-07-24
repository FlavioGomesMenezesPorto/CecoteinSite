<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        header('Content-Type: text/html; charset=utf-8');
        ?>
        <link href="../estilos/pagprincipal.css" type="text/css" rel="stylesheet">
        <title>CEstratégico - Empresa</title>

    </head>	

    <body>

        <div class="principal"> <!-- Abre a div class principal -->
            <div class="menu" >
                <div id="cabeca">
                    <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/logos/Logo00.jpg" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CEstrategico"></a>
                </div>  


                <div id="flash" >

                    <?php
                    header('Content-Type: text/html; charset=utf-8');
                    include ("../menu/menu_topo.html");
                    ?>

                </div>


            </div> <!-- Fecha a div Menu -->            
            <!-- ##########################################################FIM MENU######################################## -->

            <!-- A partir daqui ira mudar a div -->

            <div class="conteudo">

                <?php
                $pesquisa = mysql_query("Select nome_pro from cadastro_profissionais where id_pro = '$id'");
                $nome = mysql_fetch_row($pesquisa);
                ?>

                <div id="corpo">

                    <form name='escolha'>
                        <font size="+1" color="#FFFFFF">
                            <?php echo(" Seja bem-vindo(a), " . $nome[0] . ".<br><br>"); ?>

                            O que deseja fazer? </font>

                        <?php
                        echo ('<br><br><a href="estoque.php?p=' . $id . '">
						<img src="../imagens/botoes/cad_estoque.png" width="175px" height="125px" title="Visualizar horários" alt="Visualizar horários" border="0"></a> 
				   
				   <a href="COLOQUE O ENDEREÇO DE LINK AQUI">
				   <img src="COLOQUE A IMAGEM AQUI" width="150px" height="35px" title="Alterar dados" alt="Alterar dados" border="0"></a> 
				   
				   
				   <a href="COLOQUE O ENDEREÇO DE LINK AQUI">
				   <img src="COLOQUE A IMAGEM AQUI" width="300px" height="35px" title="Visualizar horários de outro profissional" alt="Visualizar horários de outro profissional" border="0"></a>
				   ');

                        $pesquisa = mysql_query("Select nome_pro, empresa from cadastro_profissionais where id_pro = '$id'") or die(mysql_error());
                        $nome_c = mysql_fetch_row($pesquisa);

                        $pesquisa = mysql_query("Select * from recados_pro where destinatario = " . $id) or die(mysql_error());
                        if (mysql_num_rows($pesquisa) != 0) {
                            echo(' <br><br><br>
						Obs: Existem recados na agenda para este profissional! <br><br>
						
						<a href="COLOQUE O ENDEREÇO DE LINK AQUI"><input type="button" name="visualizar" value="Visualizar Recados"></a> ');
                        }
                        ?>         

                    </form>

                </div> <!-- Fecha a div Corpo -->
            </div>
        </div>	 <!-- Fecha a div Principal -->
    </body>
</html>