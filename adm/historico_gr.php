<?
  include("conecta.php");
  $historico = $_POST['DsTexto'];
  if (empty($historico)) {
  	header("Location: historico.php?err=1");
  }
  else {
  	$query_historico = mysql_query("update tb_conteudo set ds_cont = '$historico' where cd_cont = '1'")
  	  or die ("ERRO QUERY HISTORICO");
  	header("Location: historico.php");
  }
?>