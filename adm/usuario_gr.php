<?
include("conecta.php");
//include("verifica.php");

$cd_usuario = $HTTP_POST_VARS['codigo'];
$nm_usuario = $HTTP_POST_VARS['nome'];
$ds_senha = $HTTP_POST_VARS['senha'];
$confirma = $HTTP_POST_VARS['confirma'];
$tp_usuario = $HTTP_POST_VARS['tp_usuario'];

$err = 0;
$Query_procura = mysql_query("select * from tb_usuario where cd_usuario='$cd_usuario'");
if (mysql_num_rows($Query_procura)>0)
   $err=5;
if ($confirma != $ds_senha)
   $err=4;
if (empty($ds_senha))
   $err=3;
if (empty($nm_usuario))
   $err=2;
if (empty($cd_usuario))
   $err=1;

if ($err == 0)
{
   $Query_cadastra = mysql_query("insert into tb_usuario (cd_usuario, nm_usuario, ds_senha, tp_usuario)
                     values ('$cd_usuario', '$nm_usuario', '$ds_senha', '$tp_usuario')") or die("erro query cadastra usuario");
   header("Location: usuario.php");
}
else
{
   header("Location: usuario_cd.php?err=".$err."&c1=".$cd_usuario."&c2=".$nm_usuario);
}

?>

