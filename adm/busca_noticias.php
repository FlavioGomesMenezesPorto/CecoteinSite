<?
  include("barra.php");
  $chave = $_POST['chave'];
  $filtro = $_POST['filtro'];
  echo "
<div align='center'>
 <center>
 <FORM action='busca_noticias.php' method='POST' enctype='multipart/form-data'>
 <table width='380' Scellpadding='1' cellspacing='1'>
 <tr>
   <th width=380 class='tabtitulo'><p align='center'><font class=titulo>BUSCA</font></p></th>
 </tr>
 <tr>
   <td class='tabdetalhe'>&nbsp;<INPUT class='cad' type='text' name='chave' size='40'> <INPUT class='cad' type='submit' value='Buscar'></td>
 </tr>
 <tr>
    <td class='tabtitulo'><div align='center'><font class='titulo'>Buscar por</font> <SELECT name='filtro' class='cad'>
         <option>Título da Notícia</option>
	 <option>Texto da Notícia</option>
	 <option>Data (DD/MM/AAAA)</option>
       </SELECT>
   </td></div>
 </tr>
 </table>
 </FORM>
 <br>
  <table width='500' Scellpadding='1' cellspacing='1'>
   <tr>
    <td width=100 bgcolor='#FFFFFF' bordercolor='#FFFFFF'><a href='noticias_cd.php' class=acao>Nova Notícia</a></td>
   </tr>
   <tr>
    <th colspan=5 width=500 class='tabtitulo'><p align='center'><font class=titulo>Notícias</font></p></th>
   </tr>
   <tr>
    <td width=50 class='tabtitulo'><p align='center'><font class=titulo>Data</font></p></td>
    <td width=300 class='tabtitulo'><p align='center'><font class=titulo>Título</font></p></td>
    <td width=150 colspan=3 class='tabtitulo'><p align='center'><font class=titulo>Ação</font></p></td>
   </tr>";
  if ($filtro == 'Título da Notícia') {
    $QUERY_TITULO = mysql_query("select * from tb_noticias where tit_noticia LIKE '%$chave%'") or die ("ERRO QUERY TITULO");
    while($registros = mysql_fetch_array($QUERY_TITULO))
    {
      $cd_noticia = $registros["cd_noticia"];
      $tit_noticia = $registros["tit_noticia"];
      $dt_noticia = $registros["dt_noticia"];
      $dt_noticia = substr($dt_noticia,8,2)."/".substr($dt_noticia,5,2)."/".substr($dt_noticia,0,4);
      echo "
      <tr>
       <td width=50 class='tabdetalhe'><font class=detalhe>".$dt_noticia."</font></td>
       <td width=300 class='tabdetalhe'><font class=detalhe>".$tit_noticia."</font></td>
       <td width=50 class='tabdetalhe'><a href='noticias_mn.php?codigo=".$cd_noticia."' class=acao>Alterar</a></td>
       <td width=50 class='tabdetalhe'><a href='fotosnot.php?codigo=".$cd_noticia."' class=acao>Fotos</a></td>
       <td width=50 class='tabdetalhe'><a href='noticias_dl.php?codigo=".$cd_noticia."' class=acao>Excluir</a></td>
      </tr>";
    }    
  }
  elseif ($filtro == 'Texto da Notícia') {
    $QUERY_TEXTO = mysql_query("select * from tb_noticias where texto_noticia LIKE '%$chave%'") or die ("ERRO QUERY TITULO");
    while($registros = mysql_fetch_array($QUERY_TEXTO))
    {
      $cd_noticia = $registros["cd_noticia"];
      $tit_noticia = $registros["tit_noticia"];
      $dt_noticia = $registros["dt_noticia"];
      $dt_noticia = substr($dt_noticia,8,2)."/".substr($dt_noticia,5,2)."/".substr($dt_noticia,0,4);
      echo "
      <tr>
       <td width=50 class='tabdetalhe'><font class=detalhe>".$dt_noticia."</font></td>
       <td width=300 class='tabdetalhe'><font class=detalhe>".$tit_noticia."</font></td>
       <td width=50 class='tabdetalhe'><a href='noticias_mn.php?codigo=".$cd_noticia."' class=acao>Alterar</a></td>
       <td width=50 class='tabdetalhe'><a href='fotosnot.php?codigo=".$cd_noticia."' class=acao>Fotos</a></td>
       <td width=50 class='tabdetalhe'><a href='noticias_dl.php?codigo=".$cd_noticia."' class=acao>Excluir</a></td>
      </tr>";
    }   
  }
  elseif ($filtro == 'Data (DD/MM/AAAA)') {
    $chave = substr($chave,6,4)."-".substr($chave,3,2)."-".substr($chave,0,2);
    $QUERY_DATA = mysql_query("select * from tb_noticias where dt_noticia LIKE '%$chave%'") or die ("ERRO QUERY TITULO");
    while($registros = mysql_fetch_array($QUERY_DATA))
    {
      $cd_noticia = $registros["cd_noticia"];
      $tit_noticia = $registros["tit_noticia"];
      $dt_noticia = $registros["dt_noticia"];
      $dt_noticia = substr($dt_noticia,8,2)."/".substr($dt_noticia,5,2)."/".substr($dt_noticia,0,4);
      echo "
      <tr>
       <td width=50 class='tabdetalhe'><font class=detalhe>".$dt_noticia."</font></td>
       <td width=300 class='tabdetalhe'><font class=detalhe>".$tit_noticia."</font></td>
       <td width=50 class='tabdetalhe'><a href='noticias_mn.php?codigo=".$cd_noticia."' class=acao>Alterar</a></td>
       <td width=50 class='tabdetalhe'><a href='fotosnot.php?codigo=".$cd_noticia."' class=acao>Fotos</a></td>
       <td width=50 class='tabdetalhe'><a href='noticias_dl.php?codigo=".$cd_noticia."' class=acao>Excluir</a></td>
      </tr>";
    }   
  }
  
  echo "</table>
</center>
</div>";
?>
