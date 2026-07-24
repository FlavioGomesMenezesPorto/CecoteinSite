<?
  include("conecta.php");
  include("verifica.php");

  $imagemdir = '../imagens/';

  $cd_sistema = $_GET['sist'];
  $cd_tela = $_GET['cod'];
  $foto_tela = $_GET['foto'];
  $query_deleta = mysql_query("delete from tb_telas where cd_tela = '$cd_tela'") or die ("ERRO QUERY DELETA TELA");

  if (!empty($foto_tela)) {
    if (file_exists($imagemdir.$foto_tela))
      unlink($imagemdir.$foto_tela);
  }

  header("Location: telas.php?cod=$cd_sistema");
?>
