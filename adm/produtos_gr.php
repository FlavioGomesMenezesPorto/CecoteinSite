<?
  include("conecta.php");
  $produtos = $_POST['DsTexto'];
  if (empty($produtos)) {
  	header("Location: produtos.php?err=1");
  }
  else {
  	$query_historico = mysql_query("update tb_conteudo set ds_cont = '$produtos' where cd_cont = '2'")
  	  or die ("ERRO QUERY PRODUTOS");
  	header("Location: produtos.php");
  }
?>