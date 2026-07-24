<?
	include '../funcoes/conecta.php';
	mysql_select_db(BASE,$cn)or die(mysql_error());
	
	session_start();
	if(isset($_COOKIE['cli']))
		$id_cli = $_COOKIE["cli"];
	else
		$id_cli = 0;
		
	$cpf = $_POST['cpf'];
	$busca=mysql_query("SELECT nome_pro, id_pro FROM cadastro_profissionais where cpf_pro = '$cpf'")or die(mysql_error());
	if(!mysql_num_rows($busca))
	{ // se n�o tiver, ele imprime um erro.
		echo '<p align="center">Desculpe-nos o transtorno, tente novamente mais tarde.<BR><a href="../principais/index.php">Voltar.</a></p>';
	}
	else
	{
		while($ver=mysql_fetch_row($busca))
		{
			$nome=$ver[0];
			$id=$ver[1];
		}
		echo"
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
		<html>
			<head>
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<title> CProfissionais - Cadastro de Hor�rios </title>
				<link href='../estilos/cadastro.css' type='text/css' rel='stylesheet'>
				<script src='../js/cadastrohorarios.js'></script>
			</head>	
			<!-- #################################################################################### -->
			<body>
				<div class='principal'>
					<div id=\"cabeca\" >
						<img src=\"./imagens/Logo 1.png\" width=\"900px\" height=\"110px\">
					</div>
					
					<div id=\"flash\" >
						 <object width=\"1500px\" height=\"65px\">
							 <param name=\"movie\" value=\"menu/Menu.swf\">
							 <param name=\"wmode\" value=\"transparent\" />
							 <embed wmode=\"transparent\" src=\"menu/Menu.swf\" width=\"900px\" height=\"60px\" />
						</object>
					</div>		
					<div class='conteudo'>
						<form border='0' name='cadastrohorario' action='cadastro/cadastrohora.php?r=$id' method='post' onsubmit='return verificacadhorario(this);'>
							<br>
							<table>
								<tr>
									<td colspan='2'> <center> <img src='../imagens/cad_horario.png'> </center> </td>
								</tr>
								<tr>
									<td> <label for='nome'> <b> Nome: </b> </label> </td>
									<td> <input type='text' maxlength='40' size='50' name='nome' disabled='disabled' value='".$nome."' > </td>
								</tr>	
								<tr>
									<td> <label for='inicio'> <b> Inicio: </b> </label> </td>
									<td> <input type='text' maxlength='40' size='50' name='inicio'> </td>
								</tr>									
								<tr>
									<td> <label for='termino'> <b> Termino: </b> </label> </td>
									<td> <input type='text' maxlength='40' size='50' name='termino'> </td>
								</tr>												
								<tr>
									<td colspan='2'> <center> <input type='submit' value='Cadastrar'> </center> </td>
								</tr>	
							</table>
						</form>						
					</div> <!-- Fecha a div Conteudo -->
				</div>  <!-- Fecha a div Principal -->
			</body>
		</html>";
	}
?>