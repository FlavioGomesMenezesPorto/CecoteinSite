<? /*
	//Definimos os dados para conexao com o banco de dados mysql.
	define("HOST","localhost");
	define("USU","root"); //usuário do database aqui
	define("PASS","");// senha usada para cesso ao banco de dados
	define("BASE","cecotein3");// nome da base de dados
	//Conectamos com a base de dados de acordo os dados acima.
	$cn=mysql_connect(HOST,USU,PASS)or die(mysql_error());   */
?>

<?
	//Definimos os dados para conexao com o banco de dados mysql.
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpasswd = '';
	//Conectamos com a base de dados de acordo os dados acima.

	if ($_SERVER['HTTP_HOST'] != 'localhost') 
	{
	   $dbhost = 'mysql07.cecotein.com.br';
	   $dbuser = 'cecotein3';
	   $dbpasswd = 'vsy8y3';
    }
	if (!defined("BASE")) {
	  define("BASE","cecotein3");// nome da base de dados
	}
	mysql_connect($dbhost,$dbuser,$dbpasswd)or die(mysql_error());
	$cn = mysql_connect($dbhost,$dbuser,$dbpasswd)or die(mysql_error());  

?>
