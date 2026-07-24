<?php

//--- Definindo as variáveis

	$id = $_POST["id"];
	$hor = $_POST["hora"];
	$dt = $_POST["data"];
	$nome = $_POST['nome'];
	$end = $_POST['end'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$tel = $_POST['tel'];
	$obs = $_POST['obs']; 
	$id_hor = $_POST['id_hor'];
	$id_cli = $_POST['id_cli'];

//------------

	date_default_timezone_set('UTC');
	
	include '../funcoes/conecta.php';
	include '../funcoes/funcoes.php';	
	
	mysql_select_db(BASE,$cn)or die(mysql_error());
	
	$timestamp = strtotime($dt.'+1 day');
	$data = date('d-m-Y', $timestamp);
	
	//echo($data.' data alterada <br> ');
	
	echo('<form name="teste" action="../horario/altera_horario.php" method="post">
		 <input type="hidden" name="id" value="'.$id.'">
		 <input type="hidden" name="data" value="'.$data.'">
		 <input type="hidden" name="hora" value="'.$hor.'">
		 <input type="hidden" name="nome" value="'.$nome.'">
		 <input type="hidden" name="end" value="'.$end.'">
		 <input type="hidden" name="bairro" value="'.$bairro.'">
		 <input type="hidden" name="cidade" value="'.$cidade.'">
		 <input type="hidden" name="estado" value="'.$estado.'" >
		 <input type="hidden" name="tel" value="'.$tel.'">
		 <input type="hidden" name="obs" value="'.$obs.'">
		 <input type="hidden" name="id_hor" value="'.$id_hor.'">
		 <input type="hidden" name="id_cli" value="'.$id_cli.'">
	<input type="submit" name="enviar" id="enviar" value="Enviar" style="visibility:hidden;" >
	</form>');

?>	
	<script language="javascript">
						
		document.getElementById('enviar').click();
	
	</script>
