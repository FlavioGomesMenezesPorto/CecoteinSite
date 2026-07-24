<?
  include("barra.php");
  include("funcoes.php");
?>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
   var oFCKeditor = new FCKeditor( 'ds_sistema' ) ;
   oFCKeditor.Width = 600;
   oFCKeditor.Height = 400 ;
   oFCKeditor.ToolbarSet = "MyToolbarAdm" ;
   oFCKeditor.BasePath = "fckeditor/" ;
   oFCKeditor.ReplaceTextarea() ;
   
   var oFCKeditor2 = new FCKeditor( 'req_sistema' ) ;
   oFCKeditor2.Width = 600;
   oFCKeditor2.Height = 400 ;
   oFCKeditor2.ToolbarSet = "MyToolbarAdm" ;
   oFCKeditor2.BasePath = "fckeditor/" ;
   oFCKeditor2.ReplaceTextarea() ;   
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

echo '
<form action="sistemas_gr.php" method="post" name="myform" enctype="multipart/form-data" onsubmit="return validacao();">
 <input type="hidden" name="inicio" value="'.$inicio.'">
 <input type="hidden" name="cd_site" value="'.$cd_site.'">
   <table width="600" border="0" cellpadding="2" cellspacing="0">
    <tr> 
     <td class="tabtitulo" colspan="2"><font class="titulo">CADASTRANDO UM NOVO SISTEMA</font></td>
    </tr>
    <tr>
     <td width="120" class="tablabel"><font class="label">Nome</font></td>
     <td width="480" class="tabcad"><input class="cad" type="text" name="nm_sistema" value ="" size="80" maxlength="150"></td>
    </tr>
    <tr>
     <td width="120" class="tablabel"><font class="label">Logo</font></td>
     <td width="480" class="tabcad"><input class="cad" type="file" name="logo_sistema" size="80" maxlength="150"></td>
    </tr>    
    <tr>
     <td class="tablabel" colspan="2"><font class="label">Descrição</font></td>
 	  </tr>
    <tr> 
     <td class="tabcad" colspan="2"><textarea id="ds_sistema" name="ds_sistema"></textarea></td>
    </tr>
    <tr>
     <td class="tablabel" colspan="2"><font class="label">Requisitos Mínimos</font></td>
 	  </tr>
    <tr> 
     <td class="tabcad" colspan="2"><textarea id="req_sistema" name="req_sistema"></textarea></td>
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
