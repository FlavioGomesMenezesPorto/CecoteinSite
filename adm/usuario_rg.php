<?
  include("conecta.php");
  $ds_senha = $HTTP_POST_VARS['senha'];
  $confirma = $HTTP_POST_VARS['confirma'];
  $cd_usuario = $HTTP_POST_VARS['cd_usuario'];
  $err=0;
  if ($ds_senha != $confirma) {
    $err=1;
  }
  if ($err == 0) {
    $query_update = mysql_query("update tb_usuario set ds_senha = '$ds_senha' where cd_usuario = '$cd_usuario'") or die ("ERRO QUERY UPDATE");
    header("Location: logout.php");
  }
  else {
    header("Location: usuario_mn.php?codigo=$cd_usuario&err=$err");
  }
?>
