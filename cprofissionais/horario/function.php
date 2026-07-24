<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
header('Content-Type: text/html; charset=utf-8');
include '../funcoes/conecta.php';

mysql_select_db(BASE,$cn)or die(mysql_error());
date_default_timezone_set('UTC');

$SQL = "SELECT * FROM calendario_pro where cidade='nacional'";
$respota = mysql_query($SQL);
while ($row = mysql_fetch_array($respota)) {
	$data = $row['data'];
	echo('data do feriado eh'.$data);
}
?>


</body>
</html>