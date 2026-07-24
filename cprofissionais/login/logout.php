	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    
	setcookie ("pro", "", time() - 3600,"/cprofissionais/");
	setcookie ("cli", "", time() - 3600,"/cprofissionais/");
	session_start();
	session_destroy();
	//echo('-'.$_COOKIE["pro"].'Cookie pro');
	//echo('-'.$_COOKIE["cli"].'Cookie cli');
	header('Content-Type: text/html; charset=utf-8');
	?>	
		
	<script language="javascript">
		alert(unescape('Sessão encerrada!')); 
	</script>
	
	<?php    
	
		echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/index.php'>");

?>
		