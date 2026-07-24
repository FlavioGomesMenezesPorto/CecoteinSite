<?
include("conecta.php");

$inicio = $_POST['inicio'];
$codigo = $_POST['codigo'];
$dt_noticia = $_POST['dt_noticia'];
$tit_noticia = $_POST['tit_noticia'];
$res_noticia = $_POST['res_noticia'];
$texto_noticia = $_POST['DsTexto'];
$dt_noticia = substr($dt_noticia,6,4)."-".substr($dt_noticia,3,2)."-".substr($dt_noticia,0,2);

$Query_cadastra = mysql_query("update tb_noticias set dt_noticia = '$dt_noticia', tit_noticia = '$tit_noticia', res_noticia = '$res_noticia',
   texto_noticia = '$texto_noticia' where cd_noticia='$codigo'") or die("erro query regravando noticia");

header("Location: noticias.php?beg=".$inicio);
?>
