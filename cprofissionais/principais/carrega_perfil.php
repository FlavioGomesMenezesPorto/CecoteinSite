<?php

	include '../funcoes/conecta.php';
	mysql_select_db(BASE,$cn)or die(mysql_error());
	 
	if(isset($_COOKIE['pro']))
		$id = $_COOKIE["pro"];
	else
		$id = 0;
	
	if(isset($_COOKIE['cli']))
		$id_cli = $_COOKIE["cli"];
	else
		$id_cli = 0;
	
	if ($id != 0 )
	{
		$pesquisa = mysql_query("Select tipo from cadastro_profissionais where id_pro = '$id'");
		$tipo = mysql_fetch_row($pesquisa);
		
		if ($tipo[0] == 'empresa')
			echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/perfil_emp.php'>");
		else
			echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/perfil.php'>");
	}
	else
	{
		if($id_cli != 0 )
			echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/perfil_cli.php'>");
		else
			echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/listacompleta.php'>");
	}
		
?>
