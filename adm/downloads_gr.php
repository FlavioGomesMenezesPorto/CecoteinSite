<?

  include("conecta.php");
  include("verifica.php");


  $arqdir = '../arquivos/';

  $nm_down = $_POST['nm_down'];

  $arqpath = $_FILES['arquivo']['tmp_name'];

  $arq_down = $_FILES['arquivo']['name'];

  $tp_arq = $_FILES['arquivo']['type'];

  $larq_down = ucfirst(strtolower($arq_down));
  $query_sistemas = mysql_query("insert into tb_downloads (nm_down, arq_down, data_down)

  values ('$nm_down', '$larq_down', now())") or die ("ERRO QUERY DOWNLOADS");

  if (!empty($arq_down)) {

    if (!file_exists($arqdir.$arq_down))

        move_uploaded_file($arqpath, $arqdir.$larq_down);

    //chmod("$arqdir"."$arq_down", 0707);
    chmod("$arqdir"."$larq_down", 0707);

  }

  header("Location: downloads.php");

?>

