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
		
$dt = !empty($_GET["dt"])?$_GET["dt"]:"";
$ob = !empty($_GET["ob"])?$_GET["ob"]:"";
if($dt == "") {
	echo("<script>alert('Campo 'data' não pode estar vazio')</script>");
	header ("location: ../principais/calendario.php");
	echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/calendario.php />");
} else {
	if($ob == "") {
		echo("<script>alert('Campo 'observação' não pode estar vazio')</script>");
		header ("location: ../principais/calendario.php");
		echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/calendario.php />");
	}
}
$sql = "INSERT INTO  `shoppingvirtualu`.`calendario_pro` (
`data` ,
`id` ,
`id_cad`,
`observacoes` ,
`cidade`
)
VALUES (
'".$dt."', NULL , '".$id."',  '".$ob."',  'Uberaba'
);";

echo("<script>alert('Data marcada com sucesso!')</script>");
echo "<script language='javascript'>history.back()</script>";
header ("location: ../principais/calendario.php");
echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/calendario.php' />");

?>
</body>
</html>