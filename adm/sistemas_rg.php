<?
  include("conecta.php");
  include("verifica.php");
  
  $imagemdir = '../imagens/';
  
  $cd_sistema = $_POST['cd_sistema'];
  $nm_sistema = $_POST['nm_sistema'];
  $ds_sistema = $_POST['ds_sistema'];
  $req_sistema = $_POST['req_sistema'];
  
  $fotopath = $_FILES['logo_sistema']['tmp_name'];
  $nm_foto = $_FILES['logo_sistema']['name'];
  $tp_foto = $_FILES['logo_sistema']['type']; 
  
  $foto_ant = $_POST['foto_ant'];
  
  if (!empty($nm_foto)) {
    $query_sistemas = mysql_query("update tb_sistemas set nm_sistema = '$nm_sistema', ds_sistema = '$ds_sistema', 
    req_sistema = '$req_sistema', logo_sistema = '$nm_foto' where cd_sistema = '$cd_sistema'") or die ("ERRO QUERY SISTEMAS");

    if (!file_exists($imagemdir.$foto_ant)) {
    	unlink($imagemdir.$foto_ant);
    }
    if (!file_exists($imagemdir.$nm_foto)) {
      move_uploaded_file($fotopath, $imagemdir.$nm_foto);
      chmod("$imagemdir"."$nm_foto", 0707); 
    }
  }
  else {
    $query_sistemas = mysql_query("update tb_sistemas set nm_sistema = '$nm_sistema', ds_sistema = '$ds_sistema', 
    req_sistema = '$req_sistema' where cd_sistema = '$cd_sistema'") or die ("ERRO QUERY SISTEMAS");
  }
  
  header("Location: sistemas.php");
?>