<html>
<head>
<link href="../calendario/_style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../calendario/_scripts/jquery.js"></script>
<script type="text/javascript" src="../calendario/_scripts/jquery.click-calendario-1.0-min.js"></script>		
<script type="text/javascript" src="../calendario/_scripts/exemplo-calendario.js"></script>
<script src="../cadastro/script.js"></script>
<script type="text/javascript" >
		function AbrirAjax() {
			var Ajax;
			try {Ajax = new XMLHttpRequest(); // XMLHttpRequest para br owsers mais populares, como: Firefox, Safari, dentre outros.
			}catch(ee){
				try {Ajax = new ActiveXObject("Msxml2.XMLHTTP"); // Para o IE da MS
			}catch(e){
				try {Ajax = new ActiveXObject("Microsoft.XMLHTTP"); // Para o IE da MS
			}catch(e){Ajax = false;
			}
			}
			}
			return Ajax;
		}
	
		function carregaAjax(div, getURL) {
		document.getElementById(div).style.display = "block";
		if(document.getElementById) { // Para os browsers complacentes com o DOM W3C.
		var exibeResultado = document.getElementById(div); // div que exibirá o resultado.
		var Ajax = AbrirAjax(); // Inicia o Ajax.
		Ajax.open("GET", getURL, true); // fazendo a requisição
		Ajax.onreadystatechange = function(){
			if(Ajax.readyState == 1) { // Quando estiver carregando, exibe: carregando...
			exibeResultado.innerHTML = "<div>Carregando.</div>";
			}
				if(Ajax.readyState == 4) { // Quando estiver tudo pronto.
					if(Ajax.status == 200) {
						var resultado = Ajax.responseText; // Coloca o retornado pelo Ajax nessa variável
						exibeResultado.innerHTML = resultado;
						} else {
			exibeResultado.innerHTML = "Por favor, tente novamente!";
						}
				}
			}
		Ajax.send(null); // submete
		}
		}
		function pesquisa(valor)
			{  
				/*valor = document.getElementById(valordata);*/
				//alert(valor);
				//FUNÇÃO QUE MONTA A URL E CHAMA A FUNÇÃO AJAX
				url="alternativa.php?valor="+valor;
				
				ajax(url);
			}
</script>
</head>


<?php header('Content-Type: text/html; charset=utf-8');
session_start();
include '../funcoes/conecta.php';
include '../funcoes/funcoes.php';
mysql_select_db(BASE,$cn)or die(mysql_error());
date_default_timezone_set('UTC');
	//$opcao = $_GET[valor];
	$opcao = !empty($_GET["valor"])?$_GET["valor"]:"";
	list($opcao, $data) = explode('.', $opcao, 2);
echo('<div id="pagina">');
if ($opcao <> "") {
	if($opcao == 'gravar'){
		echo('<form action="inseredata.php" method="post">
		<table><tr>');
		echo('<td>Gravar data<br>
		<input type="text" style="width:78px; size="20" value="'.$data.'" name="dt" id="data_1" maxlength="10" 	
		onKeyPress="mascara(this, \'##-##-####\')" onBlur="TestaData(this)"></td>
		<td>Observacoes<br><input type="text" name="ob"></td>
		
		<td><input type="submit" value="ok"/></td>
		
		</tr></table></form>');
	}
	if($opcao == 'apagar'){
		
		echo(' <form action="alternativa2.php?opcao=apagar" method="post">
		Data a ser apagada<br><input type="text" style="width:78px; size="20" value="'.$data.'" name="dt" id="data_1" maxlength="10"
		onKeyPress="mascara(this, \'##-##-####\')" onBlur="TestaData(this)">
		<input type="submit" name="botao" value="ok"/>
		</form>');
		
		$sql = "select * from calendario_pro where data=".$data;
	}
	if($opcao == 'alterar'){
		echo(' <form action="alternativa2.php?opcao=alterar" method="post">
		Data a ser alterada<br><input type="text" style="width:78px; size="20" value="'.$data.'" name="dt" id="data_1" maxlength="10" 	
		onKeyPress="mascara(this, \'##-##-####\')" onBlur="TestaData(this)">
		<input type="submit" name="botao" value="ok" />
		</form>');
	}
	if ($opcao == 'aniversario'){
		echo('		<table align="center" border="1"> <tr><br>
		<td> 1 ano</td><td>Bodas de papel&nbsp</td>		<td> &nbsp&nbsp15 anos</td><td>&nbspBodas de cristal</td></tr><tr>
		<td> 2 anos</td><td>Bodas de algodão&nbsp</td>	<td> &nbsp&nbsp20 anos</td><td>&nbspBodas de porcela</td></tr><tr>
		<td> 3 anos</td><td>Bodas de couro&nbsp</td>		<td> &nbsp&nbsp25 anos</td><td>&nbspBodas de prata</td></tr><tr>
		<td> 4 anos</td><td>Bodas de seda&nbsp</td>		<td> &nbsp&nbsp30 anos</td><td>&nbspBodas de pérola</td></tr><tr>
		<td> 5 anos</td><td>Bodas de madeira&nbsp</td>	<td> &nbsp&nbsp35 anos</td><td>&nbspBodas de coral</td></tr><tr>
		<td> 6 anos</td><td>Bodas de ferro&nbsp</td>		<td> &nbsp&nbsp40 anos</td><td>&nbspBodas de rubi</td></tr><tr>
		<td> 7 anos</td><td>Bodas de latao&nbsp</td>		<td> &nbsp&nbsp50 anos</td><td>&nbspBodas de ouro</td></tr><tr>
		<td> 8 anos</td><td>Bodas de cobre&nbsp</td>		<td> &nbsp&nbsp55 anos</td><td>&nbspBodas de esmeralda</td></tr><tr>
		<td> 9 anos</td><td>Bodas de bronze&nbsp</td>		<td> &nbsp&nbsp60 anos</td><td>&nbspBodas de diamante</td></tr><tr>
		<td> 10 anos</td><td>Bodas de estanho&nbsp</td>	
		</tr></table>');
	}
	if ($opcao == 'comemorativas'){
		$sql = mysql_query("select data, observacoes from calendario_pro where empresa='comemorativa' and cidade='comemorativa' ORDER BY observacoes ASC");
		$re = mysql_fetch_row($sql);
		echo('<br><div align="left" style="float:none"; margin: 10px 30px>');
		while ($row = mysql_fetch_array($sql)){
			$time = strtotime($row[0]);
			$row[0] = date('d-m-Y', $time);
			echo('&nbsp'.htmlspecialchars_decode(htmlentities($row[0])).' - '.htmlspecialchars_decode(htmlentities($row[1])).'<br>');
		}
		echo('</br>');
		
	}
	
}
echo('</div>');
?>
</html>