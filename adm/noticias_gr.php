<?
include("conecta.php");

$inicio = $_POST['inicio'];
$dt_noticia = $_POST['dt_noticia'];
$tit_noticia = $_POST['tit_noticia'];
$res_noticia = $_POST['res_noticia'];
$texto_noticia = $_POST['DsTexto'];
$dt_noticia = substr($dt_noticia,6,4)."-".substr($dt_noticia,3,2)."-".substr($dt_noticia,0,2);

$Query_cadastra = mysql_query("insert into tb_noticias (dt_noticia, tit_noticia, res_noticia, texto_noticia, time)
   values ('$dt_noticia', '$tit_noticia', '$res_noticia', '$texto_noticia', now())") or die("erro query cadastra noticia");

header("Location: noticias.php?beg=".$inicio);
?>
