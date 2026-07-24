<?
include("conecta.php");
include("verifica.php");
include("barra.php");

$cd_usuario = "";
$nm_usuario = "";

$err = $HTTP_GET_VARS['err'];
$c1 = $HTTP_GET_VARS['c1'];
$c2 = $HTTP_GET_VARS['c2'];
if (($err=="1") || ($err=="2") || ($err=="3") || ($err=="4") || ($err=="5"))
{
   $cd_usuario = $c1;
   $nm_usuario = $c2;
   echo "<b><font face='Arial' color=red size=3>";
   switch ($err)
   {
      case "1": echo "Atenção - Código do usuário tem que ser preenchido!"; break;
      case "2": echo "Atenção - Nome do usuário tem que ser preenchido!"; break;
      case "3": echo "Atenção - Senha do usuário tem que ser preenchido!"; break;
      case "4": echo "Atenção - Confirmação da senha inválida!"; break;
      case "5": echo "Atenção - Usuário já cadastrado com este código!"; break;
   }
   echo "</font></b>";
}

echo "
<div align='center'>
 <center>
  <form action=usuario_gr.php method=post name=myform enctype='multipart/form-data'>
   <table border=1 bordercolor='#0066FF' width=780 cellpadding=1 cellspacing=1>
    <tr>
     <td width=20% class='tablabel'><font class=label>Código</font></td>
     <td width=80% class='tabcad'><input type='text' name='codigo' value ='$cd_usuario' size=10 maxlength=3 class=cad></td>
    </tr>
    <tr>
     <td width=20% class='tablabel'><font class=label>Nome</font></td>
     <td width=80% class='tabcad'><input type='text' name='nome' value ='$nm_usuario' size=50 maxlength=30 class=cad></td>
    </tr>
    <tr>
     <td width=20% class='tablabel'><font class=label>Nome</font></td>
     <td width=80% class='tabcad'><select name='tp_usuario' size='1' class=cad>
                                      <option value='adm'>Administrador</option>
                                      <option value='usr'>Usuário</option>
                                     </select>
    </td>
    </tr>
    <tr>
     <td width=20% class='tablabel'><font class=label>Senha</font></td>
     <td width=80% class='tabcad'><input type='password' name='senha' value ='' size=50 maxlength=20 class=cad></td>
    </tr>
    <tr>
     <td width=20% class='tablabel'><font class=label>Confirma a senha</font></td>
     <td width=80% class='tabcad'><input type='password' name='confirma' value ='' size=50 maxlength=20 class=cad></td>
    </tr>
   </table>
   <br>
   <input type='submit' value='Cadastra' class=cad>  <input type='reset' value='Limpa' class=cad>
  </form>
</center>
</div>";
?>

