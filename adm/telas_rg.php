<?
  include("conecta.php");
  $imagemdir = '../imagens/';

  $cd_tela = $_POST['cd_tela'];
  $cd_sistema = $_POST['cd_sistema'];
  $nm_tela = $_POST['nm_tela'];
  $ds_tela = $_POST['ds_tela'];
  $foto_ant = $_POST['foto_ant'];

  $fotopath = $_FILES['foto_tela']['tmp_name'];
  $nm_foto = $_FILES['foto_tela']['name'];
  $tp_foto = $_FILES['foto_tela']['type'];
  if (!empty($nm_foto)) {
    $query_telas = mysql_query("update tb_telas set nm_tela = '$nm_tela', ds_tela = '$ds_tela', foto_tela = '$nm_foto'
      where cd_tela = '$cd_tela'") or die ("ERRO QUERY TELAS");
    if (!file_exists($imagemdir.$foto_ant)) {
    	unlink($imagemdir.$foto_ant);
    }
    if (!file_exists($imagemdir.$nm_foto)) {
      move_uploaded_file($fotopath, $imagemdir.$nm_foto);
      chmod("$imagemdir"."$nm_foto", 0707);
    }
  }
  else {
    $query_telas = mysql_query("update tb_telas set nm_tela = '$nm_tela', ds_tela = '$ds_tela'
      where cd_tela = '$cd_tela'") or die ("ERRO QUERY TELAS");
  }

  header("Location: telas.php?cod=$cd_sistema");
?>
