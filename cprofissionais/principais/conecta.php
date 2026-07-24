<? /*
	//Definimos os dados para conexao com o banco de dados mysql.
	define("HOST","localhost");
	define("USU","root"); //usuário do database aqui
	define("PASS","");// senha usada para cesso ao banco de dados
	define("BASE","shoppingvirtualu");// nome da base de dados
	//Conectamos com a base de dados de acordo os dados acima.
	$cn=mysql_connect(HOST,USU,PASS)or die(mysql_error());   */
?>

<?
	//Definimos os dados para conexao com o banco de dados mysql.
	define("HOST","localhost");
	define("USU","root"); //usuário do database aqui
	define("PASS","");// senha usada para cesso ao banco de dados
	define("BASE","shoppingvirtualu");// nome da base de dados
	//Conectamos com a base de dados de acordo os dados acima.

	if ($_SERVER['HTTP_HOST'] != 'localhost') 
	{
	   define("HOST","mysql5.hospedagem-de-site.info");
	   define("USU","shoppingvirtualu"); //usuário do database aqui
	   define("PASS","vsy8y3");// senha usada para cesso ao banco de dados
  	   define("BASE","shoppingvirtualu");// nome da base de dados 
	}
	$cn=mysql_connect(HOST,USU,PASS)or die(mysql_error());  

?>
