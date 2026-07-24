<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body text="#FFFFFF">
<?
session_start();
include '../funcoes/conecta.php';

	if(isset($_COOKIE['cli']))
		$id_cli = $_COOKIE["cli"];
	else
		$id_cli = 0;

	if(isset($_COOKIE['pro']))
		$id = $_COOKIE["pro"];
	else
		$id = 0;
$dt = $_POST['dt'];
$dt = !empty($_POST["dt"])?$_POST["dt"]:"";
$timestamp = strtotime($dt);
$dt = date('Y-m-d', $timestamp);
$ob = !empty($_POST["ob"])?$_POST["ob"]:"";
//$cid = !empty($_POST["cid"])?$_POST["cid"]:"nacional";
mysql_select_db(BASE,$cn)or die(mysql_error());	
date_default_timezone_set('UTC');
$sql = mysql_query("Select cidade_pro, empresa from cadastro_profissionais where id_pro=$id");
$table = mysql_fetch_row($sql);
mysql_query("INSERT INTO  calendario_pro(data,id,id_cad,observacoes,cidade,fixo,empresa)
VALUES ('".$dt."','', '".$id."','".$ob."','".$table[0]."','0','".$table[1]."')")or die(mysql_error());

echo("<script>alert('Data marcada com sucesso!')</script>");
/*echo "<script language='javascript'>history.back()</script>";
echo("<script>alert('Data marcada com sucesso!')</script>");
echo "<script language='javascript'>history.back()</script>";
header ("location: ../principais/calendario.php");*/

echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=calendario.php'/>");

?>
</body>
</html>