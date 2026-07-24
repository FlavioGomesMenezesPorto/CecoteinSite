<?php
	if(isset($_COOKIE['cli']))
		$id_cli = $_COOKIE["cli"];
	else
		$id_cli = 0;

	if(isset($_COOKIE['pro']))
		$id = $_COOKIE["pro"];
	else
		$id = 0;
		
	$flag = 0;
	session_start();
	
	if (isset($_SESSION['pro']))
	{       
		echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/prof_princ.php'>");
		$flag = 1;
	}
	else
	{ 
		if (isset($_SESSION['cliente']))
		{
			echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/principal.php'>");
			$flag = 1;
		}
		else
		{
			if (isset($_SESSION['emp']))
			{
				echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/empresa_princ.php'>");
				$flag = 1;
			}
		}
	}
	if ($flag == 0)
	{
		echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/login_cliente.php'>");
	}
	
?>
		