<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home Cliente</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8', true);
	   ?>
		<link href="../estilos/pagprincipal.css" type="text/css" rel="stylesheet">
        <link href="../calendario/_style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../calendario/_scripts/jquery.js"></script>
<script type="text/javascript" src="../calendario/_scripts/jquery.click-calendario-1.0-min.js"></script>		
<script type="text/javascript" src="../calendario/_scripts/exemplo-calendario.js"></script>
	</head>	
	<!-- #################################################################################### -->
	<body>
		<div class="principal">
			<div class="menu" >
                <div id="cabeca" >
                    
                    <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
                </div>
                
              <div id="flash" >
                     <!--<object width="1500px" height="65px">
                         <param name="movie" value="../menu/Menu-cliente.swf">
                         <param name="wmode" value="transparent" />
                         <embed wmode="transparent" src="../menu/Menu-cliente.swf" width="900px" height="60px" />
                    </object>-->
                    <?php
					 include ("../funcoes/menu-prof.html");
				?>
                </div>
                
                
			</div> <!-- Fecha a div Menu -->
			<!-- ##########################################################FIM MENU######################################## -->
           
	        <!-- ****************************** A partir daqui ira mudar a div -->
            <div class="conteudo">
            	<p align="right">
<input type="button" value="cancelar" onclick="javascript:history.back(1)" />
                <?php
session_start();
include '../funcoes/conecta.php';
//$cn = mysql_connect("localhost","root",""); // Usar somente essa parte do código
//mysql_select_db('shoppingvirtualu',$cn)or die(mysql_error());
mysql_select_db(BASE,$cn)or die(mysql_error());
$i = 0;
date_default_timezone_set('UTC');
	$opcao = $_GET['opcao'];
	//echo($opcao);
	//echo('<div><input type="button" value="Cancelar" onclick="javascript:history.back(1)" /></div>');
	if($opcao =='apagar'){
		$dt = $_POST['dt'];
		$timestamp = strtotime($dt);
		$dt = date('Y-m-d', $timestamp);
		$sql = "select * from calendario_pro where data='".$dt."'";
		$resposta = mysql_query($sql, $cn);
		echo('<table border="0" cellpadding="2" cellspacing="10">
			<tr>
				<td> <font color="#CD3333"> <b> Data </b> </font> </td>
				<td> <font color="#CD3333"> <b> Observação </b> </font> </td> 
				<td> <font color="#CD3333"> <b> Cidade </b> </font> </td>
			</tr>');
		while ($row = mysql_fetch_array($resposta)) {
			$dados[$i][0] = $row['observacoes'];
			$dados[$i][1] = $row['cidade'];
			$dados[$i][2] = $row['id'];
			echo('<tr>
				<td><a href="apagar.php?dt='.$dados[$i][2].'">'.$dt.'</a></td>');
				echo('<td>'.$dados[$i][0].'</td>');
				echo('<td>'.$dados[$i][1].'</td>
			</tr>');
			$i = $i+1;
		}		
		echo('</tr></table>');
	}
	if ($opcao =='alterar'){
		$dt = $_POST['dt'];
		$timestamp = strtotime($dt);
		$dt = date('Y-m-d', $timestamp);
		$sql = "select * from calendario_pro where data='".$dt."'";
		$resposta = mysql_query($sql, $cn);
		echo('<table border="0" cellpadding="2" cellspacing="10">
			<tr>
				<td> <font color="#CD3333"> <b> Data </b> </font> </td>
				<td> <font color="#CD3333"> <b> Observação </b> </font> </td> 
				<td> <font color="#CD3333"> <b> Cidade </b> </font> </td>
				<td></td>
			</tr>');
			$dt = date('d-m-Y', $timestamp);
		while ($row = mysql_fetch_array($resposta)) {
			$dados[$i][0] = $row['observacoes'];
			$dados[$i][1] = $row['cidade'];
			$dados[$i][2] = $row['id'];
			echo('<tr>
			<form action="altera.php" method="post">
				<td valign="top"><input type="text" style="width:78px; size="20" id="data_2" name="dt" value="'.$dt.'"/></td>');
				echo('<td><textarea name="ob" cols="20" rows="2">'.htmlspecialchars_decode(htmlentities($dados[$i][0])).'</textarea></td>');
				echo('<td valign="top"><input type="text" style="width:100px; size="20" name="cid" value="'.$dados[$i][1].'"/></td>
				<input type="hidden" name="idd" value="'.$dados[$i][2].'"/>
				<td valign="top"><input type="submit" value="Alterar"/>
			</form>
			</tr>');
			$i = $i+1;
		}		
		echo('</tr></table>');
	}

?>
 </div>
