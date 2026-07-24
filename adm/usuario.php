<?
include("conecta.php");
include("verifica.php");
include("barra.php");
$cod = $HTTP_SESSION_VARS['codigo_adm'];
$tipo = $HTTP_SESSION_VARS['tipo'];
echo "
<div align='center'>
 <center>";
 if ($tipo == 'adm') {
   echo"<table width=350 border=0 cellpadding=1 cellspacing=1>
     <tr>
      <td width=100 bgcolor='#FFFFFF' bordercolor='#FFFFFF'><font class=titulo><a href='usuario_cd.php' class='acao'>Novo Usuario</a></font></td>
      <td width=250><font face='Arial' size=1 color='#FFFFFF'></font></td>
     </tr>
     </table>";
 }
  echo "
  <table width=350 cellpadding=1 cellspacing=1>
   <tr>
    <th colspan=4 width=350 class='tabtitulo'><p align='center'><font class=titulo>USUÁRIOS ADMINISTRADORES</font></p></th>
   </tr>
   <tr>
    <td width=50 class='tabtitulo'><p align='center'><font class=titulo>Código</font></p></td>
    <td width=100 class='tabtitulo'><p align='center'><font class=titulo>Usuário</font></p></td>
    <td width=100 class='tabtitulo'><p align='center'><font class=titulo>Tipo</font></p></td>
    <td width=100 class='tabtitulo'><p align='center'><font class=titulo>Ação</font></p></td>
   </tr>";
$Query_usuario=mysql_query("select cd_usuario, nm_usuario, tp_usuario from tb_usuario order by nm_usuario") or die ("erro query lista usuario");
while($registros = mysql_fetch_array($Query_usuario))
{
   $cd_usuario = $registros["cd_usuario"];
   $nm_usuario = $registros["nm_usuario"];
   $tp_usuario = $registros["tp_usuario"];

   echo "
   <tr>
    <td width=50 class='tabdetalhe'><font class='detalhe'>".$cd_usuario."</font></td>
    <td width=100 class='tabdetalhe'><font class=detalhe>".$nm_usuario."</font></td>
    <td width=100 class='tabdetalhe'><font class=detalhe>".$tp_usuario."</font></td>";
   if ($tipo == 'adm') {
     if ($cd_usuario == $cod) {
       echo "
        <td width=100 class='tabdetalhe'><a href='usuario_mn.php?codigo=".$cd_usuario."' class='acao'>Alterar Senha</a></font></td>
       </tr>";
     }
     else {
       echo "
        <td width=100 class='tabdetalhe'><a href='usuario_dl.php?codigo=".$cd_usuario."' class='acao'>Excluir</a></font></td>
       </tr>";
     }
   }
   else {
      if ($cd_usuario == $cod) {
       echo "
        <td width=100 class='tabdetalhe'><font class=fadm><a href='usuario_mn.php?codigo=".$cd_usuario."' class='acao'>Alterar Senha</a></font></td>
       </tr>";
      }
      else {
       echo "
        <td width=100 bgcolor='#FFFACD'><font class=fadm> - </font></td>
       </tr>";
      }
   }
}
echo "</table>
</center>
</div>";
?>

