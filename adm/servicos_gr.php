<?
  include("conecta.php");
  $servicos = $_POST['DsTexto'];
  if (empty($servicos)) {
  	header("Location: servicos.php?err=1");
  }
  else {
  	$query_servicos = mysql_query("update tb_conteudo set ds_cont = '$servicos' where cd_cont = '3'")
  	  or die ("ERRO QUERY PRODUTOS");
  	header("Location: servicos.php");
  }
?>