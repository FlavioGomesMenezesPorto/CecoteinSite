<?
  include("conecta.php");
  include("verifica.php");
  
  $imagemdir = '../imagens/';
  
  $nm_sistema = $_POST['nm_sistema'];
  $ds_sistema = $_POST['ds_sistema'];
  $req_sistema = $_POST['req_sistema'];
  
  $fotopath = $_FILES['logo_sistema']['tmp_name'];
  $nm_foto = $_FILES['logo_sistema']['name'];
  $tp_foto = $_FILES['logo_sistema']['type'];  
  
  $query_sistemas = mysql_query("insert into tb_sistemas (nm_sistema, ds_sistema, req_sistema, logo_sistema) 
  values ('$nm_sistema', '$ds_sistema', '$req_sistema', '$nm_foto')") or die ("ERRO QUERY SISTEMAS");
  if (!empty($nm_foto)) {
    if (!file_exists($imagemdir.$nm_foto))
        move_uploaded_file($fotopath, $imagemdir.$nm_foto);
    chmod("$imagemdir"."$nm_foto", 0707); 
  }  
  
  header("Location: sistemas.php");
?>