<?
	include '../funcoes/conecta.php';
	mysql_select_db(BASE,$cn)or die(mysql_error());
	session_start();
	
	if(isset($_COOKIE['cli']))
		$id_cli = $_COOKIE["cli"];
	else
		$id_cli = 0;

	if(isset($_COOKIE['pro']))
		$id1 = $_COOKIE["pro"];
	else
		$id1 = 0;
	
	$nome = $_GET['n'];
	$id = $_GET["r"];	
	$pesquisa = mysql_query("Select mostrar_grade from cadastro_profissionais where id_pro = '$id'");
	$pes = mysql_fetch_row($pesquisa);
	
	if ($pes[0] == 'on' )
	{
		echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/cad_horario_2.php?r=".$id."&n=".$nome."'>");
	}
	else
	{
	   echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/cad_horario_1.php?r=".$id."&n=".$nome."'>");
	}
	
?>	