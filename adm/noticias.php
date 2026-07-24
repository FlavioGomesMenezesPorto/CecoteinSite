<?
include('barra.php');
$inicio = $_GET['beg'];
if (empty($inicio)) $inicio = 0;
$qtreg = 15;
?>
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
    <option>Título da Notícia</option><option>Texto da Notícia</option><option>Data (DD/MM/AAAA)</option></SELECT>
   </div></td>
  </tr>
 </table>
</FORM>
<table width="500" Scellpadding="1" cellspacing="1">
  <tr>
<? echo '<td colspan="4" width="500" bgcolor="#FFFFFF" bordercolor="#FFFFFF"><a href="noticias_cd.php?beg='.$inicio.'" class="acao">Nova notícia</a></td>'; ?>  
  </tr>
  <tr> 
      <td colspan="4" width="50" class="tabtitulo">
	   <font class="titulo">NOTÍCIAS</font></td>
    </tr>
    <tr> 
      <td  width="80" class="tabtitulo"><font class="titulo">DATA</font></td>
      <td width="330" class="tabtitulo"><font class="titulo">T&Iacute;TULO</font></td>
      <td width="90" class="tabtitulo" colspan="2"><font class="titulo">A&Ccedil;&Otilde;ES</font></td>
    </tr>        
<?
//$Query_noticias=mysql_query("select cd_noticia, tit_noticia, dt_noticia from tb_noticias order by dt_noticia desc, time desc") or die ("erro query lista noticias");
$listagem = mysql_query("select cd_noticia, date_format(dt_noticia,'%d/%m/%Y') as dtnoticia, tit_noticia from tb_noticias order by dt_noticia desc limit ".$inicio.",".$qtreg) or die ('Erro na listagem de noticias');
while($registros = mysql_fetch_array($listagem))
{
   $codigo = $registros['cd_noticia'];
   $dtnoticia = $registros['dtnoticia'];
   $titulo = $registros['tit_noticia'];
   
   echo'
    <tr> 
     <td width="80" class="tabdetalhe"><font class="detalhe">'.$dtnoticia.'</font></td>
     <td width="330" class="tabdetalhe"><font class="detalhe">'.$titulo.'</font></td>
     <td width="45" class="tabdetalhe"><a href="noticias_mn.php?beg='.$inicio.'&codigo='.$codigo.'" class="acao">Altera</a></td>
     <td width="45" class="tabdetalhe"><a href="noticias_dl.php?beg='.$inicio.'&codigo='.$codigo.'" class="acao">Exclui</a></td>
    </tr>';
}

//gerando próximas páginas
$query2 = mysql_query("select count(*) as totalreg from tb_noticias order by dt_noticia desc");
$campo2 = mysql_fetch_array($query2);
$totalreg = $campo2['totalreg'];

if ($totalreg > $qtreg)
{
   echo'<tr><td colspan="10" bgcolor="#FFFFFF">';
   if ($inicio == 0)
   {
      $x = $inicio + $qtreg;
      echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
       <tr><td align="right" valign="middle"><a href="noticias.php?beg='.$x.'" class="lnkpag">
		Pr&oacute;xima P&aacute;gina &gt;&gt;</a></td></tr></table>';
   }
   else
   {
      $x = $inicio + $qtreg;
      $y = $inicio - $qtreg;
      if ($x < $totalreg)
      {
         echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
		   <td width="50%" align="left" valign="middle""><a href="noticias.php?beg='.$y.'" class="lnkpag">
		    &lt;&lt; P&aacute;gina Anterior</a></td>
           <td width="50%" align="right" valign="middle"><a href="noticias.php?beg='.$x.'" class="lnkpag">
           Pr&oacute;xima P&aacute;gina &gt;&gt;</a></td></tr></table>';
      }
      else
      {
         echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr><td align="left" valign="middle""><a href="noticias.php?beg='.$y.'" class="lnkpag">
		   &lt;&lt; P&aacute;gina Anterior</a></td></tr></table>';
      }
   }
   echo'</td></tr>';
}
?>
  </table>
</body>
</html>
