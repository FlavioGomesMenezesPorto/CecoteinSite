<?php
	$ligacao = mysql_connect("localhost", "root", "cecote1212");
	$ok = mysql_select_db("cprofissionais", $ligacao);
	$categ = "advogado";
	$consulta = "SELECT * FROM profissional WHERE categoria = '$categ'";

	$resultado = mysql_query($consulta, $ligacao);
	
	printf("Nome: ", mysql_result($resultado,0,"nome"), "<br>\n");
	printf("ID: ", mysql_result($resultado,0,"id"), "<br>\n");
	printf("Profissao: ", mysql_result($resultado,0,"categoria"),"<input type="submit"><hr>");
?>