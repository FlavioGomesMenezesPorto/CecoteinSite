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
	
	$sql = "select * from cadastro_profissionais";
	$resposta = mysql_query($sql, $cn);
	while ($linha = mysql_fetch_array($resposta)) {	
		if ($linha['id_pro'] == $id){
			$nome = $linha['nome_pro']; 
		}
	}


	if ($id != 0 )
	{
		//echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?p=".$id."n=".$nome."'>");
		echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/listacompleta.php'>");
	}
	else
	{
		echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/listacompleta.php'>");
	}
	
		
?>
