<?php
ob_start();
include("conecta.php");
$sess_dir = __DIR__ . '/sess_data';
if (!is_dir($sess_dir)) {
    @mkdir($sess_dir, 0777, true);
}
session_save_path($sess_dir);
session_start();

$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';
$cod   = isset($_POST['codigo']) ? trim($_POST['codigo']) : '';

// Se campos vazios, volta ao index
if (empty($cod) || empty($senha)) {
    header("Location: index.php?err=1");
    exit;
}

// Consulta no banco usando código fornecido
$query_senha = mysql_query("SELECT ds_senha FROM tb_usuario WHERE cd_usuario = '$cod'")
    or die("ERRO QUERY USUARIO");

$rows = mysql_num_rows($query_senha);

// Usuário não encontrado
if ($rows == 0) {
    header("Location: index.php?err=1");
    exit;
}

$qrysenha = mysql_fetch_array($query_senha);
$ds_senha = trim($qrysenha['ds_senha']);

// Validação da senha (insensível a maiúsculas/minúsculas para evitar erros de digitação)
if (strtolower($senha) == strtolower($ds_senha)) {
    // login ok
    $_SESSION['codigo_adm'] = $cod;
    $_SESSION['senha_adm']  = $ds_senha;
    session_write_close();

    $sid = session_name() . '=' . session_id();
    header("Location: barra.php?" . $sid);
    exit;
} else {
    // senha errada
    header("Location: index.php?err=2");
    exit;
}

ob_end_flush();
?>
