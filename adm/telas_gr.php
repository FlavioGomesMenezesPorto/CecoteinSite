<?
  include("conecta.php");
  $imagemdir = '../imagens/';
  
  $cd_sistema = $_POST['cd_sistema'];
  $nm_tela = $_POST['nm_tela'];
  $ds_tela = $_POST['ds_tela'];

  $fotopath = $_FILES['foto_tela']['tmp_name'];
  $nm_foto = $_FILES['foto_tela']['name'];
  $tp_foto = $_FILES['foto_tela']['type'];
  
  $query_telas = mysql_query("insert into tb_telas (cd_sistema, nm_tela, ds_tela, foto_tela)
   values ('$cd_sistema', '$nm_tela', '$ds_tela', '$nm_foto')") or die ("ERRO QUERY TELAS");
  if (!empty($nm_foto)) {
    if (!file_exists($imagemdir.$nm_foto))
        move_uploaded_file($fotopath, $imagemdir.$nm_foto);
    chmod("$imagemdir"."$nm_foto", 0707);
  }
  
  header("Location: telas.php?cod=$cd_sistema");
?>
