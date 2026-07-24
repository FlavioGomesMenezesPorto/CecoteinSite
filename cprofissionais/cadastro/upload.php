<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<?php

$arquivo = $_POST['arquivo'];
echo($arquivo);
$nome = rand(00,9999); // Aqui criamos um número randômico, para utilizarmos como nome do arquivo
$dir="../imagens/profissionais/"; //Esse é o diretório onde ficará os arquivos enviados, lembre-se de criá-lo. Este script não cria diretórios

 move_uploaded_file($arquivo,$dir.$nome.$arquivo_name); // Aqui, efetuamos o upload, propriamente dito
 echo "Enviado<br>"; // Caso dê tudo certo, imprimi na tela "enviado"



?>

</body>
</html>