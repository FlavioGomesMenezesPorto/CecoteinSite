<?
  include("conecta.php");
  include("verifica.php");
  include("barra.php");
  $imagemdir = '../imagens/';
  
  $cd_sistema = $_GET['cod'];
  $query_nome = mysql_query("select nm_sistema from tb_sistemas where cd_sistema = '$cd_sistema'") or die ("ERRO QUERY NOME");
  $nome = mysql_fetch_array($query_nome);
  $nm_sistema = $nome['nm_sistema'];
  echo"<table width=650 border=0 cellpadding=1 cellspacing=1>
       <tr>
        <td width=100 bgcolor='#FFFFFF' bordercolor='#FFFFFF'><font class=titulo><a href='telas_cd.php?cod=$cd_sistema' class='acao'>Nova Tela</a></font></td>
        <td width=550><font face='Arial' size=1 color='#FFFFFF'><div align='right'><a href='sistemas.php' class='acao'>Voltar</a></div></font></td>
       </tr>
       </table>";
  echo "
  <table width=650 cellpadding=1 cellspacing=1>
   <tr>
    <th colspan=5 width=650 class='tabtitulo'><p align='center'><font class=titulo>TELAS - $nm_sistema</font></p></th>
   </tr>
   <tr>
    <td width=250 class='tabtitulo'><p align='center'><font class=titulo>Foto</font></p></td>
    <td width=200 class='tabtitulo'><p align='center'><font class=titulo>Nome</font></p></td>
    <td width=100 class='tabtitulo' colspan='3'><p align='center'><font class=titulo>Ação</font></p></td>
   </tr>";
  $query_telas = mysql_query("select * from tb_telas where cd_sistema = '$cd_sistema' order by nm_tela") or die ("ERRO QUERY TELAS");
  while ($telas = mysql_fetch_array($query_telas)) {
    $cd_tela = $telas['cd_tela'];
    $foto_tela = $telas['foto_tela'];
    $nm_tela = $telas['nm_tela'];
    echo "
    <tr>
     <td width=250 class='tabdetalhe'><div align='center'><img src='$imagemdir$foto_tela' border='0' width='150'></div></td>
     <td width=200 class='tabdetalhe'><font class='detalhe'>$nm_tela</font></td>
     <td class='tabdetalhe'><a href='telas_mn.php?sist=$cd_sistema&cod=$cd_tela' class='acao'>Alterar</a></td>
     <td class='tabdetalhe'><a href='telas_dl.php?sist=$cd_sistema&cod=$cd_tela&foto=$foto_tela' class='acao'>Excluir</a></td>
    </tr>";
  };
  echo "</table>";

?>
