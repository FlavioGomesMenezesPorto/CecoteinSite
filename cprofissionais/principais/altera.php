<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
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
//echo($dt);
$i = 0;
$timestamp = strtotime($dt);
$dt = date('Y-m-d', $timestamp);
//echo($dt);
$ob = $_POST['ob'];
$cid = $_POST['cid'];
//srttolower($cid); //converte tudo para minusculo
//ucfirst($cid); //converte a primeira letra para maiusculo
$idd = $_POST['idd'];
mysql_select_db(BASE,$cn)or die(mysql_error());

mysql_query("UPDATE  calendario_pro SET  data='".$dt."', observacoes='".$ob."', cidade='".$cid."' WHERE id = $idd ");

echo("<script>alert('Data alterada com sucesso!')</script>");
//header ("location: ../principais/calendario.php");
echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/calendario.php'/>");

?>
</body>
</html>