<?
  include("conecta.php");
  include("verifica.php");
  include("barra.php");
  $imagemdir = '../imagens/';
  echo"<table width=650 border=0 cellpadding=1 cellspacing=1>
       <tr>
        <td width=100 bgcolor='#FFFFFF' bordercolor='#FFFFFF'><font class=titulo><a href='downloads_cd.php' class='acao'>Novo Arquivo</a></font></td>
        <td width=550><font face='Arial' size=1 color='#FFFFFF'></font></td>
       </tr>
       </table>";
  echo "
  <table width=650 cellpadding=1 cellspacing=1>
   <tr>
    <th colspan=5 width=650 class='tabtitulo'><p align='center'><font class=titulo>DOWNLOADS</font></p></th>
   </tr>
   <tr>
    <td width=250 class='tabtitulo'><p align='center'><font class=titulo>Nome</font></p></td>
    <td width=200 class='tabtitulo'><p align='center'><font class=titulo>Data</font></p></td>
    <td width=100 class='tabtitulo' colspan='2'><p align='center'><font class=titulo>Ação</font></p></td>
   </tr>";
  $query_downloads = mysql_query("select * from tb_downloads order by nm_down")  or die ("ERRO QUERY DOWNLOADS");
  while ($downloads = mysql_fetch_array($query_downloads)) {
    $cd_down = $downloads['cd_down'];
  	$nm_down = $downloads['nm_down'];
    $data_down = $downloads['data_down'];
    $data_down = substr($data_down,8,2)."/".substr($data_down,5,2)."/".substr($data_down,0,4);
    $arq_down = $downloads['arq_down'];
    echo "<tr>
            <td class='tabdetalhe'><font class='detalhe'>$nm_down</font></td>
            <td class='tabdetalhe'><font class='detalhe'>$data_down</font></td>
            <td class='tabdetalhe'><a href='downloads_mn.php?cod=$cd_down' class='acao'>Alterar</a></td>
            <td class='tabdetalhe'><a href='downloads_dl.php?cod=$cd_down&arq=$arq_down' class='acao'>Excluir</a></td>
          <tr>";
  }
  echo "</table>";
?>
