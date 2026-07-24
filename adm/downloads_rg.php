<?

  include("conecta.php");

  include("verifica.php");



  $arqdir = '../arquivos/';



  $cd_down = $_POST['cd_down'];

  $nm_down = $_POST['nm_down'];

  $arq_ant = $_POST['arq_ant'];



  $arqpath = $_FILES['arquivo']['tmp_name'];

  $arq_down = $_FILES['arquivo']['name'];

  $tp_arq = $_FILES['arquivo']['type'];

  $larq_down = ucfirst(strtolower($arq_down));

  if (!empty($arq_down)) {

    $query_sistemas = mysql_query("update tb_downloads set nm_down = '$nm_down', arq_down = '$larq_down'

    , data_down = now() where cd_down = '$cd_down'") or die ("ERRO QUERY DOWNLOADS");

    if (file_exists($arqdir.$arq_ant))

      unlink($arqdir.$arq_ant);

      

    if (!file_exists($arqdir.$arq_down))

        move_uploaded_file($arqpath, $arqdir.$larq_down);

    chmod("$arqdir"."$larq_down", 0707);

  }

  else {

    $query_sistemas = mysql_query("update tb_downloads set nm_down = '$nm_down'

    , data_down = now() where cd_down = '$cd_down'") or die ("ERRO QUERY DOWNLOADS");

  }



  header("Location: downloads.php");

?>

