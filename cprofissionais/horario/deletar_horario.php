<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
<link href="../estilos/pagprincipal.css" type="text/css" rel="stylesheet">
<title>Untitled Document</title>
</head>

<body>
<?php
include '../funcoes/conecta.php';


?>
<div class="principal">
        
<div id="flash" >
                <!--<object width="1500px" height="65px">
                    <param name="movie" value="../menu/Menu-cliente.swf">
                    <param name="wmode" value="transparent" />
                    <embed wmode="transparent" src="../menu/Menu-cliente.swf" width="900px" height="60px" />
                </object>-->
        <?php
			include ("../funcoes/menu_teste.html");
		?>  
</div>
<div class="conteudo"> 
  <?php
	session_start();
	if(isset($_COOKIE['pro']))
		$id_pro = $_COOKIE["pro"];
	else
		$id_pro = 0;
	include '../funcoes/conecta.php';
	include '../funcoes/somaHora.php';
	include '../funcoes/funcoes.php';
	mysql_select_db(BASE,$cn)or die(mysql_error());
	date_default_timezone_set('UTC');
	$id = $_GET['id'];// id do cliente
	$hor  = $_GET['hor'];
	$p = $_GET['id_p'];// id do profissional desmarcado
	$hora = $_GET["h"]; // hora marcada
	/*$h = strtotime($hora);
	$hora = time('H:i:s', $h);*/
	$data = $_GET["d"]; // data marcada
	$d = strtotime($data);
	$data = date('Y-m-d',$d);
	
	$data2 = date('Y-m-d'); // dara desmarcada
	$hora2 = date('H:i:s'); // hora desmarcada
	$agora = $data2.' '.$hora2;
	
	$pesquisa = mysql_query("Select nome_pro from cadastro_profissionais where id_pro = ".$p);
	$nomeEmp = mysql_fetch_row($pesquisa);
	
	mysql_query("DELETE FROM horarios_pro where id_pro = '$hor'") or die(mysql_error());
	if (mysql_affected_rows() == 1 ) {
		echo('<img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<font size="+2">
		O horário foi desmarcado com sucesso! </font>');
		mysql_query("Insert into desmarcado_pro(id_profissional_pro, id_cliente_pro, horario_pro, data_pro, hora_desmarcado, 						
		id_profissional) values($p, '$id', '$hora', '$data', '$agora', '$id_pro') ") or die (mysql_error());
		echo('<form name="voltar">
		 	<a href="../horario/visualizar_horarios.php?p='.$p.'&n='.$nomeEmp[0].'"> <input type="button" name="Ok" value="Voltar"> </a>
		</form>');
	} else {
		echo("Ocorreu erro na hora de excluir o compromisso");
	}
	
  ?>
</div>

</div>
</body>
</html>