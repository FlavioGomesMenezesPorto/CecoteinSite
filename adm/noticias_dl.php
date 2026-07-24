<?
include('conecta.php');
//include('verifica.php');

$inicio = $_GET['beg'];
$codigo = $_GET['codigo'];

$qdeleta = mysql_query("delete from tb_noticias where cd_noticia='$codigo'") or die('Erro ao deletar noticia');
header('Location: noticias.php?beg='.$inicio);
?>
