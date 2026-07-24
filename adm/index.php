<?php
// Login do admin: sem redirecionamento automático.
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<title>:: Administra��o - Cecotein ::</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href='estilos.css' rel='stylesheet' type='text/css'>

</head>



<body bgcolor="#EEEEEE">

<center>

<table width="780" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

 <tr>

  <td valign="top" bgcolor="#FFFFFF">

    <img src="topoadm.bmp">

  </td>

 </tr>

 <tr><td height="40" valign="top">&nbsp;</td></tr>

 <tr>

  <td height="400" valign="top" align="center" colspan="2">



 <table width="200" cellpadding="2" cellspacing="0">

 <form method="POST" action="valida.php" onsubmit>

<?

$err = $HTTP_GET_VARS['err'];

if (!empty($err))

{

   switch ($err)

   {

      case 1: echo '<tr><td colspan="2"><font face="Verdana" size="3" color="#FF0000">Aten&ccedil;&atilde;o - Administrador n&atilde;o cadastrado!</font></td></tr>'; break;

      case 2: echo '<tr><td colspan="2"><font face="Verdana" size="3" color="#FF0000">Aten&ccedil;&atilde;o - Senha digitada incorretamente!</font></td></tr>'; break;

   }

}

?>	

 <tr>

  <td colspan="2" class="tabtitulo" align="center">

   <font class="titulo"><strong>L O G I N</strong></font>

  </td>

 </tr>

 <tr>

  <td width="100" align="left" bgcolor="White">

   <font class="label">Usu&aacute;rio</font>

  </td>

 <td width="100" bgcolor="White">

  <input class="cad" type="text" name="codigo" value ="" size="10" maxlength="30">

 </td>

 </tr>

 <tr>

  <td width="100" class="tabdetalhe">

   <font class="label"><b>Senha</b></font>

  </td>

  <td width="100" class="tabdetalhe">

   <input class="cad" type="password" name="senha" value ="" size="10" maxlength="20">

  </td>

 </tr>

 <tr>

  <td width="100" align="center"><input class="cad"  type="submit" value="Entrar" name="ENTRAR"></td>

  <td width="100" align="center"><input class="cad"  type="reset" value="Limpar" name="LIMPAR"></td>

 </tr>

 </form>

</table>



  </td>

 </tr>

</table>

</center>

</body>

</html>

