<?
include("conecta.php");
include("verifica.php");

$cd_usuario = $HTTP_GET_VARS['codigo'];

$Query_deleta = mysql_query("delete from tb_usuario where cd_usuario='$cd_usuario'") or die("erro query deleta usuario");
header("Location: usuario.php");
?>

