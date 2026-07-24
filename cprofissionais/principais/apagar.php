<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?
session_start();
	if(isset($_COOKIE['cli']))
		$id_cli = $_COOKIE["cli"];
	else
		$id_cli = 0;

	if(isset($_COOKIE['pro']))
		$id = $_COOKIE["pro"];
	else
		$id = 0;
include '../funcoes/conecta.php';
mysql_select_db(BASE,$cn)or die(mysql_error());
date_default_timezone_set('UTC');
		
$dt = !empty($_GET["dt"])?$_GET["dt"]:"";
//echo("DELETE FROM calendario_pro WHERE id = $dt");
mysql_query("DELETE FROM calendario_pro WHERE id = $dt");

//$resposta = mysql_query($sql,$cn) or die (mysql_error());

mysql_query("INSERT INTO `data_desmarcada` (
`id_data` ,
`id_pro` 
)
VALUES (
'".$dt."', '".$id."'
);");

echo("<script>alert('Data desmarcada com sucesso!')</script>");
//header ("location: ../principais/calendario.php");

echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/calendario.php '/>");
?>

</body>
</html>