<?
  include("barra.php");
  include("funcoes.php");
  include("conecta.php");
?>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<SCRIPT LANGUAGE="JavaScript">
window.onload = function()
{
   var oFCKeditor = new FCKeditor( 'DsTexto' ) ;
   oFCKeditor.Width = 600;
   oFCKeditor.Height = 400 ;
   oFCKeditor.ToolbarSet = "MyToolbarAdm" ;
   oFCKeditor.BasePath = "fckeditor/" ;
   oFCKeditor.ReplaceTextarea() ;
}
</script>
<?
  $err = $_GET['err'];
  if (!empty($err)) {
  	echo "<div align='center'><b>ERRO - Serviços tem que ser preenchido!</b></div>";
  }
  $query_servicos = mysql_query("select * from tb_conteudo where cd_cont='3'") or die ("ERRO QUERY HISTORICO");
  $servicos = mysql_fetch_array($query_servicos);
  $ds_servicos = $servicos['ds_cont'];
  echo '<form action="servicos_gr.php" method="post" name="myform" enctype="multipart/form-data" onsubmit="return validacao();">
   <table width="600" border="0" cellpadding="2" cellspacing="0">
      <tr>
     <td class="tablabel" colspan="2"><font class="label">Texto</font></td>
	</tr>
    <tr> 
     <td class="tabcad" colspan="2"><textarea id="DsTexto" name="DsTexto">'.$ds_servicos.'</textarea></td>
    </tr>
    <tr>
     <td class="tabcad" colspan="2">
 	  <input type="submit" value="Salvar" class=cad>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 </td>
    </tr>    
    </table>
    </form>';
?>
