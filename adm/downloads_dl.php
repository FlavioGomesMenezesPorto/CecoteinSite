<?
  include("conecta.php");
  include("verifica.php");

  $arqdir = '../arquivos/';

  $cd_down = $_GET['cod'];
  $arq_down = $_GET['arq'];
  $query_deleta = mysql_query("delete from tb_downloads where cd_down = '$cd_down'") or die ("ERRO QUERY DELETA ARQUIVO");

  if (!empty($arq_down)) {
    if (file_exists($arqdir.$arq_down))
      unlink($arqdir.$arq_down);
  }

  header("Location: downloads.php");
?>
