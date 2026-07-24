<?

  include("barra.php");

  include("funcoes.php");

?>

<script>
  function SetLinkerTimeStamp() {
    xURL = window.location.href;
    xURL = xURL.slice(xURL.lastIndexOf("=")+1,xURL.length);
    W = window.open("linkerTS:COD"+xURL); 
    setTimeout(function(){W.close()},500);
  }
</script>

<SCRIPT LANGUAGE="JavaScript">

function validacao()

{
  //validar data
  SetLinkerTimeStamp();
  erro=0;

  if (document.myform.nm_sistema.value == '')

  {

    alert("Aten��o - Nome do sistema tem que ser preenchido!");

    document.myform.nm_sistema.focus();

    return false;

  }

}

</script>

<?

$inicio = $_GET['beg'];

$cd_down = $_GET['cod'];



$query_downloads = mysql_query("select * from tb_downloads where cd_down = '$cd_down'") or die ("ERRO QUERY DOWNLOADS");

$downloads = mysql_fetch_array($query_downloads);

$nm_down = $downloads['nm_down'];

$arq_down = $downloads['arq_down'];



echo '

<form action="downloads_rg.php" method="post" name="myform" enctype="multipart/form-data" onsubmit="return validacao();">

 <input type="hidden" name="inicio" value="'.$inicio.'">

 <input type="hidden" name="cd_down" value="'.$cd_down.'">

 <input type="hidden" name="arq_ant" value="'.$arq_down.'">

   <table width="600" border="0" cellpadding="2" cellspacing="0">

    <tr>

     <td class="tabtitulo" colspan="2"><font class="titulo">ALTERANDO UM ARQUIVO</font></td>

    </tr>

    <tr>

     <td width="120" class="tablabel"><font class="label">Nome</font></td>

     <td width="480" class="tabcad"><input class="cad" type="text" name="nm_down" value ="'.$nm_down.'" size="80" maxlength="150"></td>

    </tr>

    <tr>

     <td width="120" class="tablabel"><font class="label">Arquivo<br>'.$arq_down.'</font></td>

     <td width="480" class="tabcad"><input class="cad" type="file" name="arquivo" size="80" maxlength="150"></td>

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

