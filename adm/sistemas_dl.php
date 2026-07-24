<?
  include("conecta.php");
  include("verifica.php");
  
  $imagemdir = '../imagens/';
  
  $cd_sistema = $_GET['cod'];
  $logo_sistema = $_GET['foto'];
  $query_deleta = mysql_query("delete from tb_sistemas where cd_sistema = '$cd_sistema'") or die ("ERRO QUERY DELETA SISTEMA");
  
  if (!empty($logo_sistema)) {
    if (file_exists($imagemdir.$logo_sistema))
      unlink($imagemdir.$logo_sistema);
  }

  header("Location: sistemas.php");
?>