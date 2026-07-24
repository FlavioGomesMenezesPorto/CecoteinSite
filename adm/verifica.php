<?php
if (isset($_GET[session_name()])) {
    session_id($_GET[session_name()]);
}
$sess_dir = __DIR__ . '/sess_data';
if (!is_dir($sess_dir)) {
    @mkdir($sess_dir, 0777, true);
}
session_save_path($sess_dir);
session_start();

// Verifica se a sessao do admin existe
if (!isset($_SESSION['codigo_adm']))
{  
   header("Location: index.php");
   exit;
}
else
{
   $cd_admin = isset($_SESSION['codigo_adm']) ? $_SESSION['codigo_adm'] : $HTTP_SESSION_VARS['codigo_adm'];
   $sn_admin = isset($_SESSION['senha_adm']) ? $_SESSION['senha_adm'] : $HTTP_SESSION_VARS['senha_adm'];
   $Query_admin=mysql_query("select * from tb_usuario where cd_usuario='$cd_admin' and ds_senha='$sn_admin'") or die("erro query selecao usuario");
   $linha=mysql_num_rows($Query_admin);
   if ($linha==0)
   {  header("Location: index.php");
      exit;
   }
}
?>
