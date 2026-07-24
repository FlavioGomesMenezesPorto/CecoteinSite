<?
  include("conecta.php");
  include("verifica.php");
  include("barra.php");
  $imagemdir = '../imagens/';
  echo"<table width=650 border=0 cellpadding=1 cellspacing=1>
       <tr>
        <td width=100 bgcolor='#FFFFFF' bordercolor='#FFFFFF'><font class=titulo><a href='sistemas_cd.php' class='acao'>Novo Sistema</a></font></td>
        <td width=550><font face='Arial' size=1 color='#FFFFFF'></font></td>
       </tr>
       </table>";
  echo "
  <table width=650 cellpadding=1 cellspacing=1>
   <tr>
    <th colspan=5 width=650 class='tabtitulo'><p align='center'><font class=titulo>SISTEMAS</font></p></th>
   </tr>
   <tr>
    <td width=250 class='tabtitulo'><p align='center'><font class=titulo>Logo</font></p></td>
    <td width=200 class='tabtitulo'><p align='center'><font class=titulo>Nome</font></p></td>
    <td width=100 class='tabtitulo' colspan='3'><p align='center'><font class=titulo>Ação</font></p></td>
   </tr>";  
  $query_sistemas = mysql_query("select * from tb_sistemas order by nm_sistema")  or die ("ERRO QUERY SISTEMAS");
  while ($sistemas = mysql_fetch_array($query_sistemas)) {
    $cd_sistema = $sistemas['cd_sistema'];
  	$nm_sistema = $sistemas['nm_sistema'];
    $logo_sistema = $sistemas['logo_sistema'];
    echo "<tr>
            <td class='tabdetalhe'><div align='center'><img src='$imagemdir$logo_sistema' border='0' width='70%'></div></td>
            <td class='tabdetalhe'><font class='detalhe'>$nm_sistema</font></td>
            <td class='tabdetalhe'><a href='telas.php?cod=$cd_sistema' class='acao'>Telas</a></td>
            <td class='tabdetalhe'><a href='sistemas_mn.php?cod=$cd_sistema' class='acao'>Alterar</a></td>
            <td class='tabdetalhe'><a href='sistemas_dl.php?cod=$cd_sistema&foto=$logo_sistema' class='acao'>Excluir</a></td>
          <tr>";
  }
  echo "</table>";
?>