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
  include("conecta.php");
  $imagemdir = '../imagens/';
$cd_sistema = $_GET['cod'];
$query_sistemas = mysql_query("select * from tb_sistemas where cd_sistema = '$cd_sistema'")
    or die ("ERRO QUERY SISTEMA");
$sistema = mysql_fetch_array($query_sistemas);
$nm_sistema = $sistema['nm_sistema'];
$ds_sistema = $sistema['ds_sistema'];
$req_sistema = $sistema['req_sistema'];
$logo_sistema = $sistema['logo_sistema'];
echo '
<form action="sistemas_rg.php" method="post" name="myform" enctype="multipart/form-data" onsubmit="return validacao();">
  <input type="hidden" name="cd_sistema" value="'.$cd_sistema.'">
  <input type="hidden" name="foto_ant" value="'.$logo_sistema.'">
   <table width="600" border="0" cellpadding="2" cellspacing="0">
    <tr> 
     <td class="tabtitulo" colspan="2"><font class="titulo">CADASTRANDO UM NOVO SISTEMA</font></td>
    </tr>
    <tr>
     <td width="120" class="tablabel"><font class="label">Nome</font></td>
     <td width="480" class="tabcad"><input class="cad" type="text" name="nm_sistema" value ="'.$nm_sistema.'" size="80" maxlength="150"></td>
    </tr>
    <tr>
     <td colspan=2 width="600" class="tablabel"><font class="label">Logo</font>
     <img src="'.$imagemdir.$logo_sistema.'" border=0 width="50%"></td>
    </tr>
    <tr>
     <td colspan=2 width="600" class="tabcad"><input class="cad" type="file" name="logo_sistema" size="80" maxlength="150"></td>
    </tr>    
    <tr>
     <td class="tablabel" colspan="2"><font class="label">Descrição</font></td>
 	  </tr>
    <tr> 
     <td class="tabcad" colspan="2"><textarea id="ds_sistema" name="ds_sistema">'.$ds_sistema.'</textarea></td>
    </tr>
    <tr>
     <td class="tablabel" colspan="2"><font class="label">Requisitos Mínimos</font></td>
 	  </tr>
    <tr> 
     <td class="tabcad" colspan="2"><textarea id="req_sistema" name="req_sistema">'.$req_sistema.'</textarea></td>
    </tr>    
   <tr>
    <td class="tabcad" colspan="2">
	 <input type="submit" value="Gravar" class=cad>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="reset" value="Limpa" class=cad>
	</td>
   </tr>
   </table>
  </form>';
?>
