<?
include '../funcoes/conecta.php';
mysql_select_db(BASE,$cn)or die(mysql_error());

session_start();

if(isset($_COOKIE['pro']))
	$id = $_COOKIE["pro"];
else
	$id = 0;
	
$inicio = $_POST["inicio"];
$termino = $_POST["termino"];

$confere = mysql_query("SELECT * FROM horarios where idprofissional = '$id' and inicio = '$inicio'")or die(mysql_error());

if(!mysql_num_rows($confere)){// se não tiver, ele insere o dado.
	
	mysql_query("INSERT INTO horarios(idprofissional, inicio, termino) VALUES ('$id', '$inicio', '$termino')")or die(mysql_error());
	if(mysql_affected_rows() == 1){
		echo '<p align="center">Registro efetuado com sucesso<BR><a href="../principais/index.php">Voltar</a></p>';
	} else{
		echo '<p align="center">Problemas com o servidor. Tente novamente mais tarde<BR><a href="../index.php">Voltar</a></p>';
	}

}else{
	echo "<p align='center'>Este horário já foi Cadastrado por voccê no nosso sitemas.<BR><a href='../principais/index.php'>Voltar</a></p>";
	
	//sleep(7);
	//echo"<script>window.location = 'index.php ';";
}

?>