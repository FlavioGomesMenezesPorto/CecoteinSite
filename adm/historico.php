<?
  include("barra.php");
  include("funcoes.php");
  include("conecta.php");
?>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
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
  	echo "<div align='center'><b>ERRO - Histórico tem que ser preenchido!</b></div>";
  }
  $query_historico = mysql_query("select * from tb_conteudo where cd_cont='1'") or die ("ERRO QUERY HISTORICO");
  $historico = mysql_fetch_array($query_historico);
  $ds_historico = $historico['ds_cont'];
  echo '<form action="historico_gr.php" method="post" name="myform" enctype="multipart/form-data" onsubmit="return validacao();">
   <table width="600" border="0" cellpadding="2" cellspacing="0">
      <tr>
     <td class="tablabel" colspan="2"><font class="label">Texto</font></td>
	</tr>
    <tr> 
     <td class="tabcad" colspan="2"><textarea id="DsTexto" name="DsTexto">'.$ds_historico.'</textarea></td>
    </tr>
    <tr>
     <td class="tabcad" colspan="2">
 	  <input type="submit" value="Salvar" class=cad>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 </td>
    </tr>    
    </table>
    </form>';
?>
