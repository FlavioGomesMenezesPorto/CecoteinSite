<?
include("conecta.php");
include("verifica.php");
include("barra.php");

$cd_usuario = $HTTP_GET_VARS['codigo'];
$nm_usuario = "";

$err = $HTTP_GET_VARS['err'];
$c1 = $HTTP_GET_VARS['c1'];
$c2 = $HTTP_GET_VARS['c2'];
echo "<b><font face='Arial' color=black size=3><p align='center'>Após a alteração você voltará para a tela de acesso para logar novamente!</p></font>";
if (($err=="1") || ($err=="2") || ($err=="3") || ($err=="4") || ($err=="5"))
{
   $cd_usuario = $c1;
   $nm_usuario = $c2;
   echo "<b><font face='Arial' color=red size=3>";
   switch ($err)
   {
      case "1": echo "Atenção - Confirmação da senha inválida!"; break;
   }
   echo "</font></b>";
}

echo "
<div align='center'>
 <center>
  <form action=usuario_rg.php method=post name=myform enctype='multipart/form-data'>
   <table border=1 bordercolor='#0066FF' width=780 cellpadding=1 cellspacing=1>
    <tr><input type='hidden' name='cd_usuario' value='$cd_usuario' size='20'>
     <td width=20% class='tablabel'><font class=label>Senha</font></td>
     <td width=80% class='tabcad'><input type='password' name='senha' value ='' size=50 maxlength=20 class=cad></td>
    </tr>
    <tr>
     <td width=20% class='tablabel'><font class=label>Confirma a senha</font></td>
     <td width=80% class='tabcad'><input type='password' name='confirma' value ='' size=50 maxlength=20 class=cad></td>
    </tr>
   </table>
   <br>
   <input type='submit' value='Altera' class=cad>  <input type='reset' value='Limpa' class=cad>
  </form>
</center>
</div>";
?>

