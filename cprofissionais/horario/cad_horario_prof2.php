<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title> CProfissionais - Agendar </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        header('Content-Type: text/html; charset=utf-8');
		include '../funcoes/funcoes.php';
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
				session_start();
                include '../funcoes/conecta.php';
                mysql_select_db(BASE, $cn) or die(mysql_error());
                date_default_timezone_set('UTC');
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
			if ($id <> 0){
            ?>
            <div class="conteudo">
                <br><br><br>

                <?php
                

                $id_cli = $_GET["c"];
                $id = $_GET["r"];
                $inicio = $_GET["i"];
                $data = $_GET["d"];
				$periodo = periodo($inicio);
                $timestamp = strtotime($data);
                $data1 = date('d-m-Y', $timestamp);
                echo ('<font size="+2">  Agendar às <br><br>
					' . $data1 . '  às ' . $inicio . '<br><br> </font>');
				
                echo (' <form name="confirma" action="../horario/cad_horario_prof3.php?r=' . $id . '&i=' . $inicio . '&d=' . $data . '&c=' . $id_cli . '" method="post">
						<p align="left"> <font size="+1"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Observações <br><br></font> </p>
					
						<textarea name="obs" title="obs" id="obs" cols="70" rows="8" style="font-family:Arial;"></textarea>
						
						<br><p align="right"><input type="submit" value="Marcar Horário" name="marcar" title="marcar">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
					<br/>
					'.$periodo.' toda<input type="checkbox" value="'.$periodo.'" name="opcao1"> 
					Dia todo<input type="checkbox" value="inteiro" name="opcao2">
					<br>
					<table> <tr><td>
					Replica<br><input type="text" name="re" size="3" title="Escolher quantas vezes ira marcar"/></td> 
					<td>Periodo<br>
					<select name="periodo">
                         <option value="d"> Dias </option>
                         <option value="s"> Semanas </option>
                         <option value="m"> Meses </option>
                    </select> 
					</td></tr></table>

					</form> ');
			}
			//echo('<br><br><br>'.$per);
                ?>           
            </div>
        </div>
    </body>
</html>

<?
function periodo($ini) {
	if (isset($_COOKIE['pro']))
                $id = $_COOKIE["pro"];
            else
                $id = 0;
				
	$termino = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem, man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
	$ter = mysql_fetch_row($termino);
	$inicio_h = $ini;
	//echo($inicio_h);
	//$timestamp = strtotime($dt);
	$timestamp = strtotime($ini);
	$dt2 = date('Y-m-d',$timestamp);
	$semana = date('l', $timestamp);
	$valor = Verifica_day($semana);
	$m = $valor[0] +1;
	$t = $valor[1] +1;
	$n = $valor[2] +1;
	$d = $valor[3] +1;
	$x = 1;
	$y = 4;
	$periodo = 'madrugada';
	//echo($m);
	//echo($ter[9].'>'.$inicio_h);
	if ($ter[$m] > $inicio_h){
		$d = $m;
		$y = 1;
		$periodo = 'manha';
		//echo($inicio_h);
	} else {
		if ($ter[$t] > $inicio_h){
			$d = $t;
			$y = 2;
			$periodo = 'tarde';
		} else {
			if ($ter[$n] > $inicio_h){
				$d = $n;
				$y = 3;
				$periodo = 'noite';
			}
		}
	}
	return $periodo;
}