<?
  include("barra.php");
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

function validacao()
{
  //validar data
  erro=0;
  hoje = new Date();
  anoAtual = hoje.getFullYear();
  barras = document.myform.dt_noticia.value.split("/");
  if (barras.length == 3)
  {
     dia = barras[0];
     mes = barras[1];
     ano = barras[2];
     resultado = (!isNaN(dia) && (dia > 0) && (dia < 32)) && (!isNaN(mes) && (mes > 0) && (mes < 13)) && (!isNaN(ano) && (ano.length == 4) && (ano <= anoAtual && ano >= 1900));
     if (!resultado) 
	 {
        alert("Formato de data invalido!");
        document.myform.dt_noticia.focus();
        return false;
     }
  } 
  else
  {
     alert("Formato de data invalido!");
     document.myform.dt_noticia.focus();
     return false;
  }
  if (document.myform.tit_noticia.value == '')
  {
    alert("Atenção - Título tem que ser preenchido!");
    document.myform.tit_noticia.focus();
    return false;
  }
  if (document.myform.res_noticia.value == '')
  {
    alert("Atenção - Resumo tem que ser preenchido!");
    document.myform.res_noticia.focus();
    return false;
  }
}
</script>
<?
$inicio = $_GET['beg'];
$codigo = $_GET['codigo'];
  
$qbusca = mysql_query("select date_format(dt_noticia,'%d/%m/%Y') as dtnoticia, tit_noticia, res_noticia, texto_noticia 
   from tb_noticias where cd_noticia = '$codigo'") or die ("Erro na busca de noticia para ser alterado");
$rbusca = mysql_fetch_array($qbusca);
$dt_noticia = $rbusca['dtnoticia'];
$tit_noticia = $rbusca['tit_noticia'];
$res_noticia = $rbusca['res_noticia'];
$texto_noticia = $rbusca['texto_noticia'];

echo '
<form action="noticias_rg.php" method="post" name="myform" enctype="multipart/form-data" onsubmit="return validacao();">
 <input type="hidden" name="inicio" value="'.$inicio.'">
 <input type="hidden" name="codigo" value="'.$codigo.'">
   <table width="600" border="0" cellpadding="2" cellspacing="0">
    <tr> 
     <td class="tabtitulo" colspan="2"><font class="titulo">ALTERANDO A NOTÍCIA</font></td>
    </tr>
    <tr>
     <td width="120" class="tablabel"><font class="label">Data</font></td>
     <td width="480" class="tabcad"><input class="cad" type="text" name="dt_noticia" value ="'.$dt_noticia.'" size="20" maxlength="10"><font class="label"> (dd/mm/aaaa)</font></td>
    </tr>
    <tr>
     <td class="tablabel"><font class="label">Título</font></td>
     <td class="tabcad"><input class="cad" type="text" name="tit_noticia" value ="'.$tit_noticia.'" size="100" maxlength="200"></td>
    </tr>
    <tr>
     <td class="tablabel"><font class="label">Resumo</font></td>
     <td class="tabcad" colspan="2"><textarea name="res_noticia" cols="65" rows="5">'.$res_noticia.'</textarea></td>
    </tr>
    <tr>
     <td class="tablabel" colspan="2"><font class="label">Texto</font></td>
	</tr>
   <tr> 
    <td class="tabcad" colspan="2"><textarea id="DsTexto" name="DsTexto">'.$texto_noticia.'</textarea></td>
   </tr>
   <tr>
    <td class="tabcad" colspan="2">
	 <input type="submit" value="Altera" class=cad>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="reset" value="Limpa" class=cad>
	</td>
   </tr>
   </table>
  </form>';
?>
