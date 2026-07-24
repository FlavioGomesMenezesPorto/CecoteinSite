<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title> CProfissionais - Agendar </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        header('Content-Type: text/html; charset=utf-8');
        ?>
        <link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
    </head>	
    <!-- #################################################################################### -->
    <body bgcolor="#000000">
        <div class="principal">

            <div id="cabeca" >
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>

            <div id="flash" >
                <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
                include ("../funcoes/menu-prof.html");
                ?>
            </div>
            <?php
            if (isset($_COOKIE['cli']))
                $id_cli = $_COOKIE["cli"];
            else
                $id_cli = 0;

            if (isset($_COOKIE['pro']))
                $id = $_COOKIE["pro"];
            else
                $id = 0;

            $id = $_GET["r"];
            echo ('<div id="menu"> ');
            include '../funcoes/menu.php';
            echo('</div> ');
            ?>
            <div class="conteudo">
                <br><br><br>

                <?php
                session_start();
                include '../funcoes/conecta.php';
                mysql_select_db(BASE, $cn) or die(mysql_error());
                date_default_timezone_set('UTC');

                $id_cli = $_GET["c"];
                $id = $_GET["r"];
                $inicio = $_GET["i"];
                $data = $_GET["d"];

                $timestamp = strtotime($data);
                $data1 = date('d-m-Y', $timestamp);

                echo ('<font size="+2">  Agendar às <br><br>
					' . $data1 . '  às ' . $inicio . '<br><br> </font>');

                echo (' <form name="confirma" action="../horario/cad_horario_prof3.php?r=' . $id . '&i=' . $inicio . '&d=' . $data . '&c=' . $id_cli . '" method="post">
						<p align="left"> <font size="+1"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Observações <br><br></font> </p>
					
						<textarea name="obs" title="obs" id="obs" cols="70" rows="8" style="font-family:Arial;"></textarea>
						
						<br><p align="right"><input type="submit" value="Marcar Horário" name="marcar" title="marcar">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
					<br/><br/><br/><br/><br/><br/>
					Manhã toda<input type="checkbox" value="manha" name="opcao"> Tarde toda<input type="checkbox" value="tarde" name="opcao">

					</form> ');
                ?>           
            </div>
        </div>
    </body>
</html>