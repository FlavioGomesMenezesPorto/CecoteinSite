<?
  include("barra.php");
  include("funcoes.php");
?>
<SCRIPT LANGUAGE="JavaScript">
function validacao()
{
  //validar data
  erro=0;
  if (document.myform.nm_sistema.value == '')
  {
    alert("Atenção - Nome do sistema tem que ser preenchido!");
    document.myform.nm_sistema.focus();
    return false;
  }
}
</script>
<?
$inicio = $_GET['beg'];

echo '
<form action="downloads_gr.php" method="post" name="myform" enctype="multipart/form-data" onsubmit="return validacao();">
 <input type="hidden" name="inicio" value="'.$inicio.'">
   <table width="600" border="0" cellpadding="2" cellspacing="0">
    <tr>
     <td class="tabtitulo" colspan="2"><font class="titulo">CADASTRANDO UM NOVO ARQUIVO</font></td>
    </tr>
    <tr>
     <td width="120" class="tablabel"><font class="label">Nome</font></td>
     <td width="480" class="tabcad"><input class="cad" type="text" name="nm_down" value ="" size="80" maxlength="150"></td>
    </tr>
    <tr>
     <td width="120" class="tablabel"><font class="label">Arquivo</font></td>
     <td width="480" class="tabcad"><input class="cad" type="file" name="arquivo" size="80" maxlength="150"></td>
    </tr>
   <tr>
    <td class="tabcad" colspan="2">
	 <input type="submit" value="Cadastra" class=cad>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="reset" value="Limpa" class=cad>
	</td>
   </tr>
   </table>
  </form>';
?>
