<?
  include("barra.php");
  include("funcoes.php");
?>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
   var oFCKeditor = new FCKeditor( 'ds_tela' ) ;
   oFCKeditor.Width = 600;
   oFCKeditor.Height = 400 ;
   oFCKeditor.ToolbarSet = "MyToolbarAdm" ;
   oFCKeditor.BasePath = "fckeditor/" ;
   oFCKeditor.ReplaceTextarea() ;
}

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
$cd_sistema = $_GET['cod'];

echo '
<form action="telas_gr.php" method="post" name="myform" enctype="multipart/form-data" onsubmit="return validacao();">
 <input type="hidden" name="cd_sistema" value="'.$cd_sistema.'">
   <table width="600" border="0" cellpadding="2" cellspacing="0">
    <tr>
     <td class="tabtitulo" colspan="2"><font class="titulo">CADASTRANDO UMA NOVA TELA</font></td>
    </tr>
    <tr>
     <td width="120" class="tablabel"><font class="label">Nome</font></td>
     <td width="480" class="tabcad"><input class="cad" type="text" name="nm_tela" value ="'.$nm_tela.'" size="80" maxlength="150"></td>
    </tr>
    <tr>
     <td width="120" class="tablabel"><font class="label">Foto</font></td>
     <td width="480" class="tabcad"><input class="cad" type="file" name="foto_tela" size="80" maxlength="150"></td>
    </tr>
    <tr>
     <td class="tablabel" colspan="2"><font class="label">Descrição</font></td>
 	  </tr>
    <tr>
     <td class="tabcad" colspan="2"><textarea id="ds_tela" name="ds_tela"></textarea></td>
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
